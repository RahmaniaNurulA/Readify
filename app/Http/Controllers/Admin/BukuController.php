<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    // ── INDEX 
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $kategori = $request->input('kategori');

        $buku = DB::table('buku')
            ->leftJoin('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id_kategori')
            ->select('buku.*', 'kategori_buku.nama_kategori')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('buku.judul_buku', 'like', "%{$search}%")
                       ->orWhere('buku.pengarang',  'like', "%{$search}%")
                       ->orWhere('buku.penerbit',   'like', "%{$search}%");
                });
            })
            ->when($kategori, fn($q) => $q->where('buku.id_kategori', $kategori))
            ->orderBy('buku.id_buku', 'desc')
            ->get();

        $kategoris = DB::table('kategori_buku')->orderBy('nama_kategori')->get();

        return view('admin.buku.index', compact('buku', 'kategoris'));
    }

    // ── CREATE 
    public function create()
    {
        $kategoris = DB::table('kategori_buku')->orderBy('nama_kategori')->get();
        return view('admin.buku.create', compact('kategoris'));
    }

    // ── STORE 
    public function store(Request $request)
    {
        $request->validate([
            'judul_buku'   => 'required|string|max:255',
            'pengarang'    => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'id_kategori'  => 'required|exists:kategori_buku,id_kategori',
            'jumlah_buku'  => 'required|integer|min:0',
            'cover'        => 'nullable|image|max:2048',
            'file_buku'    => 'nullable|mimes:pdf,epub|max:51200',
            'sinopsis'     => 'nullable|string',
        ]);

        $coverPath    = null;
        $fileBukuPath = null;

       if ($request->hasFile('cover')) {
            try {
                \Cloudinary\Cloudinary::config([
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_KEY'),
                    'api_secret' => env('CLOUDINARY_SECRET'),
                ]);
                
                $api = new \Cloudinary\Api\Upload\UploadApi();
                $result = $api->upload($request->file('cover')->getRealPath(), [
                    'folder' => 'covers'
                ]);
                $coverPath = $result['secure_url'];
            } catch (\Exception $e) {
                dd('Error: ' . $e->getMessage());
            }
        }

        if ($request->hasFile('file_buku')) {
            try {
                $fileBukuPath = cloudinary()->uploadFile($request->file('file_buku')->getRealPath(), [
                    'folder' => 'buku_files',
                    'resource_type' => 'raw'
                ])->getSecurePath();
            } catch (\Exception $e) {
                return back()->with('error', 'File error: ' . $e->getMessage())->withInput();
            }
        }

        $id = DB::table('buku')->insertGetId([
            'judul_buku'   => $request->judul_buku,
            'pengarang'    => $request->pengarang,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'id_kategori'  => $request->id_kategori,
            'jumlah_buku'  => $request->jumlah_buku,
            'cover'        => $coverPath,
            'file_buku'    => $fileBukuPath,
            'sinopsis'     => $request->sinopsis,
        ]);

        // Sync ke tabel pivot buku_kategori
        $kategori = \App\Models\Kategori::find($request->id_kategori);
        if ($kategori) {
            $kategori->bukus()->syncWithoutDetaching([$id]);
        }

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku "' . $request->judul_buku . '" berhasil ditambahkan!');
    }

    // ── SHOW 
    public function show($id)
    {
        $buku = DB::table('buku')
            ->leftJoin('kategori_buku', 'buku.id_kategori', '=', 'kategori_buku.id_kategori')
            ->select('buku.*', 'kategori_buku.nama_kategori')
            ->where('buku.id_buku', $id)
            ->first();

        if (!$buku) {
            return redirect()->route('admin.buku.index')
                ->with('error', 'Buku tidak ditemukan.');
        }

        return view('admin.buku.show', compact('buku'));
    }

    // ── EDIT 
    public function edit($id)
    {
        $buku = DB::table('buku')->where('id_buku', $id)->first();

        if (!$buku) {
            return redirect()->route('admin.buku.index')
                ->with('error', 'Buku tidak ditemukan.');
        }

        $kategoris = DB::table('kategori_buku')->orderBy('nama_kategori')->get();

        return view('admin.buku.edit', compact('buku', 'kategoris'));
    }

    // ── UPDATE 
    public function update(Request $request, $id)
    {
        $bukuLama = DB::table('buku')->where('id_buku', $id)->first();

        if (!$bukuLama) {
            return redirect()->route('admin.buku.index')
                ->with('error', 'Buku tidak ditemukan.');
        }

        $request->validate([
            'judul_buku'   => 'required|string|max:255',
            'pengarang'    => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'id_kategori'  => 'required|exists:kategori_buku,id_kategori',
            'jumlah_buku'  => 'required|integer|min:0',
            'cover'        => 'nullable|image|max:2048',
            'file_buku'    => 'nullable|mimes:pdf,epub|max:51200',
            'sinopsis'     => 'nullable|string',
        ]);

        $coverPath    = $bukuLama->cover;
        $fileBukuPath = $bukuLama->file_buku;

        if ($request->hasFile('cover')) {
            $coverPath = cloudinary()->upload($request->file('cover')->getRealPath(), [
                'folder' => 'covers'
            ])->getSecurePath();
        }

        if ($request->hasFile('file_buku')) {
            $fileBukuPath = cloudinary()->uploadFile($request->file('file_buku')->getRealPath(), [
                'folder' => 'buku_files',
                'resource_type' => 'raw'
            ])->getSecurePath();
        }

        // Update semua field di tabel buku
        DB::table('buku')->where('id_buku', $id)->update([
            'judul_buku'   => $request->judul_buku,
            'pengarang'    => $request->pengarang,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'id_kategori'  => $request->id_kategori,
            'jumlah_buku'  => $request->jumlah_buku,
            'cover'        => $coverPath,
            'file_buku'    => $fileBukuPath,
            'sinopsis'     => $request->sinopsis,
        ]);

        // Update pivot buku_kategori
        $buku = \App\Models\Buku::find($id);
        if ($buku) {
            $buku->kategoris()->sync([$request->id_kategori]);
        }

        return redirect()->route('admin.buku.show', $id)
            ->with('success', 'Buku berhasil diperbarui!');
    }

    // ── DESTROY 
    public function destroy($id)
    {
        $buku = DB::table('buku')->where('id_buku', $id)->first();

        if ($buku) {
            DB::table('buku')->where('id_buku', $id)->delete();
        }

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}