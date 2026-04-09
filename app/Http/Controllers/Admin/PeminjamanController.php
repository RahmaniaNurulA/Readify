<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['buku', 'pengguna'])  // ← ganti 'user' jadi 'pengguna'
            ->when($request->status, fn($q) => $q->where('status_peminjaman', $request->status))
            ->when($request->search, fn($q) => $q->whereHas('buku', fn($b) =>
                $b->where('judul_buku', 'like', "%{$request->search}%")
            )->orWhereHas('pengguna', fn($u) =>  // ← ganti 'user' jadi 'pengguna'
                $u->where('email', 'like', "%{$request->search}%")
            ))
            ->latest('tanggal_pinjam');

        return view('admin.peminjaman.index', [
            'peminjaman'        => $query->paginate(15)->withQueryString(),
            'totalAktif'        => Peminjaman::where('status_peminjaman', 'aktif')->count(),
            'totalKadaluarsa'   => Peminjaman::where('status_peminjaman', 'kadaluarsa')->count(),
            'totalDikembalikan' => Peminjaman::where('status_peminjaman', 'dikembalikan')->count(),
            'totalSemua'        => Peminjaman::count(),
        ]);
    }

    public function kembalikan(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status_peminjaman' => 'dikembalikan']);
        $peminjaman->buku->increment('stok');
        return back()->with('success', 'Buku berhasil dikembalikan dan stok diperbarui.');
    }
}