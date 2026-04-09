<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Buku — Readify</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--body-bg); color: var(--text-dark); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: var(--sidebar-w); background: var(--sidebar-bg); min-height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 100; }
        .sidebar-brand { padding: 1.5rem 1.5rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.07); }
        .sidebar-brand h1 { font-size: 1.6rem; font-weight: 800; background: linear-gradient(135deg, #84CC16, #BEF264); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .sidebar-brand p { font-size: 0.72rem; color: rgba(255,255,255,0.35); margin-top: 0.2rem; letter-spacing: 0.08em; text-transform: uppercase; }
        .sidebar-menu { padding: 1rem 0; flex: 1; overflow-y: auto; }
        .menu-label { font-size: 0.68rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.25); padding: 1rem 1.5rem 0.4rem; }
        .menu-item { display: flex; align-items: center; gap: 0.85rem; padding: 0.75rem 1.5rem; color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: all 0.2s; border-left: 3px solid transparent; }
        .menu-item:hover { color: var(--white); background: rgba(255,255,255,0.05); }
        .menu-item.active { color: var(--accent); background: rgba(132,204,22,0.1); border-left-color: var(--accent); }
        .menu-item i { width: 18px; text-align: center; font-size: 0.95rem; }
        .sidebar-footer { padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,0.07); }
        .logout-btn { display: flex; align-items: center; gap: 0.75rem; width: 100%; padding: 0.75rem 1rem; background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; color: #fca5a5; font-size: 0.88rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: all 0.2s; }
        .logout-btn:hover { background: rgba(239,68,68,0.22); color: #fff; }

        /* MAIN */
        .main-wrapper { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar { height: var(--topbar-h); background: var(--white); border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; position: sticky; top: 0; z-index: 50; box-shadow: 0 1px 8px rgba(0,0,0,0.06); }
        .page-title { font-size: 1.1rem; font-weight: 700; }
        .breadcrumb { font-size: 0.8rem; color: var(--text-muted); margin-top: 1px; }
        .breadcrumb span { color: var(--accent-dark); font-weight: 600; }
        .admin-badge { display: flex; align-items: center; gap: 0.6rem; padding: 0.4rem 0.9rem; background: rgba(132,204,22,0.1); border: 1px solid rgba(132,204,22,0.25); border-radius: 999px; }
        .admin-avatar { width: 30px; height: 30px; background: linear-gradient(135deg, #84CC16, #16A34A); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: 700; }
        .admin-name { font-size: 0.85rem; font-weight: 600; }
        .admin-role { font-size: 0.72rem; color: var(--accent-dark); font-weight: 600; }

        /* CONTENT */
        .content { padding: 2rem; flex: 1; }
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem; }
        .page-header-left h2 { font-size: 1.4rem; font-weight: 800; }
        .page-header-left p { font-size: 0.85rem; color: var(--text-muted); margin-top: 0.2rem; }
        .btn-tambah { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.25rem; background: linear-gradient(135deg, #84CC16, #16A34A); color: white; border: none; border-radius: 10px; font-size: 0.9rem; font-weight: 700; font-family: inherit; cursor: pointer; text-decoration: none; transition: all 0.2s; box-shadow: 0 4px 14px rgba(132,204,22,0.35); }
        .btn-tambah:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(132,204,22,0.45); }

        /* TOOLBAR */
        .toolbar { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .search-box { display: flex; align-items: center; gap: 0.5rem; background: var(--white); border: 1px solid #e2e8f0; border-radius: 10px; padding: 0.55rem 1rem; flex: 1; min-width: 220px; box-shadow: 0 1px 4px rgba(0,0,0,0.05); }
        .search-box i { color: var(--text-muted); font-size: 0.85rem; }
        .search-box input { border: none; outline: none; font-family: inherit; font-size: 0.875rem; color: var(--text-dark); background: transparent; width: 100%; }
        .search-box input::placeholder { color: var(--text-muted); }
        .filter-select { padding: 0.55rem 1rem; border: 1px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 0.875rem; color: var(--text-dark); background: var(--white); cursor: pointer; outline: none; box-shadow: 0 1px 4px rgba(0,0,0,0.05); }

        /* BOOK GRID */
        .books-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.25rem; }

        /* ── PERBAIKAN UTAMA: card dibagi 2 bagian ── */
        .book-card-wrap { position: relative; border-radius: 14px; overflow: hidden; box-shadow: var(--card-shadow); background: var(--white); transition: transform 0.25s, box-shadow 0.25s; }
        .book-card-wrap:hover { transform: translateY(-5px); box-shadow: 0 12px 28px rgba(0,0,0,0.13); }

        /* Link ke detail — hanya cover & info, BUKAN action buttons */
        .book-card-link { display: block; text-decoration: none; color: inherit; }

        .book-cover { width: 100%; aspect-ratio: 3/4; background: linear-gradient(135deg, #e2e8f0, #cbd5e1); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; }
        .book-cover img { width: 100%; height: 100%; object-fit: cover; }
        .book-cover-placeholder { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; color: #94a3b8; }
        .book-cover-placeholder i { font-size: 2.5rem; }
        .book-cover-placeholder span { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
        .book-kategori-badge { position: absolute; top: 0.6rem; left: 0.6rem; background: rgba(26,26,46,0.75); backdrop-filter: blur(6px); color: #BEF264; font-size: 0.65rem; font-weight: 700; padding: 0.2rem 0.55rem; border-radius: 999px; text-transform: uppercase; letter-spacing: 0.06em; }
        .book-stock-badge { position: absolute; top: 0.6rem; right: 0.6rem; background: rgba(255,255,255,0.9); backdrop-filter: blur(6px); font-size: 0.65rem; font-weight: 700; padding: 0.2rem 0.55rem; border-radius: 999px; }
        .badge-ok   { color: #16A34A; }
        .badge-low  { color: #f59e0b; }
        .badge-zero { color: #ef4444; }
        .book-info { padding: 0.85rem; }
        .book-title { font-size: 0.875rem; font-weight: 700; color: var(--text-dark); line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 0.3rem; }
        .book-author { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .book-year-row { display: flex; align-items: center; margin-top: 0.55rem; }
        .book-year { font-size: 0.72rem; color: var(--text-muted); }

        /* Action buttons — TERPISAH dari link */
        .book-actions {
            display: flex;
            gap: 0.4rem;
            padding: 0 0.85rem 0.85rem;
            border-top: 1px solid #f1f5f9;
            padding-top: 0.65rem;
        }
        .btn-icon {
            flex: 1; height: 30px; border-radius: 7px;
            border: none; cursor: pointer; display: flex;
            align-items: center; justify-content: center;
            gap: 0.3rem; font-size: 0.72rem; font-weight: 600;
            font-family: inherit; transition: all 0.2s;
            text-decoration: none;
        }
        .btn-edit   { background: #eff6ff; color: #3b82f6; }
        .btn-delete { background: #fef2f2; color: #ef4444; }
        .btn-edit:hover   { background: #3b82f6; color: white; }
        .btn-delete:hover { background: #ef4444; color: white; }

        /* ALERT */
        .alert { padding: 0.9rem 1.25rem; border-radius: 10px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.6rem; font-size: 0.9rem; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #22c55e; color: #15803d; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444; color: #b91c1c; }

        /* EMPTY STATE */
        .empty-state { grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; color: var(--text-muted); }
        .empty-state i { font-size: 3.5rem; margin-bottom: 1rem; opacity: 0.3; display: block; }
        .empty-state h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-dark); }
        .empty-state p { font-size: 0.875rem; }

        /* MODAL */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; align-items: center; justify-content: center; }
        .modal-overlay.show { display: flex; }
        .modal-box { background: var(--white); border-radius: 16px; padding: 2rem; max-width: 380px; width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,0.2); text-align: center; }
        .modal-icon { width: 56px; height: 56px; background: #fef2f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
        .modal-icon i { color: #ef4444; font-size: 1.4rem; }
        .modal-title { font-size: 1.05rem; font-weight: 800; margin-bottom: 0.5rem; }
        .modal-desc  { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6; }
        .modal-desc strong { color: var(--text-dark); }
        .modal-actions { display: flex; gap: 0.75rem; }
        .btn-batal  { flex: 1; padding: 0.7rem; border: 1.5px solid #e2e8f0; border-radius: 10px; background: none; font-family: inherit; font-size: 0.875rem; font-weight: 600; color: var(--text-muted); cursor: pointer; }
        .btn-batal:hover { background: #f8fafc; }
        .btn-hapus  { flex: 1; padding: 0.7rem; background: #ef4444; border: none; border-radius: 10px; font-family: inherit; font-size: 0.875rem; font-weight: 700; color: white; cursor: pointer; }
        .btn-hapus:hover { background: #dc2626; }

        /* FOOTER */
        .content-footer { padding: 1rem 2rem; border-top: 1px solid #e2e8f0; background: var(--white); font-size: 0.8rem; color: var(--text-muted); display: flex; justify-content: space-between; }
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
        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <div class="menu-label">Perpustakaan</div>
        <a href="{{ route('admin.buku.index') }}" class="menu-item active">
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
    <header class="topbar">
        <div>
            <div class="page-title">Kelola Buku</div>
            <div class="breadcrumb">Home / <span>Kelola Buku</span></div>
        </div>
        <div class="admin-badge">
            <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->email, 0, 1)) }}</div>
            <div>
                <div class="admin-name">{{ Auth::user()->email }}</div>
                <div class="admin-role">Administrator</div>
            </div>
        </div>
    </header>

    <main class="content">

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        <div class="page-header">
            <div class="page-header-left">
                <h2>Daftar Buku</h2>
                <p>Total {{ $buku->count() }} buku dalam koleksi perpustakaan</p>
            </div>
            <a href="{{ route('admin.buku.create') }}" class="btn-tambah">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>
        </div>

        <div class="toolbar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari judul buku atau pengarang...">
            </div>
            <select class="filter-select" id="filterKategori">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="books-grid" id="booksGrid">
            @forelse($buku as $b)
            {{-- WRAP: bukan <a> lagi, tapi <div> --}}
            <div class="book-card-wrap"
                 data-judul="{{ strtolower($b->judul_buku) }}"
                 data-pengarang="{{ strtolower($b->pengarang) }}"
                 data-kategori="{{ $b->nama_kategori ?? '' }}">

                {{-- Link ke detail — hanya cover + info --}}
                <a href="{{ route('admin.buku.show', $b->id_buku) }}" class="book-card-link">
                    <div class="book-cover">
                        @if($b->cover)
                            <img src="{{ asset('storage/' . $b->cover) }}" alt="{{ $b->judul_buku }}">
                        @else
                            <div class="book-cover-placeholder">
                                <i class="fas fa-book-open"></i>
                                <span>No Cover</span>
                            </div>
                        @endif
                        @if($b->nama_kategori)
                        <span class="book-kategori-badge">{{ $b->nama_kategori }}</span>
                        @endif
                        <span class="book-stock-badge {{ $b->jumlah_buku > 3 ? 'badge-ok' : ($b->jumlah_buku > 0 ? 'badge-low' : 'badge-zero') }}">
                            <i class="fas fa-layer-group" style="font-size:0.6rem"></i>
                            {{ $b->jumlah_buku }}
                        </span>
                    </div>
                    <div class="book-info">
                        <div class="book-title">{{ $b->judul_buku }}</div>
                        <div class="book-author">
                            <i class="fas fa-user-pen" style="font-size:0.65rem;margin-right:3px"></i>
                            {{ $b->pengarang }}
                        </div>
                        <div class="book-year-row">
                            <span class="book-year">
                                <i class="fas fa-calendar" style="font-size:0.65rem;margin-right:3px"></i>
                                {{ $b->tahun_terbit }}
                            </span>
                        </div>
                    </div>
                </a>

                {{-- Tombol aksi — DI LUAR link, tidak nested --}}
                <div class="book-actions">
                    <a href="{{ route('admin.buku.edit', $b->id_buku) }}"
                       class="btn-icon btn-edit">
                        <i class="fas fa-pen"></i> Edit
                    </a>
                    <button type="button"
                            class="btn-icon btn-delete"
                            onclick="konfirmasiHapus({{ $b->id_buku }}, '{{ addslashes($b->judul_buku) }}')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>

            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h3>Belum ada buku</h3>
                <p>Klik tombol "Tambah Buku" untuk menambahkan koleksi pertama.</p>
            </div>
            @endforelse
        </div>

    </main>

    <footer class="content-footer">
        <span>© {{ date('Y') }} <strong>Readify</strong>. All Rights Reserved</span>
        <span>Login sebagai: <strong>{{ Auth::user()->email }}</strong> (Admin)</span>
    </footer>
</div>

{{-- MODAL KONFIRMASI HAPUS --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal-box">
        <div class="modal-icon">
            <i class="fas fa-trash"></i>
        </div>
        <div class="modal-title">Hapus Buku?</div>
        <p class="modal-desc">
            Buku <strong id="modalJudul"></strong> akan dihapus secara permanen
            beserta file cover dan file bukunya.
        </p>
        <div class="modal-actions">
            <button class="btn-batal" onclick="tutupModal()">Batal</button>
            {{-- Form DELETE terpisah, dipanggil via JS --}}
            <form id="formHapus" method="POST" style="flex:1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus" style="width:100%">
                    <i class="fas fa-trash" style="margin-right:0.3rem"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // ── Live search & filter ──
    const searchInput    = document.getElementById('searchInput');
    const filterKategori = document.getElementById('filterKategori');
    const cards          = document.querySelectorAll('.book-card-wrap');

    function filterBooks() {
        const q   = searchInput.value.toLowerCase();
        const kat = filterKategori.value.toLowerCase();
        cards.forEach(card => {
            const judul     = card.dataset.judul     || '';
            const pengarang = card.dataset.pengarang || '';
            const kategori  = card.dataset.kategori  || '';
            const matchQ   = judul.includes(q) || pengarang.includes(q);
            const matchKat = kat === '' || kategori.toLowerCase() === kat;
            card.style.display = (matchQ && matchKat) ? '' : 'none';
        });
    }
    searchInput.addEventListener('input', filterBooks);
    filterKategori.addEventListener('change', filterBooks);

    // ── Modal hapus ──
    function konfirmasiHapus(id, judul) {
        document.getElementById('modalJudul').textContent = judul;
        document.getElementById('formHapus').action = '/admin/buku/' + id;
        document.getElementById('modalHapus').classList.add('show');
    }

    function tutupModal() {
        document.getElementById('modalHapus').classList.remove('show');
    }

    document.getElementById('modalHapus').addEventListener('click', function(e) {
        if (e.target === this) tutupModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') tutupModal();
    });
</script>

</body>
</html>