<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori Buku — Readify</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .sidebar-menu { padding: 1rem 0; flex: 1; overflow-y: auto; }

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

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .page-header-left h2 {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .page-header-left p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 0.2rem;
        }

        /* ── ADD KATEGORI BUTTON ── */
        .btn-add-kategori {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.75rem 1.4rem;
            background: linear-gradient(135deg, #84CC16, #16A34A);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(132,204,22,0.35);
            transition: all 0.2s;
        }

        .btn-add-kategori:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(132,204,22,0.45);
        }

        /* ── ALERT ── */
        .alert {
            padding: 0.85rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.88rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        /* ── KATEGORI GRID ── */
        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        /* ── KATEGORI CARD ── */
        .kategori-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 1px solid #f1f5f9;
        }

        .kategori-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.12);
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-header-left {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .kategori-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(132,204,22,0.15), rgba(22,163,74,0.15));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--accent-dark);
        }

        .kategori-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .kategori-count {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.15rem;
        }

        /* Actions on card header */
        .card-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 34px; height: 34px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.18s;
        }

        .btn-icon-edit {
            background: rgba(59,130,246,0.1);
            color: #3b82f6;
        }

        .btn-icon-edit:hover { background: rgba(59,130,246,0.22); }

        .btn-icon-delete {
            background: rgba(239,68,68,0.1);
            color: #ef4444;
        }

        .btn-icon-delete:hover { background: rgba(239,68,68,0.22); }

        /* ── BUKU LIST in card ── */
        .buku-list {
            padding: 0.75rem 1.5rem;
            min-height: 60px;
            max-height: 200px;
            overflow-y: auto;
        }

        .buku-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.55rem 0;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.85rem;
        }

        .buku-item:last-child { border-bottom: none; }

        .buku-item-left {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .buku-item-left i { color: var(--accent-dark); font-size: 0.8rem; }

        .buku-item-title { font-weight: 600; color: var(--text-dark); }

        .buku-item-author { font-size: 0.75rem; color: var(--text-muted); }

        .btn-remove-buku {
            background: none;
            border: none;
            color: #fca5a5;
            cursor: pointer;
            font-size: 0.8rem;
            padding: 0.25rem 0.4rem;
            border-radius: 6px;
            transition: all 0.15s;
        }

        .btn-remove-buku:hover { background: rgba(239,68,68,0.1); color: #ef4444; }

        .empty-buku {
            text-align: center;
            padding: 1rem 0;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .empty-buku i { font-size: 1.4rem; color: #cbd5e1; display: block; margin-bottom: 0.3rem; }

        /* ── CARD FOOTER with Add Buku Button ── */
        .card-footer {
            padding: 0.85rem 1.5rem;
            border-top: 1px solid #f1f5f9;
        }

        .btn-add-buku {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.6rem;
            border: 2px dashed rgba(132,204,22,0.4);
            border-radius: 10px;
            background: rgba(132,204,22,0.04);
            color: var(--accent-dark);
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-add-buku:hover {
            border-color: var(--accent-dark);
            background: rgba(132,204,22,0.1);
        }

        /* ── EMPTY STATE for grid ── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        /* ── MODAL OVERLAY ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(4px);
            z-index: 500;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open { display: flex; }

        .modal {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            width: 100%;
            max-width: 480px;
            margin: 1rem;
            box-shadow: 0 24px 64px rgba(0,0,0,0.2);
            animation: modalIn 0.22s ease;
        }

        @keyframes modalIn {
            from { transform: scale(0.94) translateY(12px); opacity: 0; }
            to   { transform: scale(1) translateY(0); opacity: 1; }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .modal-title i { color: var(--accent-dark); }

        .modal-close {
            width: 34px; height: 34px;
            border-radius: 8px;
            border: none;
            background: #f1f5f9;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s;
        }

        .modal-close:hover { background: #e2e8f0; color: var(--text-dark); }

        /* ── FORM ELEMENTS ── */
        .form-group { margin-bottom: 1.25rem; }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.45rem;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-dark);
            background: #fafbfc;
            transition: border-color 0.2s;
            outline: none;
        }

        .form-input:focus, .form-select:focus {
            border-color: var(--accent);
            background: var(--white);
        }

        .form-select { cursor: pointer; }

        /* Search inside modal */
        .search-wrapper {
            position: relative;
            margin-bottom: 0.75rem;
        }

        .search-wrapper i {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .search-wrapper input {
            width: 100%;
            padding: 0.65rem 1rem 0.65rem 2.4rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.88rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-wrapper input:focus { border-color: var(--accent); }

        /* Buku selection list in modal */
        .buku-select-list {
            max-height: 220px;
            overflow-y: auto;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            background: #fafbfc;
        }

        .buku-select-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background 0.15s;
            border-bottom: 1px solid #f1f5f9;
        }

        .buku-select-item:last-child { border-bottom: none; }

        .buku-select-item:hover { background: rgba(132,204,22,0.06); }

        .buku-select-item.selected { background: rgba(132,204,22,0.1); }

        .buku-select-item input[type="checkbox"] {
            accent-color: var(--accent-dark);
            width: 16px; height: 16px;
            cursor: pointer;
        }

        .buku-select-info { flex: 1; }

        .buku-select-title {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .buku-select-author {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .no-buku-found {
            text-align: center;
            padding: 1.5rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* ── MODAL FOOTER ── */
        .modal-footer {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .btn-cancel {
            flex: 1;
            padding: 0.75rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover { background: #f8fafc; color: var(--text-dark); }

        .btn-submit {
            flex: 2;
            padding: 0.75rem;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #84CC16, #16A34A);
            color: #fff;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(132,204,22,0.3);
            transition: all 0.2s;
        }

        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(132,204,22,0.4); }

        /* ── FOOTER ── */
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

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
    </style>
</head>
<body>

    {{-- ─────────────── SIDEBAR ─────────────── --}}
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
            <a href="{{ route('admin.kategori.index') }}" class="menu-item active">
                <i class="fas fa-tags"></i> Kategori
            </a>
            <a href="{{ route('admin.peminjaman.index') }}" class="menu-item">
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

    {{-- ─────────────── MAIN ─────────────── --}}
    <div class="main-wrapper">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div>
                <div class="page-title">Kategori Buku</div>
                <div class="breadcrumb">Home / Perpustakaan / <span>Kategori</span></div>
            </div>
            <div class="admin-badge">
                <div class="admin-avatar">A</div>
                <div>
                    <div class="admin-name">{{ Auth::user()->email }}</div>
                    <div class="admin-role">Administrator</div>
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="content">

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
            @endif

            {{-- PAGE HEADER --}}
            <div class="page-header">
                <div class="page-header-left">
                    <h2>Kelola Kategori</h2>
                    <p>{{ $kategoris->count() }} kategori tersedia · Tambah buku ke kategori atau buat kategori baru</p>
                </div>
                {{-- TOMBOL + KATEGORI --}}
                <button class="btn-add-kategori" onclick="openModalKategori()">
                    <i class="fas fa-plus"></i> + Kategori
                </button>
            </div>

            {{-- KATEGORI GRID --}}
            <div class="kategori-grid">

                @forelse($kategoris as $kategori)
                <div class="kategori-card">

                    {{-- Card Header --}}
                    <div class="card-header">
                        <div class="card-header-left">
                            <div class="kategori-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div>
                                <div class="kategori-name">{{ $kategori->nama_kategori }}</div>
                                <div class="kategori-count">
                                    {{ $kategori->bukus->count() }} buku
                                </div>
                            </div>
                        </div>
                        <div class="card-actions">
                            {{-- Edit Kategori --}}
                            <button class="btn-icon btn-icon-edit"
                                title="Edit nama kategori"
                                onclick="openModalEditKategori({{ $kategori->id_kategori }}, '{{ addslashes($kategori->nama_kategori) }}')">
                                <i class="fas fa-pen"></i>
                            </button>
                            {{-- Delete Kategori --}}
                            <form method="POST" action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}"
                                onsubmit="return confirm('Hapus kategori ini? Semua relasi buku akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon-delete" title="Hapus kategori">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Daftar Buku dalam Kategori --}}
                    <div class="buku-list">
                        @forelse($kategori->bukus as $buku)
                        <div class="buku-item">
                            <div class="buku-item-left">
                                <i class="fas fa-book-open"></i>
                                <div>
                                    <div class="buku-item-title">{{ Str::limit($buku->judul_buku, 30) }}</div>
                                    <div class="buku-item-author">{{ $buku->pengarang ?? '-' }}</div>
                                </div>
                            </div>
                            {{-- Remove buku dari kategori ini --}}
                            <form method="POST" action="{{ route('admin.kategori.removeBuku', $kategori->id_kategori) }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="buku_id" value="{{ $buku->id_buku }}">
                                <button type="submit" class="btn-remove-buku" title="Hapus dari kategori">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                        @empty
                        <div class="empty-buku">
                            <i class="fas fa-book-open"></i>
                            Belum ada buku di kategori ini
                        </div>
                        @endforelse
                    </div>

                    {{-- Card Footer: Tambah Buku --}}
                    <div class="card-footer">
                        {{-- TOMBOL + di tiap kategori --}}
                        <button class="btn-add-buku"
                            onclick="openModalAddBuku({{ $kategori->id_kategori }}, '{{ addslashes($kategori->nama_kategori) }}')">
                            <i class="fas fa-plus-circle"></i>
                            Tambah Buku ke Kategori
                        </button>
                    </div>

                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fas fa-tags"></i></div>
                    <h3>Belum ada kategori</h3>
                    <p>Mulai dengan membuat kategori buku pertama Anda.</p>
                    <button class="btn-add-kategori" onclick="openModalKategori()" style="margin:0 auto">
                        <i class="fas fa-plus"></i> Buat Kategori Pertama
                    </button>
                </div>
                @endforelse

            </div>
        </main>

        <footer class="content-footer">
            <span>© Copyright <strong>Readify</strong>. All Rights Reserved</span>
            <span>Logged in as: <strong>{{ Auth::user()->email }}</strong> (Admin)</span>
        </footer>
    </div>

    <div class="modal-overlay" id="modalKategori">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Kategori
                </div>
                <button class="modal-close" onclick="closeModalKategori()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.kategori.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="nama_kategori">Nama Kategori</label>
                    <input
                        class="form-input"
                        type="text"
                        id="nama_kategori"
                        name="nama_kategori"
                        placeholder="cth. Novel, Misteri, Komedi..."
                        required
                        autofocus>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModalKategori()">Batal</button>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-plus"></i> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="modal-overlay" id="modalEditKategori">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fas fa-pen"></i>
                    Edit Kategori
                </div>
                <button class="modal-close" onclick="closeModalEditKategori()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form method="POST" id="formEditKategori">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama Kategori</label>
                    <input class="form-input" type="text" name="nama_kategori" id="editNamaKategori" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModalEditKategori()">Batal</button>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="modal-overlay" id="modalAddBuku">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fas fa-book-medical"></i>
                    <span id="modalAddBukuTitle">Tambah Buku</span>
                </div>
                <button class="modal-close" onclick="closeModalAddBuku()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <p style="font-size:0.82rem;color:var(--text-muted);margin-bottom:1rem;">
                Pilih buku dari koleksi untuk ditambahkan ke kategori ini.
            </p>

            {{-- Search buku --}}
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="searchBuku" placeholder="Cari judul buku..." oninput="filterBuku()">
            </div>

            {{-- List buku (checkbox) --}}
            <div class="buku-select-list" id="bukuSelectList">
                {{-- Populated via JS from $semuaBuku --}}
            </div>

            <form method="POST" id="formAddBuku" action="">
                @csrf
                <div id="hiddenBukuInputs"></div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModalAddBuku()">Batal</button>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-plus"></i> Tambahkan ke Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ─── JavaScript ─── --}}
    <script>
        // Semua buku dari database (dipass dari controller)
        const semuaBuku = @json($semuaBuku);

        // ── MODAL KATEGORI BARU ──────────────────────────────
        function openModalKategori() {
            document.getElementById('modalKategori').classList.add('open');
            setTimeout(() => document.getElementById('nama_kategori').focus(), 100);
        }

        function closeModalKategori() {
            document.getElementById('modalKategori').classList.remove('open');
        }

        // ── MODAL EDIT KATEGORI ──────────────────────────────
        function openModalEditKategori(id, nama) {
            const form = document.getElementById('formEditKategori');
            // Sesuaikan action dengan route edit
            form.action = `/admin/kategori/${id}`;
            document.getElementById('editNamaKategori').value = nama;
            document.getElementById('modalEditKategori').classList.add('open');
            setTimeout(() => document.getElementById('editNamaKategori').focus(), 100);
        }

        function closeModalEditKategori() {
            document.getElementById('modalEditKategori').classList.remove('open');
        }

        // ── MODAL ADD BUKU ───────────────────────────────────
        let currentKategoriId = null;

        function openModalAddBuku(kategoriId, kategoriNama) {
            currentKategoriId = kategoriId;

            document.getElementById('modalAddBukuTitle').textContent =
                `Tambah Buku ke "${kategoriNama}"`;

            // Set form action
            document.getElementById('formAddBuku').action =
                `/admin/kategori/${kategoriId}/buku`;

            // Render daftar buku
            renderBukuList(semuaBuku);

            // Clear search
            document.getElementById('searchBuku').value = '';

            document.getElementById('modalAddBuku').classList.add('open');
        }

        function closeModalAddBuku() {
            document.getElementById('modalAddBuku').classList.remove('open');
            document.getElementById('hiddenBukuInputs').innerHTML = '';
        }

        function renderBukuList(bukuArr) {
            const list = document.getElementById('bukuSelectList');

            if (bukuArr.length === 0) {
                list.innerHTML = `<div class="no-buku-found"><i class="fas fa-search" style="color:#cbd5e1;font-size:1.5rem;display:block;margin-bottom:.5rem"></i>Buku tidak ditemukan</div>`;
                return;
            }

            list.innerHTML = bukuArr.map(b => `
                <label class="buku-select-item" id="item-${b.id}">
                    <input type="checkbox" value="${b.id}" onchange="toggleBukuSelected(this, ${b.id})">
                    <div class="buku-select-info">
                        <div class="buku-select-title">${b.judul_buku}</div>
                        <div class="buku-select-author">${b.pengarang || 'Penulis tidak diketahui'}</div>
                    </div>
                </label>
            `).join('');
        }

        function filterBuku() {
            const q = document.getElementById('searchBuku').value.toLowerCase();
            const filtered = semuaBuku.filter(b =>
                b.judul_buku.toLowerCase().includes(q) ||
                (b.pengarang || '').toLowerCase().includes(q)
            );
            renderBukuList(filtered);
        }

        function toggleBukuSelected(cb, bukuId) {
            const item = document.getElementById(`item-${bukuId}`);
            if (cb.checked) {
                item.classList.add('selected');
                // Tambah hidden input
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'buku_ids[]';
                hidden.value = bukuId;
                hidden.id = `hidden-${bukuId}`;
                document.getElementById('hiddenBukuInputs').appendChild(hidden);
            } else {
                item.classList.remove('selected');
                const el = document.getElementById(`hidden-${bukuId}`);
                if (el) el.remove();
            }
        }

        // ── CLOSE ON BACKDROP CLICK ──────────────────────────
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('open');
                }
            });
        });

        // ── ESC KEY ──────────────────────────────────────────
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay.open').forEach(m => m.classList.remove('open'));
            }
        });
    </script>

</body>
</html>