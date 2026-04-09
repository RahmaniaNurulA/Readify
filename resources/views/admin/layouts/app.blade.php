<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Readify</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
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
            transition: transform 0.3s ease;
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

        .menu-item:hover {
            color: var(--white);
            background: rgba(255,255,255,0.05);
        }

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
        .breadcrumb a { color: inherit; text-decoration: none; }

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

        /* ── ALERT ── */
        .alert {
            padding: 0.9rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.9rem;
        }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #22c55e; color: #15803d; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444; color: #b91c1c; }
        .alert-info    { background: #eff6ff; border: 1px solid #bfdbfe; border-left: 4px solid #3b82f6; color: #1e40af; }
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
        <a href="{{ route('admin.dashboard') }}"
           class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <div class="menu-label">Perpustakaan</div>
        <a href="{{ route('admin.buku.index') }}"
           class="menu-item {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Kelola Buku
        </a>
        <a href="{{ route('admin.kategori.index') }}"
           class="menu-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Kategori Buku
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-exchange-alt"></i> Peminjaman
        </a>

        <div class="menu-label">Pengguna</div>
        <a href="#" class="menu-item">
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
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <div class="breadcrumb">@yield('breadcrumb')</div>
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
        @yield('content')
    </main>

    <footer class="content-footer">
        <span>© Copyright <strong>Readify</strong>. All Rights Reserved</span>
        <span>Logged in as: <strong>{{ Auth::user()->email }}</strong> (Admin)</span>
    </footer>
</div>

@stack('scripts')
</body>
</html>