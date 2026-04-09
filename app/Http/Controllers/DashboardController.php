<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
{
    $totalAnggota    = Member::count();
    $totalBuku       = Buku::count();
    $totalPeminjaman = Peminjaman::count();
    $totalKategori   = \App\Models\Kategori::count();
    $recentUsers     = User::latest('tanggal_daftar')->take(5)->get();

    // ── AKTIVITAS LOGIN (7 hari terakhir) ───────────────────
    $rawLogin = \DB::table('pengguna')
        ->select(
            \DB::raw('DATE(last_login) as tanggal'),
            \DB::raw('COUNT(*) as jumlah')
        )
        ->whereNotNull('last_login')
        ->where('last_login', '>=', now()->subDays(6)->startOfDay())
        ->groupBy(\DB::raw('DATE(last_login)'))
        ->orderBy('tanggal')
        ->get();

    $loginActivity = collect();
    for ($i = 6; $i >= 0; $i--) {
        $date  = now()->subDays($i)->format('Y-m-d');
        $found = $rawLogin->firstWhere('tanggal', $date);
        $loginActivity->push([
            'tanggal' => now()->subDays($i)->format('d M'),
            'jumlah'  => $found ? (int) $found->jumlah : 0,
        ]);
    }

    $loginActivity = $loginActivity->values()->toArray();

    return view('admin.dashboard', compact(
        'totalAnggota',
        'totalBuku',
        'totalPeminjaman',
        'totalKategori',
        'recentUsers',
        'loginActivity'
    ));
}

    public function memberDashboard()
{
    $user = Auth::user();
    
    $sedangDipinjam = Peminjaman::where('id_user', $user->id_user)
    ->where('status_peminjaman', 'aktif')
    ->count();

$totalDibaca = Peminjaman::where('id_user', $user->id_user)
    ->where('status_peminjaman', 'kadaluarsa')
    ->count();

    $riwayatPeminjaman = Peminjaman::where('id_user', $user->id_user)
    ->with(['buku.kategoris'])
    ->latest('id_peminjam')
    ->take(6)
    ->get();

    return view('member.dashboard', compact(
        'sedangDipinjam',
        'totalDibaca',
        'riwayatPeminjaman'
    ));
}
}