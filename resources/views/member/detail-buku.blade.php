<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $buku->judul_buku }} — Readify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg:  #0D1117;
            --sidebar-w:   240px;
            --accent:      #84CC16;
            --accent-dark: #16A34A;
            --body-bg:     #F7F8FA;
            --white:       #ffffff;
            --text-dark:   #0F172A;
            --text-muted:  #64748B;
            --border:      #E8ECF0;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04);
            --grad-lime:   linear-gradient(135deg, #84CC16, #BEF264);
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--body-bg); color: var(--text-dark); display: flex; min-height: 100vh; }

        /* SIDEBAR sama seperti halaman lain */
        .sidebar { width: var(--sidebar-w); background: var(--sidebar-bg); min-height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 200; }
        .sidebar-brand { padding: 1.5rem 1.5rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .brand-logo { font-size: 1.5rem; font-weight: 800; background: var(--grad-lime); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-decoration: none; display: block; }
        .brand-sub { font-size: 0.68rem; color: rgba(255,255,255,0.25); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 2px; }
        .sidebar-user { display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .user-ava { width: 36px; height: 36px; border-radius: 50%; background: var(--grad-lime); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; color: #071A14; flex-shrink: 0; }
        .user-info-name { font-size: 0.82rem; font-weight: 600; color: rgba(255,255,255,0.85); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px; }
        .user-info-role { font-size: 0.68rem; color: var(--accent); font-weight: 600; text-transform: uppercase; }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .nav-section-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.2); padding: 0.75rem 1.5rem 0.35rem; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 1.5rem; color: rgba(255,255,255,0.45); text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s; border-left: 3px solid transparent; }
        .nav-item i { width: 16px; text-align: center; font-size: 0.9rem; }
        .nav-item:hover { color: rgba(255,255,255,0.85); background: rgba(255,255,255,0.04); }
        .nav-item.active { color: var(--accent); background: rgba(132,204,22,0.08); border-left-color: var(--accent); font-weight: 600; }
        .sidebar-footer { padding: 1rem 1.25rem; border-top: 1px solid rgba(255,255,255,0.06); }
        .logout-btn { display: flex; align-items: center; gap: 0.7rem; width: 100%; padding: 0.65rem 1rem; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.18); border-radius: 10px; color: #fca5a5; font-size: 0.85rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: all 0.2s; }
        .logout-btn:hover { background: rgba(239,68,68,0.2); color: #fff; }

        .main-wrapper { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar { height: 68px; background: var(--white); border-bottom: 1px solid var(--border); display: flex; align-items: center; padding: 0 2rem; position: sticky; top: 0; z-index: 100; gap: 1rem; }
        .back-btn { display: flex; align-items: center; gap: 0.5rem; color: var(--text-muted); text-decoration: none; font-size: 0.875rem; font-weight: 600; transition: color 0.2s; }
        .back-btn:hover { color: var(--text-dark); }
        .topbar-title { font-size: 1rem; font-weight: 700; color: var(--text-dark); }

        .content { padding: 2rem; flex: 1; }

        /* DETAIL CARD */
        .detail-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: 450px;
        }

        .book-cover-section {
            background: linear-gradient(135deg, #0D3D26, #071A14);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            gap: 1.5rem;
        }

        .book-cover-img {
            width: 180px;
            height: 260px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }

        .book-cover-placeholder-big {
            width: 180px;
            height: 260px;
            background: rgba(132,204,22,0.08);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--accent);
            opacity: 0.4;
        }

        .stok-badge {
            padding: 0.4rem 1.2rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
        }
        .stok-ada { background: rgba(132,204,22,0.15); color: var(--accent-dark); }
        .stok-habis { background: rgba(239,68,68,0.1); color: #ef4444; }

        .book-detail-section {
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
        }

        .book-kategori-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.8rem;
            background: rgba(132,204,22,0.1);
            color: var(--accent-dark);
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            width: fit-content;
        }

        .book-judul {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .book-pengarang {
            font-size: 1rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .book-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1.25rem;
            background: var(--body-bg);
            border-radius: 14px;
        }

        .meta-item label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            display: block;
            margin-bottom: 0.2rem;
        }

        .meta-item span {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .book-sinopsis {
            flex: 1;
            margin-bottom: 2rem;
        }

        .book-sinopsis h4 {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .book-sinopsis p {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-pinjam {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.85rem 2rem;
            background: var(--grad-lime);
            border: none;
            border-radius: 999px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: inherit;
            color: #071A14;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-pinjam:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(132,204,22,0.4); }
        .btn-pinjam:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 1.5rem;
            background: var(--body-bg);
            border: 1.5px solid var(--border);
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: inherit;
            color: var(--text-muted);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover { border-color: var(--accent); color: var(--accent-dark); }

        .alert {
            padding: 0.85rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #22c55e; color: #15803d; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444; color: #dc2626; }

        .content-footer { padding: 1rem 2rem; border-top: 1px solid var(--border); background: var(--white); font-size: 0.78rem; color: var(--text-muted); display: flex; justify-content: space-between; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}" class="brand-logo">Readify</a>
        <div class="brand-sub">Perpustakaan Digital</div>
    </div>
    <div class="sidebar-user">
        <div class="user-ava">{{ strtoupper(substr(Auth::user()->email, 0, 1)) }}</div>
        <div>
            <div class="user-info-name">{{ Auth::user()->email }}</div>
            <div class="user-info-role">Member</div>
        </div>
    </div>
    <nav class="sidebar-nav">
    <div class="nav-section-label">Menu</div>
    <a href="{{ route('member.dashboard') }}" class="nav-item"><i class="fas fa-home"></i> Beranda</a>
    <a href="{{ route('member.buku') }}" class="nav-item active"><i class="fas fa-book-open"></i> Daftar Buku</a>
    <a href="{{ route('member.rak') }}" class="nav-item"><i class="fas fa-bookmark"></i> Rak Buku</a>
    <div class="nav-section-label">Akun</div>
    <a href="{{ route('member.profil') }}" class="nav-item"><i class="fas fa-user-circle"></i> Profil</a>
</nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</aside>

<div class="main-wrapper">
    <header class="topbar">
        <a href="{{ route('member.buku') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <span style="color:var(--border);margin:0 0.5rem;">|</span>
        <span class="topbar-title">Detail Buku</span>
    </header>

    <main class="content">

        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><i class="fas fa-circle-xmark"></i> {{ session('error') }}</div>
        @endif

        <div class="detail-card">
            {{-- Cover --}}
            <div class="book-cover-section">
                @if($buku->cover)
                    <img src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul_buku }}" class="book-cover-img">
                @else
                    <div class="book-cover-placeholder-big"><i class="fas fa-book"></i></div>
                @endif
                <span class="stok-badge {{ $buku->jumlah_buku > 0 ? 'stok-ada' : 'stok-habis' }}">
                    <i class="fas fa-cubes"></i>
                    {{ $buku->jumlah_buku > 0 ? $buku->jumlah_buku . ' Stok Tersedia' : 'Stok Habis' }}
                </span>
            </div>

            {{-- Detail --}}
            <div class="book-detail-section">
                <div class="book-kategori-tag">
                    <i class="fas fa-tag"></i>
                    {{ $buku->kategoris->first()->nama_kategori ?? 'Umum' }}
                </div>

                <h1 class="book-judul">{{ $buku->judul_buku }}</h1>
                <p class="book-pengarang">oleh <strong>{{ $buku->pengarang }}</strong></p>

                <div class="book-meta-grid">
                    <div class="meta-item">
                        <label><i class="fas fa-building"></i> Penerbit</label>
                        <span>{{ $buku->penerbit ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <label><i class="fas fa-calendar"></i> Tahun Terbit</label>
                        <span>{{ $buku->tahun_terbit ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <label><i class="fas fa-clock"></i> Durasi Pinjam</label>
                        <span>7 Hari</span>
                    </div>
                    <div class="meta-item">
                        <label><i class="fas fa-cubes"></i> Stok</label>
                        <span>{{ $buku->jumlah_buku }} buku</span>
                    </div>
                </div>

                @if($buku->sinopsis)
                <div class="book-sinopsis">
                    <h4>Sinopsis</h4>
                    <p>{{ $buku->sinopsis }}</p>
                </div>
                @endif

                <div class="action-buttons">
    @php
        $sudahPinjam = Auth::check() ? \App\Models\Peminjaman::where('id_user', Auth::user()->id_user)
            ->where('id_buku', $buku->id_buku)
            ->where('status_peminjaman', 'aktif')
            ->exists() : false;
    @endphp

    @if($sudahPinjam)
        {{-- Sudah pinjam: tampilkan tombol baca --}}
        @if($buku->file_buku)
            <a href="{{ asset('storage/' . $buku->file_buku) }}" target="_blank" class="btn-pinjam">
                <i class="fas fa-book-reader"></i> Baca Buku
            </a>
        @endif
        <span style="font-size:0.8rem; color:var(--accent-dark); display:flex; align-items:center; gap:0.4rem;">
            <i class="fas fa-circle-check"></i> Sedang Dipinjam
        </span>
    @else
        {{-- Belum pinjam: tampilkan tombol pinjam --}}
        <form method="POST" action="{{ route('member.buku.pinjam', $buku->id_buku) }}">
            @csrf
            <button type="submit" class="btn-pinjam" {{ $buku->jumlah_buku <= 0 ? 'disabled' : '' }}>
                <i class="fas fa-hand-holding-heart"></i>
                {{ $buku->jumlah_buku > 0 ? 'Pinjam Buku Ini' : 'Stok Habis' }}
            </button>
        </form>
    @endif

    <a href="{{ route('member.buku') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
            </div>
        </div>

    </main>

    <footer class="content-footer">
        <span>© {{ date('Y') }} <strong>Readify</strong>. All Rights Reserved</span>
        <span>Login: <strong>{{ Auth::user()->email }}</strong></span>
    </footer>
</div>

</body>
</html>