<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Readify</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: radial-gradient(ellipse at top left, #1a4a1a 0%, #0d2b0d 40%, #050f05 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }

        .card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 520px;
            backdrop-filter: blur(10px);
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }
        .brand h1 {
            color: #a3e635;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .brand p {
            color: #6b7280;
            font-size: 0.85rem;
            margin-top: 4px;
        }

        h2 {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .subtitle {
            color: #6b7280;
            font-size: 0.85rem;
            margin-bottom: 24px;
        }

        /* Alert messages */
        .alert-success {
            background: rgba(163,230,53,0.1);
            border: 1px solid #a3e635;
            color: #a3e635;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }
        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }

        .form-group {
            margin-bottom: 18px;
        }
        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #d1d5db;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-label .dot {
            width: 10px; height: 10px;
            background: #a3e635;
            border-radius: 50%;
        }

        .input-wrap {
            position: relative;
        }
        .input-wrap .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: rgba(255,255,255,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .input-wrap .icon svg {
            width: 16px;
            height: 16px;
            stroke: rgba(255,255,255,0.4);
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }
        .input-wrap input,
        .input-wrap select {
            width: 100%;
            padding: 13px 14px 13px 42px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: #e5e7eb;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .input-wrap select option {
            background: #1a2e1a;
        }
        .input-wrap input::placeholder { color: #4b5563; }
        .input-wrap input:focus,
        .input-wrap select:focus {
            border-color: #a3e635;
        }
        .input-wrap .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
        }
        .input-wrap .toggle-pw svg {
            width: 16px;
            height: 16px;
            stroke: rgba(255,255,255,0.4);
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: stroke 0.2s;
        }
        .input-wrap .toggle-pw:hover svg { stroke: rgba(255,255,255,0.8); }

        /* No icon inputs */
        .input-wrap.no-icon input,
        .input-wrap.no-icon select {
            padding-left: 14px;
        }

        .field-error {
            color: #f87171;
            font-size: 0.78rem;
            margin-top: 5px;
        }

        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .btn-register {
            width: 100%;
            padding: 15px;
            background: #a3e635;
            color: #0d1f00;
            font-size: 1rem;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-register:hover { background: #bef264; transform: scale(1.01); }
        .btn-register:active { transform: scale(0.99); }

        .login-link {
            text-align: center;
            margin-top: 18px;
            color: #6b7280;
            font-size: 0.85rem;
        }
        .login-link a {
            color: #a3e635;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="brand">
        <h1>Readify</h1>
        <p>Perpustakaan Digital Modern</p>
    </div>

    <h2>Buat Akun Baru</h2>
    <p class="subtitle">Bergabung dengan Readify dan mulai perjalanan membacamu</p>

    {{-- Alert sukses / error --}}
    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">✗ {{ session('error') }}</div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        {{-- Nama Lengkap --}}
        <div class="form-group">
            <label class="form-label"><span class="dot"></span> Nama Lengkap</label>
            <div class="input-wrap">
                <span class="icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></span>
                <input type="text" name="nama" placeholder="Nama lengkap Anda"
                       value="{{ old('nama') }}">
            </div>
            @error('nama') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label class="form-label"><span class="dot"></span> Email</label>
            <div class="input-wrap">
                <span class="icon"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 7 10-7"/></svg></span>
                <input type="email" name="email" placeholder="contoh@email.com"
                       value="{{ old('email') }}">
            </div>
            @error('email') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label class="form-label"><span class="dot"></span> Password</label>
            <div class="input-wrap">
                <span class="icon"><svg viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg></span>
                <input type="password" name="password" id="password" placeholder="Minimal 8 karakter">
                <button type="button" class="toggle-pw" id="toggle-pw1" onclick="togglePw('password','toggle-pw1')">
                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
            @error('password') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div class="form-group">
            <label class="form-label"><span class="dot"></span> Konfirmasi Password</label>
            <div class="input-wrap">
                <span class="icon"><svg viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/><path d="M12 16v-1"/></svg></span>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password Anda">
                <button type="button" class="toggle-pw" id="toggle-pw2" onclick="togglePw('password_confirmation','toggle-pw2')">
                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
        </div>

        {{-- Nomor HP --}}
        <div class="form-group">
            <label class="form-label"><span class="dot"></span> Nomor HP</label>
            <div class="input-wrap">
                <span class="icon"><svg viewBox="0 0 24 24"><rect x="7" y="2" width="10" height="20" rx="2"/><circle cx="12" cy="18" r="1" fill="rgba(255,255,255,0.4)" stroke="none"/></svg></span>
                <input type="text" name="nohp" placeholder="08xxxxxxxxxx"
                       value="{{ old('nohp') }}">
            </div>
            @error('nohp') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        {{-- Tempat & Tanggal Lahir --}}
        <div class="row-2">
            <div class="form-group">
                <label class="form-label"><span class="dot"></span> Tempat Lahir</label>
                <div class="input-wrap">
                    <span class="icon"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg></span>
                    <input type="text" name="tempat_lahir" placeholder="Kota lahir"
                           value="{{ old('tempat_lahir') }}">
                </div>
                @error('tempat_lahir') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label class="form-label"><span class="dot"></span> Tanggal Lahir</label>
                <div class="input-wrap no-icon">
                    <input type="date" name="tanggal_lahir"
                           value="{{ old('tanggal_lahir') }}" style="padding-left:14px;">
                </div>
                @error('tanggal_lahir') <p class="field-error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Jenis Kelamin & Agama --}}
        <div class="row-2">
            <div class="form-group">
                <label class="form-label"><span class="dot"></span> Jenis Kelamin</label>
                <div class="input-wrap no-icon">
                    <select name="jenis_kelamin">
                        <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                @error('jenis_kelamin') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label class="form-label"><span class="dot"></span> Agama</label>
                <div class="input-wrap no-icon">
                    <select name="agama">
                        <option value="" disabled {{ old('agama') ? '' : 'selected' }}>Pilih</option>
                        @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                            <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                </div>
                @error('agama') <p class="field-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <button type="submit" class="btn-register">Daftar Sekarang</button>
    </form>

    <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
</div>

<script>
    const eyeOpen  = `<svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:rgba(255,255,255,0.4);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
    const eyeOff   = `<svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:rgba(255,255,255,0.4);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;

    function togglePw(id, btnId) {
        const input = document.getElementById(id);
        const btn   = document.getElementById(btnId);
        if (input.type === 'password') {
            input.type = 'text';
            btn.innerHTML = eyeOff;
        } else {
            input.type = 'password';
            btn.innerHTML = eyeOpen;
        }
    }
</script>

</body>
</html>