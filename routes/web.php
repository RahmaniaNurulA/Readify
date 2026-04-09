<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('member.dashboard');
    }
    return view('welcome');
})->name('home');

// ── GUEST ──────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// ── AUTH ───────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/member/dashboard', [DashboardController::class, 'memberDashboard'])->name('member.dashboard');
});

// ── ADMIN ──────────────────────────────────────────
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // Buku
    Route::get('/buku',           [BukuController::class, 'index'])   ->name('buku.index');
    Route::get('/buku/create',    [BukuController::class, 'create'])  ->name('buku.create');
    Route::post('/buku',          [BukuController::class, 'store'])   ->name('buku.store');
    Route::get('/buku/{id}',      [BukuController::class, 'show'])    ->name('buku.show');
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])    ->name('buku.edit');
    Route::put('/buku/{id}',      [BukuController::class, 'update'])  ->name('buku.update');
    Route::delete('/buku/{id}',   [BukuController::class, 'destroy']) ->name('buku.destroy');

    // Kategori
    Route::get('/kategori',                [KategoriController::class, 'index'])     ->name('kategori.index');
    Route::post('/kategori',               [KategoriController::class, 'store'])     ->name('kategori.store');
    Route::put('/kategori/{id}',           [KategoriController::class, 'update'])    ->name('kategori.update');
    Route::delete('/kategori/{id}',        [KategoriController::class, 'destroy'])   ->name('kategori.destroy');
    Route::post('/kategori/{id}/buku',     [KategoriController::class, 'addBuku'])   ->name('kategori.addBuku');
    Route::delete('/kategori/{id}/buku',   [KategoriController::class, 'removeBuku'])->name('kategori.removeBuku');

    //peminjaman
    Route::get('/peminjaman',              [PeminjamanController::class, 'index'])   ->name('peminjaman.index');
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('peminjaman', PeminjamanController::class)->only(['index','destroy']);
    Route::patch('peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])
         ->name('peminjaman.kembalikan');
    });

    //anggota
    Route::get('/anggota',          [MemberController::class, 'index'])->name('anggota.index');
    Route::post('/anggota',         [MemberController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{id}',     [MemberController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}',  [MemberController::class, 'destroy'])->name('anggota.destroy');
});

//member
Route::get('/member/buku', [App\Http\Controllers\MemberController::class, 'daftarBuku'])->name('member.buku');
Route::get('/member/buku/{id}', [App\Http\Controllers\MemberController::class, 'detailBuku'])->name('member.buku.detail');
Route::post('/member/buku/{id}/pinjam', [App\Http\Controllers\MemberController::class, 'pinjamBuku'])->name('member.buku.pinjam');
Route::get('/member/rak-buku', [App\Http\Controllers\MemberController::class, 'rakBuku'])->name('member.rak');
Route::get('/member/profil', [App\Http\Controllers\MemberController::class, 'profil'])->name('member.profil');
Route::post('/member/profil', [App\Http\Controllers\MemberController::class, 'updateProfil'])->name('member.profil.update');