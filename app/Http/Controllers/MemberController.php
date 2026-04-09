<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function daftarBuku(Request $request)
    {
        $search   = $request->input('search');
        $kategori = $request->input('kategori');

        $query = Buku::with('kategoris');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul_buku', 'like', "%$search%")
                  ->orWhere('pengarang', 'like', "%$search%")
                  ->orWhere('penerbit', 'like', "%$search%");
            });
        }

        if ($kategori) {
            $query->whereHas('kategoris', function($q) use ($kategori) {
                $q->where('buku_kategori.id_kategori', $kategori);
            });
        }

        $bukus     = $query->get();
        $kategoris = Kategori::all();

        return view('member.buku', compact('bukus', 'kategoris', 'search', 'kategori'));
    }

    public function detailBuku($id)
    {
        $buku = Buku::with('kategoris')->findOrFail($id);
        return view('member.detail-buku', compact('buku'));
    }

    public function pinjamBuku(Request $request, $id)
    {
        $user = Auth::user();
        $buku = Buku::findOrFail($id);

        if ($buku->jumlah_buku <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        $sudahPinjam = Peminjaman::where('id_user', $user->id_user)
            ->where('id_buku', $id)
            ->where('status_peminjaman', 'aktif')
            ->exists();

        if ($sudahPinjam) {
            return back()->with('error', 'Kamu sudah meminjam buku ini!');
        }

        Peminjaman::create([
            'id_user'              => $user->id_user,
            'id_buku'              => $id,
            'tanggal_pinjam'       => now()->toDateString(),
            'tanggal_batas_pinjam' => now()->addDays(7)->toDateString(),
            'status_peminjaman'    => 'aktif',
        ]);

        $buku->jumlah_buku -= 1;
        $buku->save();

        return redirect()->route('member.buku')
            ->with('success', 'Buku berhasil dipinjam! Batas pengembalian ' . now()->addDays(7)->format('d M Y'));
    }
    public function rakBuku()
{
    $user = Auth::user();
    $bukuDipinjam = Peminjaman::where('id_user', $user->id_user)
        ->where('status_peminjaman', 'aktif')
        ->with(['buku.kategoris'])
        ->latest('id_peminjam')
        ->get();

    return view('member.rak-buku', compact('bukuDipinjam'));
}

public function profil()
{
    $user   = Auth::user();
    $member = \App\Models\Member::where('id_user', $user->id_user)->first();
    return view('member.profil', compact('user', 'member'));
}

public function updateProfil(Request $request)
{
    $user   = Auth::user();
    $member = \App\Models\Member::where('id_user', $user->id_user)->first();

    $request->validate([
        'nama'          => 'required|string|max:40',
        'nohp'          => 'nullable|string|max:15',
        'tempat_lahir'  => 'nullable|string|max:30',
        'tanggal_lahir' => 'nullable|date',
        'jenis_kelamin' => 'nullable|in:L,P',
        'agama'         => 'nullable|string|max:10',
    ]);

    $member->update([
        'nama'          => $request->nama,
        'nohp'          => $request->nohp,
        'tempat_lahir'  => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'agama'         => $request->agama,
    ]);

    return back()->with('success', 'Profil berhasil diperbarui!');
}
}