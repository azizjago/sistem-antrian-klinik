<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Antrian Klinik Kampus')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --clinic-blue: #2563eb;
            --clinic-blue-dark: #1e40af;
            --clinic-mint: #14b8a6;
            --clinic-light: #eff6ff;
            --clinic-gray: #f5f7fb;
            --clinic-line: #dfe7f1;
            --clinic-text: #1f2937;
            --clinic-muted: #64748b;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.08), transparent 30%),
                linear-gradient(180deg, #ffffff 0, var(--clinic-gray) 280px);
            color: var(--clinic-text);
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            font-size: 15px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.94);
            border-bottom: 1px solid var(--clinic-line);
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
        }

        .navbar-brand {
            color: var(--clinic-blue-dark) !important;
            letter-spacing: 0;
        }

        .navbar-brand i {
            color: var(--clinic-mint);
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.92);
            border-right: 1px solid var(--clinic-line);
            min-height: calc(100vh - 57px);
            box-shadow: 12px 0 30px rgba(15, 23, 42, 0.03);
        }

        .sidebar .nav-link {
            color: var(--clinic-muted);
            border-radius: 8px;
            margin-bottom: 6px;
            padding: 11px 12px;
            font-weight: 600;
            transition: background-color .18s ease, color .18s ease, box-shadow .18s ease;
        }

        .sidebar .nav-link i {
            width: 22px;
            color: #94a3b8;
            transition: color .18s ease;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: var(--clinic-light);
            color: var(--clinic-blue-dark);
            box-shadow: inset 3px 0 0 var(--clinic-blue);
        }

        .sidebar .nav-link.active i,
        .sidebar .nav-link:hover i {
            color: var(--clinic-blue);
        }

        .page-card,
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--clinic-line);
            border-radius: 8px;
            box-shadow: 0 14px 32px rgba(15, 23, 42, 0.06);
        }

        .stat-card {
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.08);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--clinic-light), #ecfdf5);
            color: var(--clinic-blue);
            flex: 0 0 44px;
        }

        .badge-status {
            border-radius: 6px;
            padding: 7px 10px;
            text-transform: capitalize;
            font-weight: 700;
            letter-spacing: 0;
        }

        .main-content {
            padding: 28px;
        }

        .main-content h1 {
            color: #0f172a;
            font-weight: 750;
        }

        .text-muted {
            color: var(--clinic-muted) !important;
        }

        .btn {
            border-radius: 8px;
            font-weight: 650;
            padding: .55rem .9rem;
        }

        .btn-sm {
            padding: .38rem .68rem;
        }

        .btn-primary {
            background: var(--clinic-blue);
            border-color: var(--clinic-blue);
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.18);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: var(--clinic-blue-dark);
            border-color: var(--clinic-blue-dark);
        }

        .btn-outline-primary {
            color: var(--clinic-blue);
            border-color: #b7c9f8;
            background: #ffffff;
        }

        .btn-light {
            background: #f8fafc;
            border-color: var(--clinic-line);
            color: #475569;
        }

        .form-label {
            color: #334155;
            font-size: .88rem;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            border-color: #cfd9e6;
            border-radius: 8px;
            min-height: 42px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--clinic-blue);
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .12);
        }

        .table {
            color: #334155;
        }

        .table > :not(caption) > * > * {
            padding: .9rem .85rem;
            border-bottom-color: #edf2f7;
        }

        .table thead th {
            background: #f8fafc;
            color: #475569;
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .02em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table tbody tr:hover {
            background: #f8fbff;
        }

        .dataTables_wrapper .form-control,
        .dataTables_wrapper .form-select {
            min-height: 38px;
        }

        .modal-content {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.18);
        }

        .modal-header {
            border-bottom-color: var(--clinic-line);
            background: #f8fafc;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                min-height: auto;
                border-right: 0;
                border-bottom: 1px solid var(--clinic-line);
            }

            .sidebar .nav {
                flex-direction: row !important;
                overflow-x: auto;
                padding-bottom: 2px;
            }

            .sidebar .nav-link {
                white-space: nowrap;
            }

            .main-content {
                padding: 16px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand fw-semibold text-primary" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-hospital-user me-2"></i>Klinik Kampus
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNav">
            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="small text-muted">{{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <aside class="col-lg-2 sidebar p-3">
            <nav class="nav flex-lg-column gap-1">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-chart-line me-2"></i>Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('antrian.*') ? 'active' : '' }}" href="{{ route('antrian.index') }}">
                    <i class="fa-solid fa-ticket me-2"></i>Antrian
                </a>
                <a class="nav-link {{ request()->routeIs('pemanggilan.*') ? 'active' : '' }}" href="{{ route('pemanggilan.index') }}">
                    <i class="fa-solid fa-bullhorn me-2"></i>Pemanggilan
                </a>
                <a class="nav-link {{ request()->routeIs('riwayat.*') ? 'active' : '' }}" href="{{ route('riwayat.index') }}">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i>Riwayat
                </a>
            </nav>
        </aside>
        <main class="col-lg-10 main-content">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 class="h4 mb-1">@yield('page_title')</h1>
                    <p class="text-muted mb-0">@yield('page_subtitle')</p>
                </div>
                @yield('page_action')
            </div>
            @yield('content')
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    document.querySelectorAll('.data-table').forEach((table) => {
        new DataTable(table, {
            responsive: true,
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                zeroRecords: 'Data tidak ditemukan',
                emptyTable: 'Belum ada data',
            },
        });
    });

    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil', text: @json(session('success')), timer: 1800, showConfirmButton: false });
    @endif

    @if(session('warning'))
        Swal.fire({ icon: 'warning', title: 'Perhatian', text: @json(session('warning')) });
    @endif

    document.querySelectorAll('[data-confirm]').forEach((form) => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi',
                text: this.dataset.confirm,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#0d6efd',
            }).then((result) => {
                if (result.isConfirmed) this.submit();
            });
        });
    });
</script>
@stack('scripts')
</body>
</html>
