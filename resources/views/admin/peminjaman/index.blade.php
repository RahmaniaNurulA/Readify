<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Peminjaman — Readify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg:   #1a1a2e;
            --sidebar-w:    260px;
            --topbar-h:     64px;
            --accent:       #84CC16;
            --accent-dark:  #16A34A;
            --white:        #ffffff;
            --body-bg:      #f4f6f9;
            --card-shadow:  0 2px 12px rgba(0,0,0,0.08);
            --text-dark:    #1e293b;
            --text-muted:   #64748b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--body-bg);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .sidebar-brand h1 {
            font-size: 1.6rem;
            font-weight: 800;
            background: linear-gradient(135deg, #84CC16, #BEF264);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-brand p {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.35);
            margin-top: 0.2rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .sidebar-menu {
            padding: 1rem 0;
            flex: 1;
            overflow-y: auto;
        }

        .menu-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            padding: 1rem 1.5rem 0.4rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .menu-item:hover { color: var(--white); background: rgba(255,255,255,0.05); }

        .menu-item.active {
            color: var(--accent);
            background: rgba(132,204,22,0.1);
            border-left-color: var(--accent);
        }

        .menu-item i { width: 18px; text-align: center; font-size: 0.95rem; }

        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 10px;
            color: #fca5a5;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s;
            text-decoration: none;
        }

        .logout-btn:hover { background: rgba(239,68,68,0.22); color: #fff; }

        /* ── MAIN ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
        }

        .page-title { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); }
        .breadcrumb { font-size: 0.8rem; color: var(--text-muted); margin-top: 1px; }
        .breadcrumb span { color: var(--accent-dark); font-weight: 600; }

        .topbar-right { display: flex; align-items: center; gap: 1rem; }

        .admin-badge {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 0.9rem;
            background: rgba(132,204,22,0.1);
            border: 1px solid rgba(132,204,22,0.25);
            border-radius: 999px;
        }

        .admin-avatar {
            width: 30px; height: 30px;
            background: linear-gradient(135deg, #84CC16, #16A34A);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .admin-name { font-size: 0.85rem; font-weight: 600; color: var(--text-dark); }
        .admin-role { font-size: 0.72rem; color: var(--accent-dark); font-weight: 600; }

        /* ── CONTENT ── */
        .content { padding: 2rem; flex: 1; }

        /* ── STATS MINI ── */
        .stats-mini {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .stat-mini-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.1rem 1.25rem;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 0.9rem;
            border-left: 4px solid transparent;
        }

        .stat-mini-card.yellow { border-left-color: #f59e0b; }
        .stat-mini-card.green  { border-left-color: #22c55e; }
        .stat-mini-card.red    { border-left-color: #ef4444; }
        .stat-mini-card.blue   { border-left-color: #3b82f6; }

        .stat-mini-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .stat-mini-card.yellow .stat-mini-icon { background: #fffbeb; color: #f59e0b; }
        .stat-mini-card.green  .stat-mini-icon { background: #f0fdf4; color: #22c55e; }
        .stat-mini-card.red    .stat-mini-icon { background: #fef2f2; color: #ef4444; }
        .stat-mini-card.blue   .stat-mini-icon { background: #eff6ff; color: #3b82f6; }

        .stat-mini-num {
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-mini-card.yellow .stat-mini-num { color: #f59e0b; }
        .stat-mini-card.green  .stat-mini-num { color: #22c55e; }
        .stat-mini-card.red    .stat-mini-num { color: #ef4444; }
        .stat-mini-card.blue   .stat-mini-num { color: #3b82f6; }

        .stat-mini-label { font-size: 0.78rem; font-weight: 600; color: var(--text-muted); margin-top: 0.15rem; }

        /* ── MAIN CARD ── */
        .main-card {
            background: var(--white);
            border-radius: 14px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .card-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-toolbar-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-toolbar-title i { color: var(--accent-dark); }

        .toolbar-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .filter-tabs {
            display: flex;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 3px;
            gap: 2px;
        }

        .filter-tab {
            padding: 0.35rem 0.85rem;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .filter-tab.active, .filter-tab:hover {
            background: var(--white);
            color: var(--text-dark);
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        .filter-tab.active { color: var(--accent-dark); }

        .search-box {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.4rem 0.85rem;
            min-width: 200px;
        }

        .search-box i { color: var(--text-muted); font-size: 0.85rem; }

        .search-box input {
            border: none;
            background: transparent;
            font-size: 0.85rem;
            font-family: inherit;
            color: var(--text-dark);
            outline: none;
            width: 100%;
        }

        .search-box input::placeholder { color: var(--text-muted); }

        /* ── TABLE ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            font-size: 0.73rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            padding: 0.7rem 1.25rem;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .data-table td {
            padding: 0.95rem 1.25rem;
            font-size: 0.875rem;
            border-bottom: 1px solid #f1f5f9;
            color: var(--text-dark);
            vertical-align: middle;
        }

        .data-table tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover td { background: #fafbfc; }

        .book-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .book-cover {
            width: 38px; height: 50px;
            border-radius: 5px;
            object-fit: cover;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #94a3b8;
            flex-shrink: 0;
        }

        .book-title { font-weight: 600; font-size: 0.875rem; color: var(--text-dark); line-height: 1.3; }
        .book-meta  { font-size: 0.75rem; color: var(--text-muted); margin-top: 0.15rem; }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .user-ava {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #84CC16, #16A34A);
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-email { font-size: 0.82rem; color: var(--text-dark); font-weight: 500; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.28rem 0.75rem;
            border-radius: 999px;
            font-size: 0.73rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
        }

        .badge-aktif { background: rgba(34,197,94,0.12); color: #16a34a; }
        .badge-aktif .badge-dot { background: #22c55e; }

        .badge-kadaluarsa { background: rgba(239,68,68,0.12); color: #dc2626; }
        .badge-kadaluarsa .badge-dot { background: #ef4444; }

        .badge-dikembalikan { background: rgba(59,130,246,0.12); color: #2563eb; }
        .badge-dikembalikan .badge-dot { background: #3b82f6; }

        .date-cell { white-space: nowrap; }
        .date-main { font-weight: 600; font-size: 0.84rem; }
        .date-sub  { font-size: 0.73rem; color: var(--text-muted); margin-top: 0.1rem; }

        .overdue-warn {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.72rem;
            color: #dc2626;
            font-weight: 600;
            background: rgba(239,68,68,0.08);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            margin-top: 0.2rem;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.38rem 0.8rem;
            border-radius: 7px;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            border: none;
            transition: all 0.18s;
            text-decoration: none;
        }

        .btn-kembalikan { background: rgba(59,130,246,0.1); color: #2563eb; border: 1px solid rgba(59,130,246,0.25); }
        .btn-kembalikan:hover { background: #2563eb; color: #fff; }

        .btn-detail { background: rgba(100,116,139,0.1); color: var(--text-muted); border: 1px solid rgba(100,116,139,0.2); }
        .btn-detail:hover { background: var(--text-muted); color: #fff; }

        .btn-hapus { background: rgba(239,68,68,0.08); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }
        .btn-hapus:hover { background: #dc2626; color: #fff; }

        .actions-cell { display: flex; align-items: center; gap: 0.4rem; }

        .empty-state { text-align: center; padding: 4rem 2rem; }
        .empty-state-icon {
            width: 72px; height: 72px;
            border-radius: 20px;
            background: #f1f5f9;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem;
            color: #cbd5e1;
            margin: 0 auto 1.25rem;
        }
        .empty-state h3 { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.4rem; }
        .empty-state p  { font-size: 0.85rem; color: var(--text-muted); }

        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .pagination-info { font-size: 0.82rem; color: var(--text-muted); }
        .pagination-info strong { color: var(--text-dark); }

        .pagination { display: flex; align-items: center; gap: 0.3rem; }

        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; height: 32px;
            border-radius: 7px;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            color: var(--text-muted);
            border: 1px solid #e2e8f0;
            background: var(--white);
            transition: all 0.15s;
            cursor: pointer;
        }

        .page-btn:hover { border-color: var(--accent); color: var(--accent-dark); }
        .page-btn.active { background: var(--accent-dark); color: #fff; border-color: var(--accent-dark); }
        .page-btn:disabled { opacity: 0.4; cursor: not-allowed; }

        /* ── MODAL ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(3px);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.show { display: flex; }

        .modal {
            background: var(--white);
            border-radius: 18px;
            width: 480px;
            max-width: 95vw;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            overflow: hidden;
            animation: modalIn 0.25s ease;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: translateY(20px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            padding: 1.4rem 1.5rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modal-title i { color: var(--accent-dark); }

        .modal-close {
            width: 30px; height: 30px;
            border: none;
            background: #f1f5f9;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 0.9rem;
            transition: all 0.15s;
        }

        .modal-close:hover { background: #e2e8f0; color: var(--text-dark); }

        .modal-body { padding: 1.25rem 1.5rem; }

        .detail-row {
            display: flex;
            align-items: flex-start;
            padding: 0.65rem 0;
            border-bottom: 1px solid #f8fafc;
            gap: 1rem;
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-key {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            min-width: 130px;
            flex-shrink: 0;
        }

        .detail-val {
            font-size: 0.87rem;
            font-weight: 500;
            color: var(--text-dark);
            flex: 1;
        }

        .modal-footer {
            padding: 1rem 1.5rem 1.4rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            background: linear-gradient(135deg, #84CC16, #16A34A);
            color: white;
            font-size: 0.87rem;
            font-weight: 700;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s;
        }

        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            background: #f1f5f9;
            color: var(--text-muted);
            font-size: 0.87rem;
            font-weight: 700;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s;
        }

        .btn-secondary:hover { background: #e2e8f0; color: var(--text-dark); }

        .confirm-icon {
            width: 56px; height: 56px;
            border-radius: 16px;
            background: rgba(59,130,246,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            color: #2563eb;
            margin: 0 auto 1.25rem;
        }

        .confirm-icon.danger { background: rgba(239,68,68,0.1); color: #dc2626; }

        .confirm-text { text-align: center; }
        .confirm-text h3 { font-size: 1rem; font-weight: 700; margin-bottom: 0.5rem; }
        .confirm-text p  { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; }

        .flash-msg {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.9rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.87rem;
            font-weight: 500;
        }

        .flash-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #22c55e; color: #15803d; }
        .flash-error   { background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444; color: #dc2626; }

        .content-footer {
            padding: 1rem 2rem;
            border-top: 1px solid #e2e8f0;
            background: var(--white);
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            justify-content: space-between;
        }

        .content-footer strong { color: var(--text-dark); }

        [data-tooltip] { position: relative; }
        [data-tooltip]::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: calc(100% + 6px);
            left: 50%;
            transform: translateX(-50%);
            background: var(--text-dark);
            color: white;
            font-size: 0.72rem;
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.15s;
        }
        [data-tooltip]:hover::after { opacity: 1; }
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
            <a href="{{ route('admin.peminjaman.index') }}" class="menu-item active">
                <i class="fas fa-exchange-alt"></i> Peminjaman
            </a>

            <div class="menu-label">Pengguna</div>
            <a href="{{ route('admin.anggota.index') }}" class="menu-item">
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
                <div class="page-title">Kelola Peminjaman</div>
                <div class="breadcrumb">Home / <span>Peminjaman</span></div>
            </div>
            <div class="topbar-right">
                <div class="admin-badge">
                    <div class="admin-avatar">A</div>
                    <div>
                        <div class="admin-name">{{ Auth::user()->email }}</div>
                        <div class="admin-role">Administrator</div>
                    </div>
                </div>
            </div>
        </header>

        <main class="content">

            @if(session('success'))
                <div class="flash-msg flash-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="flash-msg flash-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="stats-mini">
                <div class="stat-mini-card yellow">
                    <div class="stat-mini-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="stat-mini-num">{{ $totalAktif }}</div>
                        <div class="stat-mini-label">Sedang Dipinjam</div>
                    </div>
                </div>
                <div class="stat-mini-card red">
                    <div class="stat-mini-icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div>
                        <div class="stat-mini-num">{{ $totalKadaluarsa }}</div>
                        <div class="stat-mini-label">Kadaluarsa</div>
                    </div>
                </div>
                <div class="stat-mini-card blue">
                    <div class="stat-mini-icon"><i class="fas fa-undo-alt"></i></div>
                    <div>
                        <div class="stat-mini-num">{{ $totalDikembalikan }}</div>
                        <div class="stat-mini-label">Dikembalikan</div>
                    </div>
                </div>
                <div class="stat-mini-card green">
                    <div class="stat-mini-icon"><i class="fas fa-list-alt"></i></div>
                    <div>
                        <div class="stat-mini-num">{{ $totalSemua }}</div>
                        <div class="stat-mini-label">Total Semua</div>
                    </div>
                </div>
            </div>

            <div class="main-card">

                <div class="card-toolbar">
                    <div class="card-toolbar-title">
                        <i class="fas fa-exchange-alt"></i>
                        Daftar Peminjaman
                    </div>

                    <div class="toolbar-actions">
                        <div class="filter-tabs">
                            <a href="{{ route('admin.peminjaman.index') }}"
                               class="filter-tab {{ !request('status') ? 'active' : '' }}">Semua</a>
                            <a href="{{ route('admin.peminjaman.index', ['status' => 'aktif']) }}"
                               class="filter-tab {{ request('status') === 'aktif' ? 'active' : '' }}">Aktif</a>
                            <a href="{{ route('admin.peminjaman.index', ['status' => 'kadaluarsa']) }}"
                               class="filter-tab {{ request('status') === 'kadaluarsa' ? 'active' : '' }}">Kadaluarsa</a>
                            <a href="{{ route('admin.peminjaman.index', ['status' => 'dikembalikan']) }}"
                               class="filter-tab {{ request('status') === 'dikembalikan' ? 'active' : '' }}">Dikembalikan</a>
                        </div>

                        <form method="GET" action="{{ route('admin.peminjaman.index') }}">
                            @if(request('status'))
                                <input type="hidden" name="status" value="{{ request('status') }}">
                            @endif
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari email / judul buku…">
                            </div>
                        </form>
                    </div>
                </div>

                @if($peminjaman->count())
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:40px">#</th>
                                <th>Buku</th>
                                <th>Member</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Pinjam</th>
                                <th>Status</th>
                                <th style="width:160px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $index => $item)
                            @php
                                $isOverdue = $item->status_peminjaman === 'aktif'
                                          && \Carbon\Carbon::parse($item->tanggal_batas_pinjam)->isPast();
                                $daysLeft  = \Carbon\Carbon::now()->diffInDays(
                                                \Carbon\Carbon::parse($item->tanggal_batas_pinjam), false);
                            @endphp
                            <tr>
                                <td style="color:var(--text-muted);font-weight:600;">
                                    {{ $peminjaman->firstItem() + $index }}
                                </td>

                                {{-- Buku --}}
                                <td>
                                    <div class="book-info">
                                        <div class="book-cover">
                                            @if($item->buku->cover ?? false)
                                                <img src="{{ asset('storage/'.$item->buku->cover) }}"
                                                     alt="{{ $item->buku->judul_buku }}"
                                                     style="width:100%;height:100%;object-fit:cover;border-radius:5px;">
                                            @else
                                                <i class="fas fa-book"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="book-title">{{ Str::limit($item->buku->judul_buku ?? '-', 35) }}</div>
                                            <div class="book-meta">{{ $item->buku->pengarang ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Member --}}
                                <td>
                                    <div class="user-cell">
                                        <div class="user-ava">
                                            {{ strtoupper(substr($item->pengguna->email ?? 'U', 0, 1)) }}
                                        </div>
                                        <div class="user-email">{{ $item->pengguna->email ?? '-' }}</div>
                                    </div>
                                </td>

                                {{-- Tanggal Pinjam --}}
                                <td class="date-cell">
                                    <div class="date-main">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    </div>
                                </td>

                                {{-- Batas Pinjam --}}
                                <td class="date-cell">
                                    <div class="date-main">
                                        {{ \Carbon\Carbon::parse($item->tanggal_batas_pinjam)->format('d M Y') }}
                                    </div>
                                    @if($item->status_peminjaman === 'aktif')
                                        @if($isOverdue)
                                            <div class="overdue-warn">
                                                <i class="fas fa-exclamation-circle" style="font-size:0.65rem"></i>
                                                Lewat {{ abs($daysLeft) }} hari
                                            </div>
                                        @else
                                            <div class="date-sub">Sisa {{ $daysLeft }} hari</div>
                                        @endif
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($item->status_peminjaman === 'aktif')
                                        <span class="badge badge-aktif">
                                            <span class="badge-dot"></span> Aktif
                                        </span>
                                    @elseif($item->status_peminjaman === 'kadaluarsa')
                                        <span class="badge badge-kadaluarsa">
                                            <span class="badge-dot"></span> Kadaluarsa
                                        </span>
                                    @else
                                        <span class="badge badge-dikembalikan">
                                            <span class="badge-dot"></span> Dikembalikan
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <div class="actions-cell">
                                        <button class="btn-action btn-detail"
                                                data-tooltip="Detail"
                                                onclick="openDetail({{ json_encode([
                                                    'id'      => $item->id_peminjam,
                                                    'buku'    => $item->buku->judul_buku ?? '-',
                                                    'penulis' => $item->buku->pengarang ?? '-',
                                                    'member'  => $item->pengguna->email ?? '-',
                                                    'pinjam'  => \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y'),
                                                    'batas'   => \Carbon\Carbon::parse($item->tanggal_batas_pinjam)->format('d M Y'),
                                                    'status'  => $item->status_peminjaman,
                                                ]) }})">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        @if(in_array($item->status_peminjaman, ['aktif','kadaluarsa']))
                                        <button class="btn-action btn-kembalikan"
                                                data-tooltip="Kembalikan"
                                                onclick="openKembalikan({{ $item->id_peminjam }}, '{{ addslashes($item->buku->judul_buku ?? '') }}')">
                                            <i class="fas fa-undo-alt"></i>
                                        </button>
                                        @endif

                                        <button class="btn-action btn-hapus"
                                                data-tooltip="Hapus"
                                                onclick="openHapus({{ $item->id_peminjam }}, '{{ addslashes($item->buku->judul_buku ?? '') }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Menampilkan <strong>{{ $peminjaman->firstItem() }}–{{ $peminjaman->lastItem() }}</strong>
                        dari <strong>{{ $peminjaman->total() }}</strong> data
                    </div>
                    <div class="pagination">
                        @if($peminjaman->onFirstPage())
                            <button class="page-btn" disabled><i class="fas fa-chevron-left" style="font-size:0.7rem"></i></button>
                        @else
                            <a href="{{ $peminjaman->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                               class="page-btn"><i class="fas fa-chevron-left" style="font-size:0.7rem"></i></a>
                        @endif

                        @foreach($peminjaman->getUrlRange(
                            max(1, $peminjaman->currentPage()-2),
                            min($peminjaman->lastPage(), $peminjaman->currentPage()+2)
                        ) as $page => $url)
                            <a href="{{ $url }}"
                               class="page-btn {{ $page === $peminjaman->currentPage() ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if($peminjaman->hasMorePages())
                            <a href="{{ $peminjaman->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                               class="page-btn"><i class="fas fa-chevron-right" style="font-size:0.7rem"></i></a>
                        @else
                            <button class="page-btn" disabled><i class="fas fa-chevron-right" style="font-size:0.7rem"></i></button>
                        @endif
                    </div>
                </div>

                @else
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fas fa-exchange-alt"></i></div>
                    <h3>Tidak ada data peminjaman</h3>
                    <p>
                        @if(request('search'))
                            Tidak ditemukan hasil untuk "<strong>{{ request('search') }}</strong>"
                        @elseif(request('status'))
                            Belum ada peminjaman dengan status <strong>{{ request('status') }}</strong>
                        @else
                            Belum ada anggota yang melakukan peminjaman buku.
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

    {{-- MODAL DETAIL --}}
    <div class="modal-overlay" id="modalDetail">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fas fa-info-circle"></i> Detail Peminjaman
                </div>
                <button class="modal-close" onclick="closeModal('modalDetail')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" id="detailBody"></div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeModal('modalDetail')">Tutup</button>
            </div>
        </div>
    </div>

    {{-- MODAL KEMBALIKAN --}}
    <div class="modal-overlay" id="modalKembalikan">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fas fa-undo-alt"></i> Konfirmasi Pengembalian
                </div>
                <button class="modal-close" onclick="closeModal('modalKembalikan')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" style="text-align:center; padding:2rem 1.5rem">
                <div class="confirm-icon"><i class="fas fa-undo-alt"></i></div>
                <div class="confirm-text">
                    <h3>Kembalikan Buku?</h3>
                    <p id="kembalikanText">Buku akan ditandai sebagai dikembalikan dan stok akan bertambah kembali.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeModal('modalKembalikan')">Batal</button>
                <form id="formKembalikan" method="POST" style="display:inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-undo-alt"></i> Ya, Kembalikan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal-overlay" id="modalHapus">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title" style="color:#dc2626">
                    <i class="fas fa-trash"></i> Hapus Data Peminjaman
                </div>
                <button class="modal-close" onclick="closeModal('modalHapus')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" style="text-align:center; padding:2rem 1.5rem">
                <div class="confirm-icon danger"><i class="fas fa-trash"></i></div>
                <div class="confirm-text">
                    <h3>Hapus Data Ini?</h3>
                    <p id="hapusText">Data peminjaman akan dihapus permanen dan tidak dapat dikembalikan.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
                <form id="formHapus" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:#dc2626;" class="btn-primary">
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

        function openDetail(data) {
            const statusMap = {
                aktif:        '<span class="badge badge-aktif"><span class="badge-dot"></span> Aktif</span>',
                kadaluarsa:   '<span class="badge badge-kadaluarsa"><span class="badge-dot"></span> Kadaluarsa</span>',
                dikembalikan: '<span class="badge badge-dikembalikan"><span class="badge-dot"></span> Dikembalikan</span>',
            };

            document.getElementById('detailBody').innerHTML = `
                <div class="detail-row">
                    <div class="detail-key">ID Peminjaman</div>
                    <div class="detail-val">#${data.id}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-key">Judul Buku</div>
                    <div class="detail-val">${data.buku}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-key">Pengarang</div>
                    <div class="detail-val">${data.penulis}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-key">Email Member</div>
                    <div class="detail-val">${data.member}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-key">Tanggal Pinjam</div>
                    <div class="detail-val">${data.pinjam}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-key">Batas Pinjam</div>
                    <div class="detail-val">${data.batas}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-key">Status</div>
                    <div class="detail-val">${statusMap[data.status] || data.status}</div>
                </div>
            `;
            openModal('modalDetail');
        }

        function openKembalikan(id, judul) {
            document.getElementById('kembalikanText').innerHTML =
                `Buku <strong>"${judul}"</strong> akan ditandai sebagai dikembalikan dan stok akan bertambah otomatis.`;
            document.getElementById('formKembalikan').action = `/admin/peminjaman/${id}/kembalikan`;
            openModal('modalKembalikan');
        }

        function openHapus(id, judul) {
            document.getElementById('hapusText').innerHTML =
                `Data peminjaman buku <strong>"${judul}"</strong> akan dihapus permanen.`;
            document.getElementById('formHapus').action = `/admin/peminjaman/${id}`;
            openModal('modalHapus');
        }

        const searchInput = document.querySelector('.search-box input');
        let searchTimer;
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => searchInput.closest('form').submit(), 500);
            });
        }
    </script>

</body>
</html>