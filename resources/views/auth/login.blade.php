<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — Readify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --deep-forest:  #071A14;
            --lime-accent:  #84CC16;
            --neon-lime:    #BEF264;
            --glass-bg:     rgba(13, 61, 38, 0.5);
            --glass-border: rgba(132, 204, 22, 0.2);
            --grad-lime:    linear-gradient(135deg, #84CC16, #BEF264);
            --r-md: 14px; --r-xl: 28px; --r-pill: 999px;
            --transition: all 0.3s ease;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        body {
            min-height: 100vh; background: var(--deep-forest);
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow-x: hidden; padding: 2rem 0;
        }
        body::before {
            content: ''; position: fixed; inset: 0;
            background-image: radial-gradient(circle, rgba(132,204,22,0.1) 1px, transparent 1px);
            background-size: 28px 28px; pointer-events: none; z-index: 0;
        }
        .blob { position: fixed; border-radius: 50%; pointer-events: none; z-index: 0; }
        .blob-1 { top:-15%; right:-10%; width:600px; height:600px; background: radial-gradient(circle, rgba(22,163,74,0.2) 0%, transparent 70%); }
        .blob-2 { bottom:-15%; left:-10%; width:500px; height:500px; background: radial-gradient(circle, rgba(132,204,22,0.12) 0%, transparent 70%); }
        .auth-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 420px; margin: auto;
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            border-radius: var(--r-xl); padding: 2rem;
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.5), inset 0 1px 0 rgba(132,204,22,0.1);
            animation: slideUp 0.5s ease;
        }
        @keyframes slideUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
        .auth-logo { text-align:center; margin-bottom:1.25rem; }
        .auth-logo a { font-size:1.5rem; font-weight:800; background:var(--grad-lime); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; text-decoration:none; letter-spacing:-0.02em; }
        .auth-logo p { color:rgba(255,255,255,0.35); font-size:0.8rem; margin-top:0.2rem; }
        .logo-divider { width:40px; height:2px; background:var(--grad-lime); border-radius:2px; margin:0.75rem auto 0; opacity:0.5; }
        .auth-title { font-size:1.3rem; font-weight:800; color:#fff; margin-bottom:0.35rem; }
        .auth-subtitle { color:rgba(255,255,255,0.4); font-size:0.82rem; margin-bottom:1.5rem; }
        .alert { display:flex; align-items:flex-start; gap:0.6rem; border-radius:var(--r-md); padding:0.9rem 1rem; margin-bottom:1.25rem; font-size:0.88rem; }
        .alert-error { background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.3); color:#FCA5A5; }
        .alert-success { background:rgba(22,163,74,0.12); border:1px solid rgba(22,163,74,0.3); color:#86EFAC; }
        .form-group { margin-bottom:1rem; }
        .form-label { display:flex; align-items:center; gap:0.4rem; font-size:0.8rem; font-weight:600; color:rgba(255,255,255,0.65); margin-bottom:0.5rem; }
        .form-label i { font-size:0.75rem; color:var(--lime-accent); }
        .input-wrap { position:relative; }
        .input-prefix { position:absolute; left:0; top:0; bottom:0; width:46px; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.25); font-size:0.88rem; border-right:1px solid rgba(255,255,255,0.06); pointer-events:none; z-index:1; transition:var(--transition); }
        .form-input { width:100%; padding:0.75rem 1rem 0.75rem 2.75rem; background:rgba(255,255,255,0.05); border:1.5px solid rgba(255,255,255,0.08); border-radius:var(--r-md); color:#fff; font-size:0.88rem; font-family:inherit; outline:none; transition:var(--transition); }
        .form-input::placeholder { color:rgba(255,255,255,0.2); }
        .form-input:focus { border-color:rgba(132,204,22,0.5); background:rgba(132,204,22,0.05); box-shadow:0 0 0 3px rgba(132,204,22,0.08); }
        .input-wrap:focus-within .input-prefix { color:var(--lime-accent); }
        .form-input.has-toggle { padding-right:3rem; }
        .form-input.is-invalid { border-color:rgba(239,68,68,0.4); background:rgba(239,68,68,0.04); }
        .toggle-password { position:absolute; right:1rem; top:50%; transform:translateY(-50%); background:none; border:none; color:rgba(255,255,255,0.25); cursor:pointer; font-size:0.88rem; transition:color 0.3s; }
        .toggle-password:hover { color:var(--lime-accent); }
        .field-error { display:flex; align-items:center; gap:0.35rem; color:#FCA5A5; font-size:0.78rem; margin-top:0.4rem; }
        .form-footer { display:flex; align-items:center; justify-content:space-between; margin-bottom:0.5rem; }
        .checkbox-wrap { display:flex; align-items:center; gap:0.5rem; cursor:pointer; font-size:0.82rem; color:rgba(255,255,255,0.4); }
        .checkbox-wrap input[type="checkbox"] { accent-color:var(--lime-accent); width:15px; height:15px; cursor:pointer; }
        .forgot-link { font-size:0.82rem; color:var(--lime-accent); text-decoration:none; transition:color 0.3s; }
        .forgot-link:hover { color:var(--neon-lime); }
        .btn-submit { width:100%; padding:0.85rem; background:var(--grad-lime); color:#071A14; border:none; border-radius:var(--r-pill); font-size:0.95rem; font-weight:700; font-family:inherit; cursor:pointer; transition:var(--transition); box-shadow:0 4px 20px rgba(132,204,22,0.35); display:flex; align-items:center; justify-content:center; gap:0.5rem; margin-top:1.25rem; }
        .btn-submit:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(132,204,22,0.5); }
        .btn-submit.loading { opacity:0.8; cursor:not-allowed; pointer-events:none; }
        .btn-submit .spinner { display:none; width:18px; height:18px; border:2px solid rgba(7,26,20,0.3); border-top-color:#071A14; border-radius:50%; animation:spin 0.7s linear infinite; }
        @keyframes spin { to{transform:rotate(360deg)} }
        .btn-submit.loading .spinner { display:block; }
        .btn-submit.loading .btn-text { display:none; }
        .divider { display:flex; align-items:center; gap:1rem; margin:1.5rem 0; }
        .divider::before,.divider::after { content:''; flex:1; height:1px; background:rgba(255,255,255,0.07); }
        .divider span { font-size:0.78rem; color:rgba(255,255,255,0.2); }
        .auth-switch { text-align:center; font-size:0.85rem; color:rgba(255,255,255,0.35); }
        .auth-switch a { color:var(--lime-accent); text-decoration:none; font-weight:600; }
        .auth-switch a:hover { color:var(--neon-lime); }
        .back-home { display:flex; align-items:center; justify-content:center; gap:0.4rem; margin-top:1.25rem; font-size:0.82rem; color:rgba(255,255,255,0.2); text-decoration:none; transition:color 0.3s; }
        .back-home:hover { color:rgba(255,255,255,0.5); }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="auth-card">

        <div class="auth-logo">
            <a href="{{ route('home') }}">Readify</a>
            <div class="logo-divider"></div>
            <p>Perpustakaan Digital Modern</p>
        </div>

        <h1 class="auth-title">Selamat Datang Kembali</h1>
        <p class="auth-subtitle">Masuk ke akun Readify Anda</p>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->has('email') && !old('email'))
            {{-- error umum login --}}
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">
                    <i class="fas fa-circle"></i> Email
                </label>
                <div class="input-wrap">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input @error('email') is-invalid @enderror"
                        placeholder="contoh@email.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                    >
                    <div class="input-prefix"><i class="fas fa-envelope"></i></div>
                </div>
                @error('email')
                    <p class="field-error">
                        <i class="fas fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">
                    <i class="fas fa-circle"></i> Password
                </label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input has-toggle @error('password') is-invalid @enderror"
                        placeholder="Password Anda"
                        autocomplete="current-password"
                        required
                    >
                    <div class="input-prefix"><i class="fas fa-lock"></i></div>
                    <button type="button" class="toggle-password" onclick="togglePassword('password','eyeIcon')" tabindex="-1">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password')
                    <p class="field-error">
                        <i class="fas fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Remember me --}}
            <div class="form-footer">
                <label class="checkbox-wrap">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Ingat saya
                </label>
                {{-- Uncomment jika ada forgot password --}}
                {{-- <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a> --}}
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                <div class="spinner"></div>
                <span class="btn-text">
                    <i class="fas fa-right-to-bracket"></i> Masuk
                </span>
            </button>
        </form>

        <div class="divider"><span>atau</span></div>

        <div class="auth-switch">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>

        <a href="{{ route('home') }}" class="back-home">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>

    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const input  = document.getElementById(fieldId);
            const icon   = document.getElementById(iconId);
            const hidden = input.type === 'password';
            input.type = hidden ? 'text' : 'password';
            icon.classList.toggle('fa-eye',      !hidden);
            icon.classList.toggle('fa-eye-slash', hidden);
        }

        document.getElementById('loginForm').addEventListener('submit', function () {
            document.getElementById('submitBtn').classList.add('loading');
        });

        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                el.style.transition = 'opacity 0.5s ease';
                el.style.opacity    = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
