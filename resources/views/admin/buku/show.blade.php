<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $buku->judul_buku }} — Readify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --sidebar-bg:#1a1a2e; --sidebar-w:260px; --topbar-h:64px; --accent:#84CC16; --accent-dark:#16A34A; --white:#ffffff; --body-bg:#f4f6f9; --card-shadow:0 2px 12px rgba(0,0,0,0.08); --text-dark:#1e293b; --text-muted:#64748b; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--body-bg); color:var(--text-dark); display:flex; min-height:100vh; }
        .sidebar { width:var(--sidebar-w); background:var(--sidebar-bg); min-height:100vh; position:fixed; top:0; left:0; display:flex; flex-direction:column; z-index:100; }
        .sidebar-brand { padding:1.5rem 1.5rem 1rem; border-bottom:1px solid rgba(255,255,255,0.07); }
        .sidebar-brand h1 { font-size:1.6rem; font-weight:800; background:linear-gradient(135deg,#84CC16,#BEF264); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .sidebar-brand p { font-size:0.72rem; color:rgba(255,255,255,0.35); margin-top:0.2rem; letter-spacing:0.08em; text-transform:uppercase; }
        .sidebar-menu { padding:1rem 0; flex:1; overflow-y:auto; }
        .menu-label { font-size:0.68rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.25); padding:1rem 1.5rem 0.4rem; }
        .menu-item { display:flex; align-items:center; gap:0.85rem; padding:0.75rem 1.5rem; color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.9rem; font-weight:500; transition:all 0.2s; border-left:3px solid transparent; }
        .menu-item:hover { color:var(--white); background:rgba(255,255,255,0.05); }
        .menu-item.active { color:var(--accent); background:rgba(132,204,22,0.1); border-left-color:var(--accent); }
        .menu-item i { width:18px; text-align:center; font-size:0.95rem; }
        .sidebar-footer { padding:1rem 1.5rem; border-top:1px solid rgba(255,255,255,0.07); }
        .logout-btn { display:flex; align-items:center; gap:0.75rem; width:100%; padding:0.75rem 1rem; background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.2); border-radius:10px; color:#fca5a5; font-size:0.88rem; font-weight:600; cursor:pointer; font-family:inherit; transition:all 0.2s; text-decoration:none; }
        .logout-btn:hover { background:rgba(239,68,68,0.22); color:#fff; }
        .main-wrapper { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; }
        .topbar { height:var(--topbar-h); background:var(--white); border-bottom:1px solid #e2e8f0; display:flex; align-items:center; justify-content:space-between; padding:0 2rem; position:sticky; top:0; z-index:50; box-shadow:0 1px 8px rgba(0,0,0,0.06); }
        .page-title { font-size:1.1rem; font-weight:700; }
        .breadcrumb { font-size:0.8rem; color:var(--text-muted); margin-top:1px; }
        .breadcrumb span { color:var(--accent-dark); font-weight:600; }
        .admin-badge { display:flex; align-items:center; gap:0.6rem; padding:0.4rem 0.9rem; background:rgba(132,204,22,0.1); border:1px solid rgba(132,204,22,0.25); border-radius:999px; }
        .admin-avatar { width:30px; height:30px; background:linear-gradient(135deg,#84CC16,#16A34A); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:0.75rem; font-weight:700; }
        .admin-name { font-size:0.85rem; font-weight:600; }
        .admin-role { font-size:0.72rem; color:var(--accent-dark); font-weight:600; }
        .content { padding:2rem; flex:1; }
        .back-btn { display:inline-flex; align-items:center; gap:0.5rem; color:var(--text-muted); text-decoration:none; font-size:0.875rem; font-weight:600; margin-bottom:1.5rem; transition:color 0.2s; }
        .back-btn:hover { color:var(--accent-dark); }
        .content-footer { padding:1rem 2rem; border-top:1px solid #e2e8f0; background:var(--white); font-size:0.8rem; color:var(--text-muted); display:flex; justify-content:space-between; }
        .content-footer strong { color:var(--text-dark); }

        /* ── DETAIL LAYOUT ── */
        .detail-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 1.5rem;
            max-width: 1000px;
        }

        /* Cover Card */
        .cover-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: sticky;
            top: calc(var(--topbar-h) + 1.5rem);
            align-self: start;
        }
        .cover-card-img {
            width: 100%; aspect-ratio: 3/4;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .cover-card-img img { width: 100%; height: 100%; object-fit: cover; }
        .cover-card-img .no-cover { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; color: #94a3b8; }
        .cover-card-img .no-cover i { font-size: 3.5rem; }
        .cover-card-body { padding: 1.25rem; }
        .stock-indicator {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 0.85rem;
        }
        .stock-label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); }
        .stock-val {
            font-size: 1.1rem; font-weight: 800;
            padding: 0.2rem 0.7rem; border-radius: 8px;
        }
        .stock-ok   { background: #f0fdf4; color: #16A34A; }
        .stock-low  { background: #fffbeb; color: #d97706; }
        .stock-zero { background: #fef2f2; color: #ef4444; }

        .action-btns { display: flex; flex-direction: column; gap: 0.6rem; }
        .btn-action {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.65rem; border-radius: 9px;
            font-family: inherit; font-size: 0.875rem; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: all 0.2s;
        }
        .btn-edit-full  { background: #eff6ff; color: #2563eb; border: 1.5px solid #bfdbfe; }
        .btn-edit-full:hover  { background: #2563eb; color: white; border-color: #2563eb; }
        .btn-delete-full { background: #fef2f2; color: #ef4444; border: 1.5px solid #fecaca; }
        .btn-delete-full:hover { background: #ef4444; color: white; border-color: #ef4444; }
        .btn-read { background: linear-gradient(135deg,#84CC16,#16A34A); color: white; border: none; box-shadow: 0 4px 12px rgba(132,204,22,0.3); }
        .btn-read:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(132,204,22,0.4); }

        /* Info Card */
        .info-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        .info-header {
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .book-title-large {
            font-size: 1.5rem; font-weight: 800; line-height: 1.3;
            color: var(--text-dark); margin-bottom: 0.4rem;
        }
        .book-author-large {
            font-size: 0.95rem; color: var(--text-muted); font-weight: 500;
            display: flex; align-items: center; gap: 0.4rem;
        }
        .kategori-pill {
            display: inline-flex; align-items: center; gap: 0.3rem;
            margin-top: 0.75rem;
            padding: 0.25rem 0.8rem;
            background: rgba(132,204,22,0.1); color: var(--accent-dark);
            border: 1px solid rgba(132,204,22,0.25);
            border-radius: 999px; font-size: 0.78rem; font-weight: 700;
        }

        .info-body { padding: 1.75rem; }

        .meta-grid {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 1rem; margin-bottom: 1.5rem;
        }
        .meta-item {
            background: #f8fafc; border-radius: 10px; padding: 0.9rem 1rem;
        }
        .meta-item-label { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--text-muted); margin-bottom: 0.3rem; }
        .meta-item-value { font-size: 0.95rem; font-weight: 700; color: var(--text-dark); }

        .sinopsis-section { }
        .sinopsis-title { font-size: 0.875rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.65rem; display: flex; align-items: center; gap: 0.4rem; }
        .sinopsis-title i { color: var(--accent-dark); }
        .sinopsis-text { font-size: 0.9rem; line-height: 1.75; color: #475569; }
        .sinopsis-text.empty { color: var(--text-muted); font-style: italic; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand"><h1>Readify</h1><p>Admin Panel</p></div>
    <nav class="sidebar-menu">
        <div class="menu-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="menu-item"><i class="fas fa-th-large"></i> Dashboard</a>
        <div class="menu-label">Perpustakaan</div>
        <a href="{{ route('admin.buku.index') }}" class="menu-item active"><i class="fas fa-book"></i> Kelola Buku</a>
        <a href="{{ route('admin.kategori.index') }}" class="menu-item"><i class="fas fa-tags"></i> Kategori</a>
        <a href="{{ route('admin.peminjaman.index') }}" class="menu-item"><i class="fas fa-exchange-alt"></i> Peminjaman</a>
        <div class="menu-label">Pengguna</div>
        <a href="{{ route('admin.anggota.index') }}" class="menu-item"><i class="fas fa-users"></i> Anggota</a>
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
        <div>
            <div class="page-title">Detail Buku</div>
            <div class="breadcrumb">Home / <a href="{{ route('admin.buku.index') }}" style="color:inherit;text-decoration:none">Kelola Buku</a> / <span>{{ Str::limit($buku->judul_buku, 30) }}</span></div>
        </div>
        <div class="admin-badge">
            <div class="admin-avatar">A</div>
            <div>
                <div class="admin-name">{{ Auth::user()->email }}</div>
                <div class="admin-role">Administrator</div>
            </div>
        </div>
    </header>

    <main class="content">
        <a href="{{ route('admin.buku.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Buku
        </a>

        <div class="detail-layout">

            {{-- COVER & ACTIONS --}}
            <div class="cover-card">
                <div class="cover-card-img">
                    @if($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul_buku }}">
                    @else
                        <div class="no-cover">
                            <i class="fas fa-book-open"></i>
                            <span style="font-size:0.75rem;font-weight:600;color:#94a3b8">No Cover</span>
                        </div>
                    @endif
                </div>
                <div class="cover-card-body">
                    <div class="stock-indicator">
                        <span class="stock-label"><i class="fas fa-layer-group" style="margin-right:4px"></i>Stok Tersedia</span>
                        <span class="stock-val {{ $buku->jumlah_buku > 3 ? 'stock-ok' : ($buku->jumlah_buku > 0 ? 'stock-low' : 'stock-zero') }}">
                            {{ $buku->jumlah_buku }} buku
                        </span>
                    </div>
                    <div class="action-btns">
                        @if($buku->file_buku)
                        <a href="{{ asset('storage/' . $buku->file_buku) }}" target="_blank" class="btn-action btn-read">
                            <i class="fas fa-book-reader"></i> Baca Buku
                        </a>
                        @endif
                        <a href="{{ route('admin.buku.edit', $buku->id_buku) }}" class="btn-action btn-edit-full">
                            <i class="fas fa-pen"></i> Edit Buku
                        </a>
                        <form method="POST" action="{{ route('admin.buku.destroy', $buku->id_buku) }}" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete-full" style="width:100%">
                                <i class="fas fa-trash"></i> Hapus Buku
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- DETAIL INFO --}}
            <div class="info-card">
                <div class="info-header">
                    <div class="book-title-large">{{ $buku->judul_buku }}</div>
                    <div class="book-author-large">
                        <i class="fas fa-user-pen" style="font-size:0.85rem"></i>
                        {{ $buku->pengarang }}
                    </div>
                    @if($buku->nama_kategori)
                    <span class="kategori-pill">
                        <i class="fas fa-tag" style="font-size:0.65rem"></i>
                        {{ $buku->nama_kategori }}
                    </span>
                    @endif
                </div>

                <div class="info-body">
                    <div class="meta-grid">
                        <div class="meta-item">
                            <div class="meta-item-label"><i class="fas fa-building" style="margin-right:3px"></i>Penerbit</div>
                            <div class="meta-item-value">{{ $buku->penerbit }}</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-item-label"><i class="fas fa-calendar" style="margin-right:3px"></i>Tahun Terbit</div>
                            <div class="meta-item-value">{{ $buku->tahun_terbit }}</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-item-label"><i class="fas fa-hashtag" style="margin-right:3px"></i>ID Buku</div>
                            <div class="meta-item-value">#{{ $buku->id_buku }}</div>
                        </div>
                    </div>

                    <div class="sinopsis-section">
                        <div class="sinopsis-title"><i class="fas fa-align-left"></i> Sinopsis</div>
                        @if($buku->sinopsis)
                            <p class="sinopsis-text">{{ $buku->sinopsis }}</p>
                        @else
                            <p class="sinopsis-text empty">Sinopsis belum tersedia untuk buku ini.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="content-footer">
        <span>© Copyright <strong>Readify</strong>. All Rights Reserved</span>
        <span>Logged in as: <strong>{{ Auth::user()->email }}</strong> (Admin)</span>
    </footer>
</div>

</body>
</html>