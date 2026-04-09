<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalAnggota    = DB::table('pengguna')->where('role', 'member')->count();
        $totalBuku       = DB::table('buku')->count();
        $totalPeminjaman = DB::table('peminjaman')->where('status', 'dipinjam')->count();
        $totalKategori   = DB::table('kategori_buku')->count();

        // ── AKTIVITAS LOGIN (7 hari terakhir) ───────────────────
        $rawLogin = DB::table('pengguna')
            ->select(
                DB::raw('DATE(last_login) as tanggal'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereNotNull('last_login')
            ->where('last_login', '>=', now()->subDays(6)->startOfDay())
            ->groupBy(DB::raw('DATE(last_login)'))
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

        // ── PENGGUNA TERBARU ─────────────────────────────────────
        $recentUsers = DB::table('pengguna')
            ->orderBy('tanggal_daftar', 'desc')
            ->limit(5)
            ->get();

        dd($loginActivity);
        
        return view('admin.dashboard', compact(
            'totalAnggota',
            'totalBuku',
            'totalPeminjaman',
            'totalKategori',
            'loginActivity',
            'recentUsers'
        ));
    }
}