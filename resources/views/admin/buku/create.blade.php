<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Buku — Readify</title>
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

        /* SIDEBAR (same as index) */
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
        .logout-btn { display: flex; align-items: center; gap: 0.75rem; width: 100%; padding: 0.75rem 1rem; background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; color: #fca5a5; font-size: 0.88rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: all 0.2s; text-decoration: none; }
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

        .back-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            color: var(--text-muted); text-decoration: none;
            font-size: 0.875rem; font-weight: 600;
            margin-bottom: 1.5rem; transition: color 0.2s;
        }
        .back-btn:hover { color: var(--accent-dark); }

        .form-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            max-width: 860px;
        }

        .form-card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .form-card-header .header-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, #84CC16, #16A34A);
            border-radius: 10px; display: flex; align-items: center;
            justify-content: center; color: white; font-size: 1.1rem;
        }
        .form-card-header h3 { font-size: 1rem; font-weight: 700; }
        .form-card-header p { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.1rem; }

        .form-body { padding: 2rem; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }
        .form-row.full { grid-template-columns: 1fr; }

        .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
        .form-group label { font-size: 0.82rem; font-weight: 700; color: var(--text-dark); }
        .form-group label span { color: #ef4444; margin-left: 2px; }

        .form-control {
            padding: 0.65rem 0.9rem; border: 1.5px solid #e2e8f0;
            border-radius: 9px; font-family: inherit; font-size: 0.875rem;
            color: var(--text-dark); background: #fafafa;
            transition: border-color 0.2s, box-shadow 0.2s; outline: none;
        }
        .form-control:focus { border-color: var(--accent); background: white; box-shadow: 0 0 0 3px rgba(132,204,22,0.15); }
        textarea.form-control { resize: vertical; min-height: 100px; }

        .error-msg { font-size: 0.75rem; color: #ef4444; }

        /* Cover Upload */
        .cover-upload-area {
            border: 2px dashed #e2e8f0; border-radius: 12px;
            padding: 1.5rem; text-align: center; cursor: pointer;
            transition: all 0.2s; background: #fafafa; position: relative;
        }
        .cover-upload-area:hover { border-color: var(--accent); background: rgba(132,204,22,0.04); }
        .cover-upload-area.has-preview { border-style: solid; border-color: var(--accent); padding: 0; overflow: hidden; }
        .cover-upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; z-index: 2; }
        .cover-preview { width: 100%; height: 200px; object-fit: cover; border-radius: 10px; display: none; }
        .cover-placeholder { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; color: var(--text-muted); }
        .cover-placeholder i { font-size: 2rem; color: #cbd5e1; }
        .cover-placeholder p { font-size: 0.8rem; }
        .cover-placeholder p strong { color: var(--accent-dark); }

        /* PDF Upload */
        .file-upload-area {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 0.9rem; border: 1.5px solid #e2e8f0;
            border-radius: 9px; background: #fafafa; cursor: pointer;
            transition: all 0.2s; position: relative;
        }
        .file-upload-area:hover { border-color: var(--accent); }
        .file-upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
        .file-upload-area i { color: #ef4444; font-size: 1.1rem; }
        .file-upload-area span { font-size: 0.875rem; color: var(--text-muted); }
        .file-upload-area span.selected { color: var(--text-dark); font-weight: 600; }

        /* Form Footer */
        .form-footer {
            padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem;
        }
        .btn-cancel {
            padding: 0.65rem 1.25rem; border: 1.5px solid #e2e8f0;
            border-radius: 9px; background: white; color: var(--text-muted);
            font-family: inherit; font-size: 0.875rem; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: all 0.2s;
        }
        .btn-cancel:hover { border-color: #94a3b8; color: var(--text-dark); }
        .btn-submit {
            padding: 0.65rem 1.5rem;
            background: linear-gradient(135deg, #84CC16, #16A34A);
            border: none; border-radius: 9px; color: white;
            font-family: inherit; font-size: 0.875rem; font-weight: 700;
            cursor: pointer; display: flex; align-items: center; gap: 0.5rem;
            transition: all 0.2s; box-shadow: 0 4px 14px rgba(132,204,22,0.3);
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(132,204,22,0.4); }

        /* Validation errors box */
        .errors-box {
            background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444;
            border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;
        }
        .errors-box ul { list-style: none; }
        .errors-box li { font-size: 0.85rem; color: #b91c1c; padding: 0.15rem 0; display: flex; align-items: center; gap: 0.4rem; }

        .content-footer { padding: 1rem 2rem; border-top: 1px solid #e2e8f0; background: var(--white); font-size: 0.8rem; color: var(--text-muted); display: flex; justify-content: space-between; }
        .content-footer strong { color: var(--text-dark); }
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
        <a href="{{ route('admin.buku.index') }}" class="menu-item active">
            <i class="fas fa-book"></i> Kelola Buku
        </a>
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
            <div class="page-title">Tambah Buku</div>
            <div class="breadcrumb">Home / <a href="{{ route('admin.buku.index') }}" style="color:inherit;text-decoration:none">Kelola Buku</a> / <span>Tambah</span></div>
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

        @if($errors->any())
        <div class="errors-box">
            <ul>
                @foreach($errors->all() as $err)
                <li><i class="fas fa-circle-xmark"></i> {{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-card">
            <div class="form-card-header">
                <div class="header-icon"><i class="fas fa-book-medical"></i></div>
                <div>
                    <h3>Form Tambah Buku</h3>
                    <p>Isi semua informasi buku dengan lengkap</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.buku.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">

                    <div class="form-row">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Judul Buku <span>*</span></label>
                            <input type="text" name="judul_buku" class="form-control" value="{{ old('judul_buku') }}" placeholder="Masukkan judul buku" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Pengarang <span>*</span></label>
                            <input type="text" name="pengarang" class="form-control" value="{{ old('pengarang') }}" placeholder="Nama pengarang" required>
                        </div>
                        <div class="form-group">
                            <label>Penerbit <span>*</span></label>
                            <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}" placeholder="Nama penerbit" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tahun Terbit <span>*</span></label>
                            <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}" placeholder="cth. 2023" min="1900" max="{{ date('Y') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori <span>*</span></label>
                            <select name="id_kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Jumlah Buku <span>*</span></label>
                            <input type="number" name="jumlah_buku" class="form-control" value="{{ old('jumlah_buku', 1) }}" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>File Buku (PDF/EPUB)</label>
                            <div class="file-upload-area">
                                <input type="file" name="file_buku" id="fileBuku" accept=".pdf,.epub" onchange="updateFileName(this)">
                                <i class="fas fa-file-pdf"></i>
                                <span id="fileLabel">Pilih file PDF atau EPUB...</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Cover Buku</label>
                            <div class="cover-upload-area" id="coverArea">
                                <input type="file" name="cover" id="coverInput" accept="image/*" onchange="previewCover(this)">
                                <img id="coverPreview" class="cover-preview" src="" alt="Preview">
                                <div class="cover-placeholder" id="coverPlaceholder">
                                    <i class="fas fa-image"></i>
                                    <p><strong>Klik untuk upload</strong> atau drag & drop</p>
                                    <p>PNG, JPG, WEBP (maks. 2MB)</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sinopsis</label>
                            <textarea name="sinopsis" class="form-control" placeholder="Tulis sinopsis buku di sini..." style="min-height: 170px">{{ old('sinopsis') }}</textarea>
                        </div>
                    </div>

                </div>

                <div class="form-footer">
                    <a href="{{ route('admin.buku.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="content-footer">
        <span>© Copyright <strong>Readify</strong>. All Rights Reserved</span>
        <span>Logged in as: <strong>{{ Auth::user()->email }}</strong> (Admin)</span>
    </footer>
</div>

<script>
    function previewCover(input) {
        const area = document.getElementById('coverArea');
        const preview = document.getElementById('coverPreview');
        const placeholder = document.getElementById('coverPlaceholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
                area.classList.add('has-preview');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateFileName(input) {
        const label = document.getElementById('fileLabel');
        label.textContent = input.files[0] ? input.files[0].name : 'Pilih file PDF atau EPUB...';
        label.className = input.files[0] ? 'selected' : '';
    }
</script>

</body>
</html>