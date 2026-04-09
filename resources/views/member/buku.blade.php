<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku — Readify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg:  #0D1117;
            --sidebar-w:   240px;
            --topbar-h:    68px;
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

        /* SIDEBAR */
        .sidebar { width: var(--sidebar-w); background: var(--sidebar-bg); min-height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 200; }
        .sidebar-brand { padding: 1.5rem 1.5rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .brand-logo { font-size: 1.5rem; font-weight: 800; background: var(--grad-lime); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-decoration: none; display: block; }
        .brand-sub { font-size: 0.68rem; color: rgba(255,255,255,0.25); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 2px; }
        .sidebar-user { display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .user-ava { width: 36px; height: 36px; border-radius: 50%; background: var(--grad-lime); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; color: #071A14; flex-shrink: 0; }
        .user-info-name { font-size: 0.82rem; font-weight: 600; color: rgba(255,255,255,0.85); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px; }
        .user-info-role { font-size: 0.68rem; color: var(--accent); font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; }
        .sidebar-nav { padding: 1rem 0; flex: 1; overflow-y: auto; }
        .nav-section-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.2); padding: 0.75rem 1.5rem 0.35rem; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 1.5rem; color: rgba(255,255,255,0.45); text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s; border-left: 3px solid transparent; }
        .nav-item i { width: 16px; text-align: center; font-size: 0.9rem; flex-shrink: 0; }
        .nav-item:hover { color: rgba(255,255,255,0.85); background: rgba(255,255,255,0.04); }
        .nav-item.active { color: var(--accent); background: rgba(132,204,22,0.08); border-left-color: var(--accent); font-weight: 600; }
        .sidebar-footer { padding: 1rem 1.25rem; border-top: 1px solid rgba(255,255,255,0.06); }
        .logout-btn { display: flex; align-items: center; gap: 0.7rem; width: 100%; padding: 0.65rem 1rem; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.18); border-radius: 10px; color: #fca5a5; font-size: 0.85rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: all 0.2s; }
        .logout-btn:hover { background: rgba(239,68,68,0.2); color: #fff; }

        /* MAIN */
        .main-wrapper { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { height: var(--topbar-h); background: var(--white); border-bottom: 1px solid var(--border); display: flex; align-items: center; padding: 0 2rem; position: sticky; top: 0; z-index: 100; gap: 1rem; }
        .topbar-title { font-size: 1rem; font-weight: 700; color: var(--text-dark); }
        .topbar-actions { display: flex; align-items: center; gap: 0.75rem; margin-left: auto; }
        .topbar-icon-btn { width: 38px; height: 38px; border-radius: 50%; background: var(--body-bg); border: 1.5px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--text-muted); cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .topbar-icon-btn:hover { background: var(--white); color: var(--text-dark); }

        /* CONTENT */
        .content { padding: 1.75rem 2rem; flex: 1; }

        /* SEARCH & FILTER */
        .search-filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .search-wrap {
            flex: 1;
            min-width: 220px;
            position: relative;
        }
        .search-wrap i {
            position: absolute;
            left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        .search-input {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 2.75rem;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 999px;
            font-size: 0.875rem;
            font-family: inherit;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s;
        }
        .search-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(132,204,22,0.1); }
        .filter-select {
            padding: 0.7rem 1.2rem;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 999px;
            font-size: 0.875rem;
            font-family: inherit;
            color: var(--text-dark);
            outline: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-select:focus { border-color: var(--accent); }
        .btn-search {
            padding: 0.7rem 1.5rem;
            background: var(--grad-lime);
            border: none;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: inherit;
            color: #071A14;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-search:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(132,204,22,0.35); }

        /* RESULT INFO */
        .result-info {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.25rem;
        }
        .result-info strong { color: var(--text-dark); }

        /* BOOK GRID */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
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
            display: flex;
            flex-direction: column;
        }
        .book-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,0.1); }
        .book-cover {
            width: 100%; height: 210px;
            background: linear-gradient(135deg, #1a2a1a, #0D3D26);
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }
        .book-cover img { width: 100%; height: 100%; object-fit: cover; }
        .book-cover-placeholder { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; opacity: 0.3; }
        .book-cover-placeholder i { font-size: 2.5rem; color: var(--accent); }
        .book-badge { position: absolute; top: 0.6rem; left: 0.6rem; padding: 0.2rem 0.55rem; border-radius: 6px; font-size: 0.65rem; font-weight: 700; }
        .badge-new { background: var(--accent); color: #071A14; }
        .book-info { padding: 0.9rem; flex: 1; display: flex; flex-direction: column; }
        .book-title { font-size: 0.83rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.2rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.35; }
        .book-author { font-size: 0.72rem; color: var(--text-muted); margin-bottom: 0.5rem; }
        .book-meta { display: flex; align-items: center; justify-content: space-between; margin-top: auto; }
        .book-category { font-size: 0.65rem; font-weight: 600; padding: 0.18rem 0.5rem; background: rgba(132,204,22,0.1); color: var(--accent-dark); border-radius: 6px; }
        .book-stok { font-size: 0.7rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.2rem; }
        .book-stok.habis { color: #ef4444; }

        /* EMPTY STATE */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }
        .empty-state i { font-size: 3rem; opacity: 0.2; display: block; margin-bottom: 1rem; }
        .empty-state p { font-size: 0.9rem; }

        /* FOOTER */
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
        <a href="{{ route('member.dashboard') }}" class="nav-item">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="{{ route('member.buku') }}" class="nav-item active">
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

<div class="main-wrapper">
    <header class="topbar">
        <span class="topbar-title"><i class="fas fa-book-open" style="color:var(--accent);margin-right:0.5rem;"></i>Daftar Buku</span>
    </header>

    <main class="content">

        {{-- SEARCH & FILTER --}}
        <form method="GET" action="{{ route('member.buku') }}">
            <div class="search-filter-bar">
                <div class="search-wrap">
                    <i class="fas fa-search"></i>
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        placeholder="Cari judul, pengarang, penerbit..."
                        value="{{ $search ?? '' }}"
                    >
                </div>
                <select name="kategori" class="filter-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id_kategori }}" {{ ($kategori ?? '') == $kat->id_kategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if($search || $kategori)
                    <a href="{{ route('member.buku') }}" style="font-size:0.85rem; color:var(--text-muted); text-decoration:none; align-self:center;">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- RESULT INFO --}}
        <div class="result-info">
            Menampilkan <strong>{{ $bukus->count() }}</strong> buku
            @if($search) untuk pencarian "<strong>{{ $search }}</strong>" @endif
            @if($kategori) dalam kategori "<strong>{{ $kategoris->find($kategori)?->nama_kategori }}</strong>" @endif
        </div>

        {{-- BOOK GRID --}}
        <div class="books-grid">
            @forelse($bukus as $buku)
            <a href="{{ route('member.buku.detail', $buku->id_buku) }}" class="book-card">
                <div class="book-cover">
                    @if($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul_buku }}">
                    @else
                        <div class="book-cover-placeholder">
                            <i class="fas fa-book"></i>
                        </div>
                    @endif
                    @if($buku->jumlah_buku > 0)
                        <span class="book-badge badge-new">Tersedia</span>
                    @endif
                </div>
                <div class="book-info">
                    <div class="book-title">{{ $buku->judul_buku }}</div>
                    <div class="book-author">{{ $buku->pengarang }}</div>
                    <div class="book-meta">
                        <span class="book-category">
                            {{ $buku->kategoris->first()->nama_kategori ?? 'Umum' }}
                        </span>
                        <span class="book-stok {{ $buku->jumlah_buku <= 0 ? 'habis' : '' }}">
                            <i class="fas fa-cubes"></i>
                            {{ $buku->jumlah_buku > 0 ? $buku->jumlah_buku . ' stok' : 'Habis' }}
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <p>Tidak ada buku yang ditemukan.</p>
            </div>
            @endforelse
        </div>

    </main>

    <footer class="content-footer">
        <span>© {{ date('Y') }} <strong>Readify</strong>. All Rights Reserved</span>
        <span>Login: <strong>{{ Auth::user()->email }}</strong></span>
    </footer>
</div>

</body>
</html>