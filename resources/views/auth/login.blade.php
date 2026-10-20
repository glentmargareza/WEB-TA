<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk | Jeep Wisata Wukirsari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: linear-gradient(135deg, #12281E 0%, #1c4533 50%, #295B44 100%);
            position: relative;
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .auth-container::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 40%),
                              radial-gradient(circle at 80% 80%, rgba(38, 166, 91, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        .auth-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            position: relative;
            z-index: 2;
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 24px;
        }

        .auth-brand img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .auth-brand h1 {
            font-size: 22px;
            font-weight: 700;
            color: #183B2B;
            margin: 0 0 6px 0;
        }

        .auth-brand p {
            font-size: 13px;
            color: #64748B;
            margin: 0;
        }

        .auth-alert {
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .auth-alert--danger {
            background: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }

        .auth-alert--info {
            background: #F0FDF4;
            color: #166534;
            border: 1px solid #BBF7D0;
        }

        .auth-field {
            margin-bottom: 16px;
        }

        .auth-field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .auth-field input {
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
            font-family: inherit;
        }

        .auth-field input:focus {
            border-color: #26533D;
            box-shadow: 0 0 0 3px rgba(38, 83, 61, 0.12);
        }

        .auth-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #64748B;
            margin-bottom: 22px;
        }

        .auth-btn-submit {
            width: 100%;
            padding: 13px;
            background: #183B2B;
            color: #ffffff;
            font-weight: 600;
            font-size: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        .auth-btn-submit:hover {
            background: #23543d;
        }

        .auth-btn-submit:active {
            transform: scale(0.99);
        }

        /* Demo credentials card */
        .demo-box {
            margin-top: 24px;
            padding: 14px;
            background: #F8FAFC;
            border: 1px dashed #CBD5E1;
            border-radius: 12px;
            font-size: 12px;
        }

        .demo-box h4 {
            margin: 0 0 8px 0;
            font-size: 12px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .demo-pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .demo-pill {
            flex: 1;
            min-width: 140px;
            padding: 8px 10px;
            background: #ffffff;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            cursor: pointer;
            text-align: left;
            transition: all 0.2s;
        }

        .demo-pill:hover {
            border-color: #26533D;
            background: #F0FDF4;
        }

        .demo-pill strong {
            display: block;
            font-size: 12px;
            color: #1E293B;
        }

        .demo-pill span {
            font-size: 11px;
            color: #64748B;
        }

        .auth-back {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }

        .auth-back a {
            color: #183B2B;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-back a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-brand">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Jeep Wisata Wukirsari">
                </a>
                <h1>Masuk ke Akun</h1>
                <p>Silakan login sesuai dengan peran Anda (Admin / Pengguna)</p>
            </div>

            @if(session('info'))
                <div class="auth-alert auth-alert--info">
                    <x-icon name="circle-check" :size="16" />
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @if(session('warning'))
                <div class="auth-alert auth-alert--danger">
                    <x-icon name="alert" :size="16" />
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="auth-alert auth-alert--danger">
                    <x-icon name="alert" :size="16" />
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="auth-field">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="contoh: admin@jeepwukirsari.com">
                </div>

                <div class="auth-field">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi Anda">
                </div>

                <div class="auth-options">
                    <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Ingat saya</span>
                    </label>
                    <a href="https://wa.me/081228677834?text=Halo%20Admin,%20saya%20lupa%20kata%20sandi%20akun%20saya" target="_blank" style="color: #26533D; text-decoration: none; font-size: 12px;">Lupa sandi?</a>
                </div>

                <button type="submit" class="auth-btn-submit">
                    Masuk Sekarang
                </button>
            </form>

            <div class="demo-box">
                <h4>⚡ Akun Siap Pakai (Klik untuk Isi):</h4>
                <div class="demo-pills">
                    <button type="button" class="demo-pill" onclick="fillAuth('admin@jeepwukirsari.com', 'admin123')">
                        <strong>👑 Role: Admin</strong>
                        <span>admin@jeepwukirsari.com</span>
                    </button>
                    <button type="button" class="demo-pill" onclick="fillAuth('user@example.com', 'user123')">
                        <strong>👤 Role: User Publik</strong>
                        <span>user@example.com</span>
                    </button>
                </div>
            </div>

            <div class="auth-back">
                <a href="{{ route('home') }}">← Kembali ke Beranda Utama</a>
            </div>
        </div>
    </div>

    <script>
        function fillAuth(email, pass) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = pass;
        }
    </script>
</body>
</html>
