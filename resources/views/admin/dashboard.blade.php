<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin — Readify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
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

        .logout-btn:hover {
            background: rgba(239,68,68,0.22);
            color: #fff;
        }

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

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-title { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); }
        .breadcrumb { font-size: 0.8rem; color: var(--text-muted); margin-top: 1px; }
        .breadcrumb span { color: var(--accent-dark); font-weight: 600; }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

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
        .content {
            padding: 2rem;
            flex: 1;
        }

        /* Alert */
        .alert-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-left: 4px solid #3b82f6;
            border-radius: 10px;
            padding: 0.9rem 1.25rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.9rem;
            color: #1e40af;
        }

        /* Stats cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
            position: relative;
        }

        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
        }

        .stat-card.blue::after   { background: #3b82f6; }
        .stat-card.green::after  { background: #22c55e; }
        .stat-card.yellow::after { background: #f59e0b; }
        .stat-card.red::after    { background: #ef4444; }

        .stat-info { flex: 1; }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .stat-card.blue   .stat-number { color: #3b82f6; }
        .stat-card.green  .stat-number { color: #22c55e; }
        .stat-card.yellow .stat-number { color: #f59e0b; }
        .stat-card.red    .stat-number { color: #ef4444; }

        .stat-label { font-size: 0.85rem; font-weight: 600; color: var(--text-muted); }

        .stat-link {
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            text-decoration: none;
            opacity: 0.8;
        }

        .stat-card.blue   .stat-link { color: #3b82f6; }
        .stat-card.green  .stat-link { color: #22c55e; }
        .stat-card.yellow .stat-link { color: #f59e0b; }
        .stat-card.red    .stat-link { color: #ef4444; }

        .stat-icon {
            width: 56px; height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stat-card.blue   .stat-icon { background: #eff6ff; color: #3b82f6; }
        .stat-card.green  .stat-icon { background: #f0fdf4; color: #22c55e; }
        .stat-card.yellow .stat-icon { background: #fffbeb; color: #f59e0b; }
        .stat-card.red    .stat-icon { background: #fef2f2; color: #ef4444; }

        /* ── CHART SECTION ── */
        .chart-section {
            background: var(--white);
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-title i {
            color: var(--accent-dark);
        }

        .chart-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            background: rgba(132,204,22,0.1);
            color: var(--accent-dark);
            border-radius: 999px;
            border: 1px solid rgba(132,204,22,0.25);
        }

        .chart-container {
            position: relative;
            height: 280px;
        }

        /* ── RECENT TABLE ── */
        .recent-section {
            background: var(--white);
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i { color: var(--accent-dark); }

        .view-all-btn {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--accent-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.8rem;
            border: 1px solid rgba(22,163,74,0.3);
            border-radius: 999px;
            transition: all 0.2s;
        }

        .view-all-btn:hover {
            background: rgba(22,163,74,0.08);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            padding: 0.6rem 1rem;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table th:first-child { border-radius: 8px 0 0 8px; }
        .data-table th:last-child  { border-radius: 0 8px 8px 0; }

        .data-table td {
            padding: 0.85rem 1rem;
            font-size: 0.875rem;
            border-bottom: 1px solid #f1f5f9;
            color: var(--text-dark);
        }

        .data-table tr:last-child td { border-bottom: none; }

        .data-table tr:hover td { background: #fafbfc; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-admin   { background: rgba(132,204,22,0.12); color: #16A34A; }
        .badge-member  { background: rgba(59,130,246,0.12); color: #2563eb; }

        /* Footer */
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
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h1>Readify</h1>
            <p>Admin Panel</p>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">
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

    {{-- MAIN --}}
    <div class="main-wrapper">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div class="topbar-left">
                <div>
                    <div class="page-title">Dashboard</div>
                    <div class="breadcrumb">Home / <span>Dashboard</span></div>
                </div>
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

        {{-- CONTENT --}}
        <main class="content">

            <div class="alert-info">
                <i class="fas fa-info-circle"></i>
                Anda login sebagai Administrator. Selamat datang di panel Readify.
            </div>

            {{-- STATS GRID --}}
            <div class="stats-grid">
                <div class="stat-card red">
                    <div class="stat-info">
                        <div class="stat-number">{{ $totalAnggota }}</div>
                        <div class="stat-label">Anggota Aktif</div>
                        <a href="#" class="stat-link">Kelola Anggota <i class="fas fa-arrow-right" style="font-size:0.65rem"></i></a>
                    </div>
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                </div>

                <div class="stat-card blue">
                    <div class="stat-info">
                        <div class="stat-number">{{ $totalBuku }}</div>
                        <div class="stat-label">Koleksi Buku</div>
                        <a href="{{ route('admin.buku.index') }}" class="stat-link">Kelola Buku <i class="fas fa-arrow-right" style="font-size:0.65rem"></i></a>
                    </div>
                    <div class="stat-icon"><i class="fas fa-book"></i></div>
                </div>

                <div class="stat-card yellow">
                    <div class="stat-info">
                        <div class="stat-number">{{ $totalPeminjaman }}</div>
                        <div class="stat-label">Peminjaman Aktif</div>
                        <a href="#" class="stat-link">Lihat Detail <i class="fas fa-arrow-right" style="font-size:0.65rem"></i></a>
                    </div>
                    <div class="stat-icon"><i class="fas fa-exchange-alt"></i></div>
                </div>

                <div class="stat-card green">
                    <div class="stat-info">
                        <div class="stat-number">{{ $totalKategori }}</div>
                        <div class="stat-label">Kategori</div>
                        <a href="{{ route('admin.kategori.index') }}" class="stat-link">Lihat Detail <i class="fas fa-arrow-right" style="font-size:0.65rem"></i></a>
                    </div>
                    <div class="stat-icon"><i class="fas fa-tags"></i></div>
                </div>
            </div>

            {{-- CHART AKTIVITAS LOGIN --}}
            <div class="chart-section">
                <div class="chart-header">
                    <div class="chart-title">
                        <i class="fas fa-chart-line"></i>
                        Aktivitas Login
                    </div>
                    <span class="chart-badge">7 Hari Terakhir</span>
                </div>
                <div class="chart-container">
                    <canvas id="loginChart"></canvas>
                </div>
            </div>

            {{-- TABEL PENGGUNA TERBARU --}}
            <div class="recent-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-user-clock"></i>
                        Pengguna Terbaru
                    </div>
                    <a href="#" class="view-all-btn">
                        Lihat Semua <i class="fas fa-arrow-right" style="font-size:0.7rem"></i>
                    </a>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Daftar</th>
                            <th>Login Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-member' }}">
                                    <i class="fas {{ $user->role === 'admin' ? 'fa-shield-alt' : 'fa-user' }}" style="font-size:0.65rem"></i>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->tanggal_daftar)->format('d M Y') }}</td>
                            <td>{{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d M Y') : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </main>

        <footer class="content-footer">
            <span>© Copyright <strong>Readify</strong>. All Rights Reserved</span>
            <span>Logged in as: <strong>{{ Auth::user()->email }}</strong> (Admin)</span>
        </footer>

    </div>

    <script>
        // Data untuk chart dari Laravel (via JSON)
        const loginData = @json($loginActivity);

// Pastikan data terbaca dengan benar
console.log('Login Data:', loginData); // ← tambahkan ini untuk debug

const labels = loginData.map(d => d.tanggal);
const counts = loginData.map(d => parseInt(d.jumlah));

        const ctx = document.getElementById('loginChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Login',
                    data: counts,
                    borderColor: '#84CC16',
                    backgroundColor: 'rgba(132, 204, 22, 0.08)',
                    borderWidth: 2.5,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#84CC16',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1a1a2e',
                        titleColor: '#84CC16',
                        bodyColor: '#fff',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            title: ctx => 'Tanggal: ' + ctx[0].label,
                            label: ctx => ' Login: ' + ctx.parsed.y + ' pengguna',
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 12 },
                            color: '#64748b'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: {
                            stepSize: 1,
                            font: { family: 'Plus Jakarta Sans', size: 12 },
                            color: '#64748b'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>