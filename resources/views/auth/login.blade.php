<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Antrian Klinik Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f4f6f8;
            display: flex;
            align-items: center;
        }

        .login-card {
            border: 1px solid #e5edf5;
            border-radius: 8px;
            box-shadow: 0 12px 32px rgba(37, 48, 68, 0.06);
        }

        .brand-icon {
            width: 54px;
            height: 54px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eaf4ff;
            color: #0d6efd;
            font-size: 24px;
        }
    </style>
</head>
<body>
<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card login-card">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <span class="brand-icon mb-3"><i class="fa-solid fa-hospital-user"></i></span>
                        <h1 class="h4 mb-1">Sistem Antrian Klinik Kampus</h1>
                        <p class="text-muted mb-0">Masuk menggunakan akun admin atau petugas.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.process') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" id="password" type="password" name="password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Login
                        </button>
                    </form>

                    <div class="small text-muted mt-4">
                        Admin: admin@klinik.test / password<br>
                        Petugas: petugas@klinik.test / password
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
