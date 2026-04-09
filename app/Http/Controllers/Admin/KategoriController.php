<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Tampilkan halaman kategori beserta buku di tiap kategori.
     */
    public function index()
{
    $kategoris = Kategori::with('bukus')->get();
    $semuaBuku = Buku::selectRaw('id_buku as id, judul_buku, pengarang')->get();

    return view('admin.kategori.index', compact('kategoris', 'semuaBuku'));
}

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_buku,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori "' . $request->nama_kategori . '" berhasil ditambahkan.');
    }

    /**
     * Update nama kategori.
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_buku,nama_kategori,' . $id . ',id_kategori',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Nama kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Lepas semua relasi buku sebelum hapus (pivot)
        $kategori->buku()->detach();
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    public function addBuku(Request $request, $id)
    {
        $request->validate([
            'buku_ids'   => 'required|array',
            'buku_ids.*' => 'exists:buku,id_buku',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->bukus()->syncWithoutDetaching($request->buku_ids);

        return redirect()->route('admin.kategori.index')
             ->with('success', count($request->buku_ids) . ' buku berhasil ditambahkan ke kategori.');
    }

    /**
     * Hapus satu buku dari kategori (detach pivot).
     */
    public function removeBuku(Request $request, $id)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->bukus()->detach($request->buku_id);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Buku berhasil dihapus dari kategori.');
    }
}