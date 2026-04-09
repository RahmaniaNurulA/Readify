<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rak Buku — Readify</title>
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
        .topbar { height: 68px; background: var(--white); border-bottom: 1px solid var(--border); display: flex; align-items: center; padding: 0 2rem; position: sticky; top: 0; z-index: 100; }
        .topbar-title { font-size: 1rem; font-weight: 700; color: var(--text-dark); }
        .topbar-actions { display: flex; align-items: center; gap: 0.75rem; margin-left: auto; }
        .topbar-icon-btn { width: 38px; height: 38px; border-radius: 50%; background: var(--body-bg); border: 1.5px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--text-muted); text-decoration: none; transition: all 0.2s; }

        .content { padding: 1.75rem 2rem; flex: 1; }

        .page-header { margin-bottom: 1.5rem; }
        .page-header h2 { font-size: 1.3rem; font-weight: 800; color: var(--text-dark); }
        .page-header p { font-size: 0.85rem; color: var(--text-muted); margin-top: 2px; }

        /* RAK BUKU CARDS */
        .rak-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.25rem;
        }

        .rak-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            display: flex;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .rak-card:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,0.1); }

        .rak-cover {
            width: 100px;
            min-height: 140px;
            background: linear-gradient(135deg, #0D3D26, #071A14);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .rak-cover img { width: 100%; height: 100%; object-fit: cover; }
        .rak-cover-placeholder { font-size: 2rem; color: var(--accent); opacity: 0.3; }

        .rak-info {
            padding: 1rem 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .rak-kategori {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            background: rgba(132,204,22,0.1);
            color: var(--accent-dark);
            border-radius: 6px;
            width: fit-content;
        }

        .rak-judul {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.3;
        }

        .rak-pengarang {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .rak-dates {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .rak-date-item {
            font-size: 0.72rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .rak-date-item.deadline {
            color: #ef4444;
            font-weight: 600;
        }

        .rak-date-item.deadline.aman {
            color: var(--accent-dark);
        }

        .rak-actions {
            padding: 0.75rem 1.25rem 1rem;
            display: flex;
            gap: 0.5rem;
            border-top: 1px solid var(--border);
            margin-top: 0.5rem;
        }

        .btn-baca {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.55rem 1rem;
            background: var(--grad-lime);
            border: none;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: inherit;
            color: #071A14;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-baca:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(132,204,22,0.35); }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.55rem 1rem;
            background: var(--body-bg);
            border: 1.5px solid var(--border);
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            font-family: inherit;
            color: var(--text-muted);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-detail:hover { border-color: var(--accent); color: var(--accent-dark); }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--text-muted);
        }
        .empty-state i { font-size: 4rem; opacity: 0.15; display: block; margin-bottom: 1rem; }
        .empty-state h3 { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem; }
        .empty-state p { font-size: 0.875rem; margin-bottom: 1.5rem; }
        .btn-cari-buku {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.5rem;
            background: var(--grad-lime);
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 700;
            color: #071A14;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-cari-buku:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(132,204,22,0.35); }

        .content-footer { padding: 1rem 2rem; border-top: 1px solid var(--border); background: var(--white); font-size: 0.78rem; color: var(--text-muted); display: flex; justify-content: space-between; }

        .alert { padding: 0.85rem 1.25rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.875rem; display: flex; align-items: center; gap: 0.6rem; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #22c55e; color: #15803d; }
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
        <a href="{{ route('member.buku') }}" class="nav-item"><i class="fas fa-book-open"></i> Daftar Buku</a>
        <a href="{{ route('member.rak') }}" class="nav-item active"><i class="fas fa-bookmark"></i> Rak Buku</a>
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
        <span class="topbar-title"><i class="fas fa-bookmark" style="color:var(--accent);margin-right:0.5rem;"></i>Rak Buku Saya</span>
    </header>

    <main class="content">

        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <div class="page-header">
            <h2>Rak Buku Saya 📚</h2>
            <p>Buku yang sedang kamu pinjam saat ini.</p>
        </div>

        @if($bukuDipinjam->count() > 0)
        <div class="rak-grid">
            @foreach($bukuDipinjam as $pinjam)
            @php
                $batasDate = \Carbon\Carbon::parse($pinjam->tanggal_batas_pinjam);
                $today     = \Carbon\Carbon::today();
                $sisaHari  = $today->diffInDays($batasDate, false);
                $aman      = $sisaHari >= 3;
            @endphp
            <div class="rak-card">
                <div style="display:flex; flex-direction:column; flex:1;">
                    <div style="display:flex;">
                        <div class="rak-cover">
                            @if($pinjam->buku && $pinjam->buku->cover)
                                <img src="{{ asset('storage/' . $pinjam->buku->cover) }}" alt="">
                            @else
                                <div class="rak-cover-placeholder"><i class="fas fa-book"></i></div>
                            @endif
                        </div>
                        <div class="rak-info">
                            <span class="rak-kategori">{{ $pinjam->buku->kategoris->first()->nama_kategori ?? 'Umum' }}</span>
                            <div class="rak-judul">{{ $pinjam->buku->judul_buku ?? '-' }}</div>
                            <div class="rak-pengarang">{{ $pinjam->buku->pengarang ?? '-' }}</div>
                            <div class="rak-dates">
                                <div class="rak-date-item">
                                    <i class="fas fa-calendar-plus"></i>
                                    Dipinjam: {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}
                                </div>
                                <div class="rak-date-item deadline {{ $aman ? 'aman' : '' }}">
                                    <i class="fas fa-calendar-xmark"></i>
                                    Batas: {{ $batasDate->format('d M Y') }}
                                    ({{ $sisaHari > 0 ? $sisaHari . ' hari lagi' : 'Sudah lewat!' }})
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rak-actions">
                        @if($pinjam->buku && $pinjam->buku->file_buku)
                            <a href="{{ asset('storage/' . $pinjam->buku->file_buku) }}" target="_blank" class="btn-baca">
                                <i class="fas fa-book-reader"></i> Baca
                            </a>
                        @endif
                        <a href="{{ route('member.buku.detail', $pinjam->buku->id_buku) }}" class="btn-detail">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="empty-state">
            <i class="fas fa-bookmark"></i>
            <h3>Rak Buku Kosong</h3>
            <p>Kamu belum meminjam buku apapun saat ini.</p>
            <a href="{{ route('member.buku') }}" class="btn-cari-buku">
                <i class="fas fa-book-open"></i> Cari Buku
            </a>
        </div>
        @endif

    </main>

    <footer class="content-footer">
        <span>© {{ date('Y') }} <strong>Readify</strong>. All Rights Reserved</span>
        <span>Login: <strong>{{ Auth::user()->email }}</strong></span>
    </footer>
</div>

</body>
</html>