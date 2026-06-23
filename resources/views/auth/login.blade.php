<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Antrian Klinik Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --clinic-blue: #2563eb;
            --clinic-blue-dark: #1e40af;
            --clinic-mint: #14b8a6;
            --clinic-line: #dfe7f1;
            --clinic-muted: #64748b;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 18% 18%, rgba(20, 184, 166, .12), transparent 28%),
                radial-gradient(circle at 82% 10%, rgba(37, 99, 235, .12), transparent 30%),
                linear-gradient(180deg, #ffffff 0, #f5f7fb 100%);
            display: flex;
            align-items: center;
            color: #1f2937;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
        }

        .login-card {
            border: 1px solid var(--clinic-line);
            border-radius: 8px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.11);
            overflow: hidden;
        }

        .brand-icon {
            width: 58px;
            height: 58px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #eff6ff, #ecfdf5);
            color: var(--clinic-blue);
            font-size: 24px;
        }

        .form-label {
            color: #334155;
            font-size: .88rem;
            font-weight: 700;
        }

        .form-control {
            border-color: #cfd9e6;
            border-radius: 8px;
            min-height: 44px;
        }

        .form-control:focus {
            border-color: var(--clinic-blue);
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .12);
        }

        .btn {
            border-radius: 8px;
            font-weight: 700;
            min-height: 44px;
        }

        .btn-primary {
            background: var(--clinic-blue);
            border-color: var(--clinic-blue);
            box-shadow: 0 10px 22px rgba(37, 99, 235, .18);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: var(--clinic-blue-dark);
            border-color: var(--clinic-blue-dark);
        }

        .text-muted {
            color: var(--clinic-muted) !important;
        }

        .alert {
            border-radius: 8px;
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
