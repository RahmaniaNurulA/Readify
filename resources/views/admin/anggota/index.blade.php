<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Anggota — Readify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg:  #1a1a2e;
            --sidebar-w:   260px;
            --topbar-h:    64px;
            --accent:      #84CC16;
            --accent-dark: #16A34A;
            --white:       #ffffff;
            --body-bg:     #f4f6f9;
            --card-shadow: 0 2px 12px rgba(0,0,0,0.08);
            --text-dark:   #1e293b;
            --text-muted:  #64748b;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--body-bg); color:var(--text-dark); display:flex; min-height:100vh; }

        /* SIDEBAR */
        .sidebar { width:var(--sidebar-w); background:var(--sidebar-bg); min-height:100vh; position:fixed; top:0; left:0; display:flex; flex-direction:column; z-index:100; }
        .sidebar-brand { padding:1.5rem 1.5rem 1rem; border-bottom:1px solid rgba(255,255,255,0.07); }
        .sidebar-brand h1 { font-size:1.6rem; font-weight:800; background:linear-gradient(135deg,#84CC16,#BEF264); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .sidebar-brand p { font-size:0.72rem; color:rgba(255,255,255,0.35); margin-top:0.2rem; letter-spacing:0.08em; text-transform:uppercase; }
        .sidebar-menu { padding:1rem 0; flex:1; overflow-y:auto; }
        .menu-label { font-size:0.68rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.25); padding:1rem 1.5rem 0.4rem; }
        .menu-item { display:flex; align-items:center; gap:0.85rem; padding:0.75rem 1.5rem; color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.9rem; font-weight:500; transition:all 0.2s; border-left:3px solid transparent; }
        .menu-item:hover { color:#fff; background:rgba(255,255,255,0.05); }
        .menu-item.active { color:var(--accent); background:rgba(132,204,22,0.1); border-left-color:var(--accent); }
        .menu-item i { width:18px; text-align:center; font-size:0.95rem; }
        .sidebar-footer { padding:1rem 1.5rem; border-top:1px solid rgba(255,255,255,0.07); }
        .logout-btn { display:flex; align-items:center; gap:0.75rem; width:100%; padding:0.75rem 1rem; background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.2); border-radius:10px; color:#fca5a5; font-size:0.88rem; font-weight:600; cursor:pointer; font-family:inherit; transition:all 0.2s; text-decoration:none; }
        .logout-btn:hover { background:rgba(239,68,68,0.22); color:#fff; }

        /* MAIN */
        .main-wrapper { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; min-height:100vh; }
        .topbar { height:var(--topbar-h); background:var(--white); border-bottom:1px solid #e2e8f0; display:flex; align-items:center; justify-content:space-between; padding:0 2rem; position:sticky; top:0; z-index:50; box-shadow:0 1px 8px rgba(0,0,0,0.06); }
        .page-title { font-size:1.1rem; font-weight:700; }
        .breadcrumb { font-size:0.8rem; color:var(--text-muted); margin-top:1px; }
        .breadcrumb span { color:var(--accent-dark); font-weight:600; }
        .admin-badge { display:flex; align-items:center; gap:0.6rem; padding:0.4rem 0.9rem; background:rgba(132,204,22,0.1); border:1px solid rgba(132,204,22,0.25); border-radius:999px; }
        .admin-avatar { width:30px; height:30px; background:linear-gradient(135deg,#84CC16,#16A34A); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-size:0.75rem; font-weight:700; }
        .admin-name { font-size:0.85rem; font-weight:600; }
        .admin-role { font-size:0.72rem; color:var(--accent-dark); font-weight:600; }
        .content { padding:2rem; flex:1; }

        /* STATS */
        .stats-mini { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:1rem; margin-bottom:1.75rem; }
        .stat-card { background:var(--white); border-radius:12px; padding:1.1rem 1.25rem; box-shadow:var(--card-shadow); display:flex; align-items:center; gap:0.9rem; border-left:4px solid transparent; }
        .stat-card.green  { border-left-color:#22c55e; }
        .stat-card.blue   { border-left-color:#3b82f6; }
        .stat-card.pink   { border-left-color:#ec4899; }
        .stat-icon { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.05rem; flex-shrink:0; }
        .stat-card.green .stat-icon { background:#f0fdf4; color:#22c55e; }
        .stat-card.blue  .stat-icon { background:#eff6ff; color:#3b82f6; }
        .stat-card.pink  .stat-icon { background:#fdf2f8; color:#ec4899; }
        .stat-num { font-size:1.6rem; font-weight:800; line-height:1; }
        .stat-card.green .stat-num { color:#22c55e; }
        .stat-card.blue  .stat-num { color:#3b82f6; }
        .stat-card.pink  .stat-num { color:#ec4899; }
        .stat-label { font-size:0.78rem; font-weight:600; color:var(--text-muted); margin-top:0.15rem; }

        /* CARD */
        .main-card { background:var(--white); border-radius:14px; box-shadow:var(--card-shadow); overflow:hidden; }
        .card-toolbar { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; padding:1.25rem 1.5rem; border-bottom:1px solid #f1f5f9; }
        .card-toolbar-title { font-size:1rem; font-weight:700; display:flex; align-items:center; gap:0.5rem; }
        .card-toolbar-title i { color:var(--accent-dark); }
        .toolbar-actions { display:flex; align-items:center; gap:0.75rem; flex-wrap:wrap; }

        /* SEARCH */
        .search-box { display:flex; align-items:center; gap:0.5rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:0.4rem 0.85rem; min-width:200px; }
        .search-box i { color:var(--text-muted); font-size:0.85rem; }
        .search-box input { border:none; background:transparent; font-size:0.85rem; font-family:inherit; color:var(--text-dark); outline:none; width:100%; }
        .search-box input::placeholder { color:var(--text-muted); }

        /* SELECT FILTER */
        .filter-select { padding:0.42rem 0.85rem; border:1px solid #e2e8f0; border-radius:8px; font-size:0.83rem; font-family:inherit; color:var(--text-dark); background:#f8fafc; outline:none; cursor:pointer; }

        /* BTN TAMBAH */
        .btn-tambah { display:inline-flex; align-items:center; gap:0.4rem; padding:0.5rem 1rem; background:linear-gradient(135deg,#84CC16,#16A34A); color:#fff; font-size:0.83rem; font-weight:700; border:none; border-radius:8px; cursor:pointer; font-family:inherit; transition:all 0.2s; }
        .btn-tambah:hover { opacity:0.9; transform:translateY(-1px); }

        /* TABLE */
        .data-table { width:100%; border-collapse:collapse; }
        .data-table th { text-align:left; font-size:0.73rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--text-muted); padding:0.7rem 1.25rem; background:#f8fafc; border-bottom:1px solid #e2e8f0; white-space:nowrap; }
        .data-table td { padding:0.9rem 1.25rem; font-size:0.875rem; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
        .data-table tr:last-child td { border-bottom:none; }
        .data-table tbody tr:hover td { background:#fafbfc; }

        /* AVATAR */
        .member-ava { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.85rem; font-weight:700; color:#fff; flex-shrink:0; }
        .member-ava.male   { background:linear-gradient(135deg,#3b82f6,#1d4ed8); }
        .member-ava.female { background:linear-gradient(135deg,#ec4899,#be185d); }
        .member-ava.other  { background:linear-gradient(135deg,#84CC16,#16A34A); }
        .member-info { display:flex; align-items:center; gap:0.75rem; }
        .member-name { font-weight:600; font-size:0.875rem; }
        .member-id   { font-size:0.73rem; color:var(--text-muted); }

        /* BADGE */
        .badge { display:inline-flex; align-items:center; padding:0.25rem 0.65rem; border-radius:999px; font-size:0.72rem; font-weight:700; }
        .badge-l { background:#eff6ff; color:#2563eb; }
        .badge-p { background:#fdf2f8; color:#be185d; }

        /* ACTION BTNS */
        .actions-cell { display:flex; gap:0.4rem; }
        .btn-act { display:inline-flex; align-items:center; gap:0.3rem; padding:0.35rem 0.75rem; border-radius:7px; font-size:0.78rem; font-weight:600; cursor:pointer; font-family:inherit; border:none; transition:all 0.18s; }
        .btn-edit  { background:rgba(132,204,22,0.1); color:#16a34a; border:1px solid rgba(132,204,22,0.25); }
        .btn-edit:hover  { background:#16a34a; color:#fff; }
        .btn-hapus { background:rgba(239,68,68,0.08); color:#dc2626; border:1px solid rgba(239,68,68,0.2); }
        .btn-hapus:hover { background:#dc2626; color:#fff; }

        /* EMPTY */
        .empty-state { text-align:center; padding:4rem 2rem; }
        .empty-state-icon { width:72px; height:72px; border-radius:20px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; font-size:2rem; color:#cbd5e1; margin:0 auto 1.25rem; }
        .empty-state h3 { font-size:1rem; font-weight:700; margin-bottom:0.4rem; }
        .empty-state p  { font-size:0.85rem; color:var(--text-muted); }

        /* PAGINATION */
        .pagination-wrapper { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.5rem; border-top:1px solid #f1f5f9; flex-wrap:wrap; gap:0.75rem; }
        .pagination-info { font-size:0.82rem; color:var(--text-muted); }
        .pagination-info strong { color:var(--text-dark); }
        .pagination { display:flex; gap:0.3rem; }
        .page-btn { display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:7px; font-size:0.82rem; font-weight:600; text-decoration:none; color:var(--text-muted); border:1px solid #e2e8f0; background:var(--white); transition:all 0.15s; cursor:pointer; }
        .page-btn:hover { border-color:var(--accent); color:var(--accent-dark); }
        .page-btn.active { background:var(--accent-dark); color:#fff; border-color:var(--accent-dark); }
        .page-btn:disabled { opacity:0.4; cursor:not-allowed; }

        /* FLASH */
        .flash-msg { display:flex; align-items:center; gap:0.75rem; padding:0.9rem 1.25rem; border-radius:10px; margin-bottom:1.5rem; font-size:0.87rem; font-weight:500; }
        .flash-success { background:#f0fdf4; border:1px solid #bbf7d0; border-left:4px solid #22c55e; color:#15803d; }
        .flash-error   { background:#fef2f2; border:1px solid #fecaca; border-left:4px solid #ef4444; color:#dc2626; }

        /* MODAL */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); backdrop-filter:blur(3px); z-index:999; align-items:center; justify-content:center; }
        .modal-overlay.show { display:flex; }
        .modal { background:var(--white); border-radius:18px; width:500px; max-width:95vw; box-shadow:0 20px 60px rgba(0,0,0,0.2); overflow:hidden; animation:modalIn 0.25s ease; }
        @keyframes modalIn { from{opacity:0;transform:translateY(20px) scale(0.97)} to{opacity:1;transform:translateY(0) scale(1)} }
        .modal-header { padding:1.4rem 1.5rem 1rem; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between; }
        .modal-title { font-size:1rem; font-weight:700; display:flex; align-items:center; gap:0.5rem; }
        .modal-title i { color:var(--accent-dark); }
        .modal-close { width:30px; height:30px; border:none; background:#f1f5f9; border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer; color:var(--text-muted); transition:all 0.15s; }
        .modal-close:hover { background:#e2e8f0; color:var(--text-dark); }
        .modal-body { padding:1.25rem 1.5rem; }
        .modal-footer { padding:1rem 1.5rem 1.4rem; display:flex; gap:0.75rem; justify-content:flex-end; }

        /* FORM */
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
        .form-group { display:flex; flex-direction:column; gap:0.4rem; }
        .form-group.full { grid-column:1/-1; }
        .form-label { font-size:0.8rem; font-weight:600; color:var(--text-muted); }
        .form-control { padding:0.55rem 0.85rem; border:1px solid #e2e8f0; border-radius:8px; font-size:0.87rem; font-family:inherit; color:var(--text-dark); background:#f8fafc; outline:none; transition:border-color 0.2s; }
        .form-control:focus { border-color:var(--accent); background:#fff; }

        .btn-primary   { display:inline-flex; align-items:center; gap:0.5rem; padding:0.6rem 1.25rem; background:linear-gradient(135deg,#84CC16,#16A34A); color:#fff; font-size:0.87rem; font-weight:700; border:none; border-radius:9px; cursor:pointer; font-family:inherit; transition:all 0.2s; }
        .btn-primary:hover { opacity:0.9; }
        .btn-secondary { display:inline-flex; align-items:center; gap:0.5rem; padding:0.6rem 1.25rem; background:#f1f5f9; color:var(--text-muted); font-size:0.87rem; font-weight:700; border:none; border-radius:9px; cursor:pointer; font-family:inherit; transition:all 0.2s; }
        .btn-secondary:hover { background:#e2e8f0; color:var(--text-dark); }
        .btn-danger { background:#dc2626; color:#fff; }

        /* Confirm */
        .confirm-icon { width:56px; height:56px; border-radius:16px; background:rgba(239,68,68,0.1); display:flex; align-items:center; justify-content:center; font-size:1.5rem; color:#dc2626; margin:0 auto 1.25rem; }
        .confirm-text { text-align:center; }
        .confirm-text h3 { font-size:1rem; font-weight:700; margin-bottom:0.5rem; }
        .confirm-text p  { font-size:0.85rem; color:var(--text-muted); line-height:1.6; }

        .content-footer { padding:1rem 2rem; border-top:1px solid #e2e8f0; background:var(--white); font-size:0.8rem; color:var(--text-muted); display:flex; justify-content:space-between; }
        .content-footer strong { color:var(--text-dark); }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <h1>Readify</h1>
        <p>Admin Panel</p>
    </div>
    <nav class="sidebar-menu">
        <div class="menu-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <div class="menu-label">Perpustakaan</div>
        <a href="{{ route('admin.buku.index') }}" class="menu-item">
            <i class="fas fa-book"></i> Kelola Buku
        </a>
        <a href="{{ route('admin.kategori.index') }}" class="menu-item">
            <i class="fas fa-tags"></i> Kategori
        </a>
        <a href="{{ route('admin.peminjaman.index') }}" class="menu-item">
            <i class="fas fa-exchange-alt"></i> Peminjaman
        </a>
        <div class="menu-label">Pengguna</div>
        <a href="{{ route('admin.anggota.index') }}" class="menu-item active">
            <i class="fas fa-users"></i> Anggota
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
        <div>
            <div class="page-title">Kelola Anggota</div>
            <div class="breadcrumb">Home / <span>Anggota</span></div>
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

        @if(session('success'))
            <div class="flash-msg flash-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flash-msg flash-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        {{-- STATS --}}
        <div class="stats-mini">
            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div>
                    <div class="stat-num">{{ $totalMember }}</div>
                    <div class="stat-label">Total Anggota</div>
                </div>
            </div>
            <div class="stat-card blue">
                <div class="stat-icon"><i class="fas fa-male"></i></div>
                <div>
                    <div class="stat-num">{{ $totalPria }}</div>
                    <div class="stat-label">Laki-laki</div>
                </div>
            </div>
            <div class="stat-card pink">
                <div class="stat-icon"><i class="fas fa-female"></i></div>
                <div>
                    <div class="stat-num">{{ $totalWanita }}</div>
                    <div class="stat-label">Perempuan</div>
                </div>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="main-card">
            <div class="card-toolbar">
                <div class="card-toolbar-title">
                    <i class="fas fa-users"></i> Daftar Anggota
                </div>
                <div class="toolbar-actions">
                    {{-- Filter Jenis Kelamin --}}
                    <form method="GET" action="{{ route('admin.anggota.index') }}" id="filterForm">
                        <select name="jenis_kelamin" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua Gender</option>
                            <option value="L" {{ request('jenis_kelamin')==='L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ request('jenis_kelamin')==='P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                    </form>

                    {{-- Search --}}
                    <form method="GET" action="{{ route('admin.anggota.index') }}">
                        @if(request('jenis_kelamin'))
                            <input type="hidden" name="jenis_kelamin" value="{{ request('jenis_kelamin') }}">
                        @endif
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / no. hp…">
                        </div>
                    </form>
                </div>
            </div>

            @if($members->count())
            <div style="overflow-x:auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:40px">#</th>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $i => $m)
                        <tr>
                            <td style="color:var(--text-muted);font-weight:600;">
                                {{ $members->firstItem() + $i }}
                            </td>
                            <td>
                                <div class="member-info">
                                    <div class="member-ava {{ $m->jenis_kelamin === 'L' ? 'male' : ($m->jenis_kelamin === 'P' ? 'female' : 'other') }}">
                                        {{ strtoupper(substr($m->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="member-name">{{ $m->nama }}</div>
                                        <div class="member-id">ID #{{ $m->id_user }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $m->nohp ?? '-' }}</td>
                            <td>{{ $m->tempat_lahir ?? '-' }}</td>
                            <td>
                                {{ $m->tanggal_lahir ? \Carbon\Carbon::parse($m->tanggal_lahir)->format('d M Y') : '-' }}
                            </td>
                            <td>
                                @if($m->jenis_kelamin === 'L')
                                    <span class="badge badge-l"><i class="fas fa-mars" style="font-size:0.65rem"></i> Laki-laki</span>
                                @elseif($m->jenis_kelamin === 'P')
                                    <span class="badge badge-p"><i class="fas fa-venus" style="font-size:0.65rem"></i> Perempuan</span>
                                @else
                                    <span style="color:var(--text-muted)">-</span>
                                @endif
                            </td>
                            <td>{{ $m->agama ?? '-' }}</td>
                            <td>
                                <div class="actions-cell">
                                    <button class="btn-act btn-edit"
                                            onclick="openEdit({{ json_encode([
                                                'id'            => $m->id_user,
                                                'nama'          => $m->nama,
                                                'nohp'          => $m->nohp,
                                                'tempat_lahir'  => $m->tempat_lahir,
                                                'tanggal_lahir' => $m->tanggal_lahir,
                                                'jenis_kelamin' => $m->jenis_kelamin,
                                                'agama'         => $m->agama,
                                            ]) }})">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Menampilkan <strong>{{ $members->firstItem() }}–{{ $members->lastItem() }}</strong>
                    dari <strong>{{ $members->total() }}</strong> anggota
                </div>
                <div class="pagination">
                    @if($members->onFirstPage())
                        <button class="page-btn" disabled><i class="fas fa-chevron-left" style="font-size:0.7rem"></i></button>
                    @else
                        <a href="{{ $members->previousPageUrl() }}" class="page-btn">
                            <i class="fas fa-chevron-left" style="font-size:0.7rem"></i>
                        </a>
                    @endif
                    @foreach($members->getUrlRange(max(1,$members->currentPage()-2), min($members->lastPage(),$members->currentPage()+2)) as $page => $url)
                        <a href="{{ $url }}" class="page-btn {{ $page === $members->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach
                    @if($members->hasMorePages())
                        <a href="{{ $members->nextPageUrl() }}" class="page-btn">
                            <i class="fas fa-chevron-right" style="font-size:0.7rem"></i>
                        </a>
                    @else
                        <button class="page-btn" disabled><i class="fas fa-chevron-right" style="font-size:0.7rem"></i></button>
                    @endif
                </div>
            </div>

            @else
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fas fa-users"></i></div>
                <h3>Tidak ada data anggota</h3>
                <p>
                    @if(request('search'))
                        Tidak ditemukan hasil untuk "<strong>{{ request('search') }}</strong>"
                    @else
                        Belum ada anggota terdaftar. Klik tombol <strong>Tambah Anggota</strong> untuk memulai.
                    @endif
                </p>
            </div>
            @endif
        </div>

    </main>

    <footer class="content-footer">
        <span>© Copyright <strong>Readify</strong>. All Rights Reserved</span>
        <span>Logged in as: <strong>{{ Auth::user()->email }}</strong> (Admin)</span>
    </footer>
</div>


{{-- MODAL TAMBAH --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title"><i class="fas fa-user-plus"></i> Tambah Anggota</div>
            <button class="modal-close" onclick="closeModal('modalTambah')"><i class="fas fa-times"></i></button>
        </div>
        <form method="POST" action="{{ route('admin.anggota.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="nohp" class="form-control" placeholder="08xx-xxxx-xxxx">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota kelahiran">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control">
                    </div>
                    <div class="form-group full">
                        <label class="form-label">Agama</label>
                        <select name="agama" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal-overlay" id="modalEdit">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title"><i class="fas fa-user-edit"></i> Edit Anggota</div>
            <button class="modal-close" onclick="closeModal('modalEdit')"><i class="fas fa-times"></i></button>
        </div>
        <form method="POST" id="formEdit">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="nama" id="editNama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="nohp" id="editNohp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="editJK" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="editTempat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="editTanggal" class="form-control">
                    </div>
                    <div class="form-group full">
                        <label class="form-label">Agama</label>
                        <select name="agama" id="editAgama" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Perbarui</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title" style="color:#dc2626"><i class="fas fa-trash"></i> Hapus Anggota</div>
            <button class="modal-close" onclick="closeModal('modalHapus')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" style="text-align:center;padding:2rem 1.5rem">
            <div class="confirm-icon"><i class="fas fa-trash"></i></div>
            <div class="confirm-text">
                <h3>Hapus Anggota?</h3>
                <p id="hapusText">Data anggota akan dihapus permanen.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
            <form id="formHapus" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-primary btn-danger">
                    <i class="fas fa-trash"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(id)  { document.getElementById(id).classList.add('show'); }
    function closeModal(id) { document.getElementById(id).classList.remove('show'); }

    document.querySelectorAll('.modal-overlay').forEach(el => {
        el.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });

    function openTambah() { openModal('modalTambah'); }

    function openEdit(data) {
        document.getElementById('editNama').value    = data.nama ?? '';
        document.getElementById('editNohp').value    = data.nohp ?? '';
        document.getElementById('editJK').value      = data.jenis_kelamin ?? '';
        document.getElementById('editTempat').value  = data.tempat_lahir ?? '';
        document.getElementById('editTanggal').value = data.tanggal_lahir ?? '';
        document.getElementById('editAgama').value   = data.agama ?? '';
        document.getElementById('formEdit').action   = `/admin/anggota/${data.id}`;
        openModal('modalEdit');
    }

    function openHapus(id, nama) {
        document.getElementById('hapusText').innerHTML =
            `Anggota <strong>"${nama}"</strong> akan dihapus permanen dan tidak dapat dikembalikan.`;
        document.getElementById('formHapus').action = `/admin/anggota/${id}`;
        openModal('modalHapus');
    }

    // Auto-submit search
    const searchInput = document.querySelector('.search-box input');
    let timer;
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            clearTimeout(timer);
            timer = setTimeout(() => searchInput.closest('form').submit(), 500);
        });
    }
</script>

</body>
</html>