<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — Readify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg:   #0D1117;
            --sidebar-w:    240px;
            --topbar-h:     68px;
            --accent:       #84CC16;
            --accent-2:     #BEF264;
            --accent-dark:  #16A34A;
            --body-bg:      #F7F8FA;
            --white:        #ffffff;
            --text-dark:    #0F172A;
            --text-muted:   #64748B;
            --border:       #E8ECF0;
            --card-shadow:  0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04);
            --grad-lime:    linear-gradient(135deg, #84CC16, #BEF264);
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--body-bg);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* ════════════════════════════════════
           SIDEBAR
        ════════════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 200;
        }

        .sidebar-brand {
            padding: 1.5rem 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--grad-lime);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
            text-decoration: none;
            display: block;
        }

        .brand-sub {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.25);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* User info di sidebar */
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .user-ava {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--grad-lime);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 700; color: #071A14;
            flex-shrink: 0;
        }

        .user-info-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: rgba(255,255,255,0.85);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .user-info-role {
            font-size: 0.68rem;
            color: var(--accent);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .sidebar-nav { padding: 1rem 0; flex: 1; overflow-y: auto; }

        .nav-section-label {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.2);
            padding: 0.75rem 1.5rem 0.35rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.5rem;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            position: relative;
        }

        .nav-item i {
            width: 16px;
            text-align: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .nav-item:hover {
            color: rgba(255,255,255,0.85);
            background: rgba(255,255,255,0.04);
        }

        .nav-item.active {
            color: var(--accent);
            background: rgba(132,204,22,0.08);
            border-left-color: var(--accent);
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            width: 100%;
            padding: 0.65rem 1rem;
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.18);
            border-radius: 10px;
            color: #fca5a5;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: rgba(239,68,68,0.2);
            color: #fff;
        }

        /* ════════════════════════════════════
           MAIN WRAPPER
        ════════════════════════════════════ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ════════════════════════════════════
           TOPBAR — search bar sesuai sketsa
        ════════════════════════════════════ */
        .topbar {
            height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            gap: 1rem;
            box-shadow: 0 1px 0 var(--border);
        }

        .search-bar {
            flex: 1;
            max-width: 560px;
            position: relative;
        }

        .search-bar i {
            position: absolute;
            left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 0.65rem 1rem 0.65rem 2.75rem;
            background: var(--body-bg);
            border: 1.5px solid var(--border);
            border-radius: 999px;
            font-size: 0.875rem;
            font-family: inherit;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s;
        }

        .search-input::placeholder { color: var(--text-muted); }

        .search-input:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(132,204,22,0.1);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-left: auto;
        }

        .topbar-icon-btn {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: var(--body-bg);
            border: 1.5px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            position: relative;
        }

        .topbar-icon-btn:hover {
            background: var(--white);
            color: var(--text-dark);
            border-color: #d1d5db;
        }

        .notif-dot {
            position: absolute;
            top: 6px; right: 6px;
            width: 7px; height: 7px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid var(--body-bg);
        }

        /* ════════════════════════════════════
           CONTENT
        ════════════════════════════════════ */
        .content { padding: 1.75rem 2rem; flex: 1; }

        /* ── Greeting ── */
        .greeting {
            margin-bottom: 1.5rem;
        }

        .greeting h2 {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.02em;
        }

        .greeting p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* ── HERO IMAGE sesuai sketsa ── */
        .hero-section {
            width: 100%;
            height: 260px;
            border-radius: 18px;
            overflow: hidden;
            position: relative;
            margin-bottom: 1.75rem;
            background: linear-gradient(135deg, #0D3D26 0%, #071A14 60%, #1a2a1a 100%);
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        }

        /* Slot untuk hero image — ganti src saat gambar sudah ada */
        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            opacity: 0.55;
        }

        /* Overlay text di atas hero */
        .hero-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem 2.5rem;
            background: linear-gradient(90deg, rgba(7,26,20,0.75) 0%, rgba(7,26,20,0.2) 100%);
        }

        .hero-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .hero-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            letter-spacing: -0.02em;
            max-width: 400px;
            margin-bottom: 1rem;
        }

        .hero-title span {
            background: var(--grad-lime);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.4rem;
            background: var(--grad-lime);
            color: #071A14;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            width: fit-content;
        }

        .hero-cta:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(132,204,22,0.4); }

        /* Placeholder saat belum ada gambar */
        .hero-placeholder {
            position: absolute;
            right: 2rem; top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            opacity: 0.2;
        }

        .hero-placeholder i { font-size: 3rem; color: var(--accent); }
        .hero-placeholder span { font-size: 0.75rem; color: #fff; font-weight: 600; }

        /* ── KATEGORI TABS sesuai sketsa ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .see-all {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--accent-dark);
            text-decoration: none;
        }

        .see-all:hover { text-decoration: underline; }

        .category-tabs {
            display: flex;
            gap: 0.6rem;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
        }

        .cat-tab {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: 1.5px solid var(--border);
            background: var(--white);
            color: var(--text-muted);
            white-space: nowrap;
        }

        .cat-tab:hover {
            border-color: var(--accent);
            color: var(--accent-dark);
            background: rgba(132,204,22,0.06);
        }

        .cat-tab.active {
            background: var(--grad-lime);
            border-color: transparent;
            color: #071A14;
            box-shadow: 0 2px 10px rgba(132,204,22,0.3);
        }

        .cat-tab i { font-size: 0.75rem; }

        /* ── BOOK GRID ── */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .book-card {
            background: var(--white);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .book-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 28px rgba(0,0,0,0.1);
        }

        .book-cover {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1a2a1a, #0D3D26);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .book-cover-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            opacity: 0.3;
        }

        .book-cover-placeholder i { font-size: 2.5rem; color: var(--accent); }

        .book-badge {
            position: absolute;
            top: 0.6rem; left: 0.6rem;
            padding: 0.2rem 0.55rem;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .badge-new  { background: var(--accent); color: #071A14; }
        .badge-pop  { background: #3b82f6; color: #fff; }
        .badge-fav  { background: #f59e0b; color: #fff; }

        .book-info { padding: 0.85rem; }

        .book-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.2rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.35;
        }

        .book-author {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-bottom: 0.6rem;
        }

        .book-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .book-category {
            font-size: 0.65rem;
            font-weight: 600;
            padding: 0.18rem 0.5rem;
            background: rgba(132,204,22,0.1);
            color: var(--accent-dark);
            border-radius: 6px;
        }

        .book-rating {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.7rem;
            color: #f59e0b;
            font-weight: 600;
        }

        /* ── QUICK STATS ── */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .qs-card {
            background: var(--white);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            border-left: 4px solid transparent;
        }

        .qs-card.blue   { border-left-color: #3b82f6; }
        .qs-card.lime   { border-left-color: var(--accent); }
        .qs-card.amber  { border-left-color: #f59e0b; }

        .qs-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .qs-card.blue  .qs-icon { background: #eff6ff; color: #3b82f6; }
        .qs-card.lime  .qs-icon { background: rgba(132,204,22,0.12); color: var(--accent-dark); }
        .qs-card.amber .qs-icon { background: #fffbeb; color: #f59e0b; }

        .qs-num {
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 2px;
        }

        .qs-card.blue  .qs-num { color: #3b82f6; }
        .qs-card.lime  .qs-num { color: var(--accent-dark); }
        .qs-card.amber .qs-num { color: #f59e0b; }

        .qs-label {
            font-size: 0.78rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ── ALERT SUCCESS ── */
        .alert-success {
            display: flex; align-items: center; gap: 0.6rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #22c55e;
            border-radius: 10px;
            padding: 0.85rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            color: #15803d;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn { from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }

        /* ── FOOTER ── */
        .content-footer {
            padding: 1rem 2rem;
            border-top: 1px solid var(--border);
            background: var(--white);
            font-size: 0.78rem;
            color: var(--text-muted);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

{{-- ════ SIDEBAR ════ --}}
<aside class="sidebar">

    <div class="sidebar-brand">
        <a href="{{ route('home') }}" class="brand-logo">Readify</a>
        <div class="brand-sub">Perpustakaan Digital</div>
    </div>

    {{-- Info user --}}
    <div class="sidebar-user">
        <div class="user-ava">
            {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
        </div>
        <div>
            <div class="user-info-name">{{ Auth::user()->email }}</div>
            <div class="user-info-role">Member</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu</div>

        <a href="{{ route('member.dashboard') }}" class="nav-item active">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="{{ route('member.buku') }}" class="nav-item">
            <i class="fas fa-book-open"></i> Daftar Buku
        </a>
        <a href="{{ route('member.rak') }}" class="nav-item">
            <i class="fas fa-bookmark"></i> Rak Buku
        </a>

        <div class="nav-section-label">Akun</div>
        <a href="{{ route('member.profil') }}" class="nav-item">
            <i class="fas fa-user-circle"></i> Profil
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- ════ MAIN ════ --}}
<div class="main-wrapper">

    {{-- ── TOPBAR dengan Search ── --}}
    <header class="topbar">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input
                type="text"
                class="search-input"
                placeholder="Cari buku, kategori, pengarang..."
                id="searchInput"
            >
        </div>
    </header>

    {{-- ── CONTENT ── --}}
    <main class="content">

        @if (session('success'))
            <div class="alert-success">
                <i class="fas fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Greeting --}}
        <div class="greeting">
            <h2>Selamat datang kembali! 👋</h2>
            <p>Temukan buku favoritmu dan mulai membaca hari ini.</p>
        </div>

        {{-- ── HERO IMAGE ── --}}
        <div class="hero-section">
            {{--
                Ganti src dengan path gambar hero yang sesuai saat sudah ada.
                Untuk sementara, tampilkan placeholder jika belum ada gambar.
             --}}
            {{-- <img src="{{ asset('path/to/hero-image.jpg') }}" alt="Hero Image" class="hero-img"> --}}

            <div class="hero-overlay">
                <div class="hero-label">✦ Koleksi Terbaru</div>
                <h2 class="hero-title">
                    Jelajahi <span>Ribuan Buku</span><br>Pilihan Terbaik
                </h2>
                <a href="{{ route('member.buku') }}" class="hero-cta">
                    <i class="fas fa-book-open"></i> Lihat Koleksi
                </a>
            </div>
        </div>

        {{-- ── QUICK STATS ── --}}
        <div class="quick-stats">
    <div class="qs-card blue">
        <div class="qs-icon"><i class="fas fa-book"></i></div>
        <div>
            <div class="qs-num">{{ $sedangDipinjam }}</div>
            <div class="qs-label">Sedang Dipinjam</div>
        </div>
    </div>
    <div class="qs-card lime">
        <div class="qs-icon"><i class="fas fa-bookmark"></i></div>
        <div>
            <div class="qs-num">0</div>
            <div class="qs-label">Di Rak Buku</div>
        </div>
    </div>
    <div class="qs-card amber">
        <div class="qs-icon"><i class="fas fa-history"></i></div>
        <div>
            <div class="qs-num">{{ $totalDibaca }}</div>
            <div class="qs-label">Total Dibaca</div>
        </div>
    </div>
</div>

        {{-- ── KATEGORI TABS sesuai sketsa ── --}}
        <div class="section-header">
            <div class="section-title">Jelajahi Koleksi</div>
            <a href="{{ route('member.rak') }}" class="see-all">Lihat semua →</a>
        </div>

        <div class="category-tabs">
            <a href="#" class="cat-tab active" data-tab="aktivitas">
                <i class="fas fa-fire"></i> Aktivitas
            </a>
        </div>

        {{-- ── BOOK GRID ── --}}
       <div class="books-grid">
    @forelse($riwayatPeminjaman as $pinjam)
    <a href="{{ $pinjam->buku ? route('member.buku.detail', $pinjam->buku->id_buku) : '#' }}" class="book-card">
        <div class="book-cover">
            @if($pinjam->buku && $pinjam->buku->cover)
                <img src="{{ asset('storage/' . $pinjam->buku->cover) }}" alt="{{ $pinjam->buku->judul_buku }}">
            @else
                <div class="book-cover-placeholder">
                    <i class="fas fa-book"></i>
                </div>
            @endif
            <span class="book-badge {{ $pinjam->status_peminjaman == 'aktif' ? 'badge-pop' : 'badge-fav' }}">
                {{ $pinjam->status_peminjaman == 'aktif' ? 'Dipinjam' : 'Selesai' }}
            </span>
        </div>
        <div class="book-info">
            <div class="book-title">{{ $pinjam->buku->judul_buku ?? 'Judul tidak tersedia' }}</div>
            <div class="book-author">{{ $pinjam->buku->pengarang ?? '-' }}</div>
            <div class="book-meta">
                <span class="book-category">
                    {{ $pinjam->buku->kategoris->first()->nama_kategori ?? '-' }}
                </span>
                <span class="book-rating" style="color: var(--text-muted); font-size:0.7rem;">
                    <i class="fas fa-calendar"></i> {{ $pinjam->tanggal_pinjam }}
                </span>
            </div>
        </div>
    </a>
    @empty
    <div style="grid-column: 1/-1; text-align:center; padding: 3rem; color: var(--text-muted);">
        <i class="fas fa-book-open" style="font-size:2rem; margin-bottom:0.5rem; display:block; opacity:0.3;"></i>
        Belum ada riwayat peminjaman
    </div>
    @endforelse
</div>

    </main>

    <footer class="content-footer">
        <span>© {{ date('Y') }} <strong>Readify</strong>. All Rights Reserved</span>
        <span>Login: <strong>{{ Auth::user()->email }}</strong></span>
    </footer>

</div>

<script>
    // ── Tab kategori ──────────────────────────────────────────
    document.querySelectorAll('.cat-tab').forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            // Nanti bisa filter buku berdasarkan data-tab
        });
    });

    // ── Auto hide session alert ───────────────────────────────
    setTimeout(() => {
        document.querySelectorAll('.alert-success').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);

    // ── Search input — nanti bisa dihubungkan ke AJAX ─────────
    document.getElementById('searchInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && this.value.trim()) {
            // window.location.href = `/buku?search=${encodeURIComponent(this.value)}`;
        }
    });
</script>

</body>
</html>