<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT. Wastu Cipta Nagara</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #FAFAFA;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #FFF;
            border: 1px solid #ECECEC;
            border-radius: 0;
            padding: 4rem 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.02);
        }
        .login-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: 0.08em;
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .login-brand span {
            color: #C9A86A;
        }
        .form-control {
            border-radius: 0;
            border: 1px solid #ECECEC;
            padding: 0.8rem 1rem;
            font-size: 0.9rem;
            background-color: #FAFAFA;
            transition: all 0.3s;
        }
        .form-control:focus {
            background-color: #FFF;
            border-color: #C9A86A;
            box-shadow: none;
            outline: none;
        }
    </style>
</head>
<body>

    <div class="login-card" data-aos="fade-up">
        <div class="login-brand text-center">
            <a href="{{ route('home') }}" class="text-decoration-none text-dark d-flex flex-column align-items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Wacana Logo" style="height: 70px;" class="mb-2">
                <span class="fw-bold tracking-widest font-head" style="font-size: 1.5rem;">WACANA</span>
            </a>
        </div>
        
        <h5 class="font-head text-center mb-4 text-uppercase fw-bold text-secondary" style="font-size: 0.9rem; letter-spacing: 0.1em;">Portal Akses</h5>

        @if($errors->any())
            <div class="alert alert-danger border-0 rounded-0 small p-2 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="form-label font-head text-uppercase text-secondary fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">Alamat Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label font-head text-uppercase text-secondary fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">Kata Sandi</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input rounded-0" id="remember">
                    <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                </div>
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3 mb-3">
                LOG IN <i class="bi bi-arrow-right-short ms-1"></i>
            </button>
            
            <a href="{{ route('home') }}" class="d-block text-center small text-muted hover-gold">
                <i class="bi bi-chevron-left small me-1"></i> Kembali ke Beranda
            </a>
        </form>
    </div>

</body>
</html>
