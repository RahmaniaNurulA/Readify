<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil — Readify</title>
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
        .topbar-icon-btn { width: 38px; height: 38px; border-radius: 50%; background: var(--body-bg); border: 1.5px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--text-muted); text-decoration: none; }

        .content { padding: 1.75rem 2rem; flex: 1; }

        /* PROFIL HERO */
        .profil-hero {
            background: linear-gradient(135deg, #0D3D26, #071A14);
            border-radius: 20px;
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        .profil-avatar {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: var(--grad-lime);
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; font-weight: 800; color: #071A14;
            flex-shrink: 0;
            box-shadow: 0 4px 16px rgba(132,204,22,0.4);
        }

        .profil-hero-info h2 {
            font-size: 1.3rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .profil-hero-info p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.5);
        }

        .profil-hero-badge {
            margin-left: auto;
            padding: 0.4rem 1rem;
            background: rgba(132,204,22,0.15);
            border: 1px solid rgba(132,204,22,0.3);
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* FORM CARD */
        .form-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
        }

        .form-card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-card-title i { color: var(--accent); }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
        .form-group.full { grid-column: 1 / -1; }

        .form-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .form-input, .form-select {
            padding: 0.75rem 1rem;
            background: var(--body-bg);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 0.875rem;
            font-family: inherit;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus, .form-select:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(132,204,22,0.1);
        }

        .form-input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .form-divider {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-muted);
            margin: 0.5rem 0 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-divider::before, .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .btn-simpan {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 2rem;
            background: var(--grad-lime);
            border: none;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: inherit;
            color: #071A14;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-simpan:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(132,204,22,0.35); }

        .alert { padding: 0.85rem 1.25rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.875rem; display: flex; align-items: center; gap: 0.6rem; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #22c55e; color: #15803d; }
        .alert-error { background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444; color: #dc2626; }

        .error-msg { font-size: 0.75rem; color: #ef4444; margin-top: 0.2rem; }

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
        <a href="{{ route('member.dashboard') }}" class="nav-item"><i class="fas fa-home"></i> Beranda</a>
        <a href="{{ route('member.buku') }}" class="nav-item"><i class="fas fa-book-open"></i> Daftar Buku</a>
        <a href="{{ route('member.rak') }}" class="nav-item"><i class="fas fa-bookmark"></i> Rak Buku</a>
        <div class="nav-section-label">Akun</div>
        <a href="{{ route('member.profil') }}" class="nav-item active"><i class="fas fa-user-circle"></i> Profil</a>
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
        <span class="topbar-title"><i class="fas fa-user-circle" style="color:var(--accent);margin-right:0.5rem;"></i>Profil Saya</span>
    </header>

    <main class="content">

        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        {{-- HERO --}}
        <div class="profil-hero">
            <div class="profil-avatar">
                {{ strtoupper(substr($member->nama ?? $user->email, 0, 1)) }}
            </div>
            <div class="profil-hero-info">
                <h2>{{ $member->nama ?? 'Belum diisi' }}</h2>
                <p>{{ $user->email }}</p>
                <p style="margin-top:0.25rem; font-size:0.75rem; color:rgba(255,255,255,0.35);">
                    Bergabung sejak {{ \Carbon\Carbon::parse($user->tanggal_daftar)->format('d M Y') }}
                </p>
            </div>
            <div class="profil-hero-badge">
                <i class="fas fa-user"></i> Member
            </div>
        </div>

        {{-- FORM --}}
        <div class="form-card">
            <div class="form-card-title">
                <i class="fas fa-pen"></i> Edit Informasi Profil
            </div>

            <form method="POST" action="{{ route('member.profil.update') }}">
                @csrf

                <div class="form-divider">Informasi Akun</div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-input" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-input" value="Member" disabled>
                    </div>
                </div>

                <div class="form-divider">Informasi Pribadi</div>

                <div class="form-grid">
                    <div class="form-group full">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="nama" class="form-input" value="{{ old('nama', $member->nama ?? '') }}" placeholder="Masukkan nama lengkap" required>
                        @error('nama') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="nohp" class="form-input" value="{{ old('nohp', $member->nohp ?? '') }}" placeholder="08xxxxxxxxxx">
                        @error('nohp') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Agama</label>
                        <select name="agama" class="form-select">
                            <option value="">-- Pilih --</option>
                            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                                <option value="{{ $ag }}" {{ old('agama', $member->agama ?? '') == $ag ? 'selected' : '' }}>{{ $ag }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-input" value="{{ old('tempat_lahir', $member->tempat_lahir ?? '') }}" placeholder="Kota lahir">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-input" value="{{ old('tanggal_lahir', $member->tanggal_lahir ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin', $member->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $member->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-simpan">
                    <i class="fas fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </form>
        </div>

    </main>

    <footer class="content-footer">
        <span>© {{ date('Y') }} <strong>Readify</strong>. All Rights Reserved</span>
        <span>Login: <strong>{{ Auth::user()->email }}</strong></span>
    </footer>
</div>

</body>
</html>