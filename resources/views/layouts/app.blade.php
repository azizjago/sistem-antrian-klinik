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
            --clinic-blue: #3d8bfd;
            --clinic-light: #eaf4ff;
            --clinic-gray: #f4f6f8;
            --clinic-text: #253044;
        }

        body {
            background: var(--clinic-gray);
            color: var(--clinic-text);
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5edf5;
        }

        .sidebar {
            background: #ffffff;
            border-right: 1px solid #e5edf5;
            min-height: calc(100vh - 57px);
        }

        .sidebar .nav-link {
            color: #556274;
            border-radius: 8px;
            margin-bottom: 4px;
            padding: 10px 12px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: var(--clinic-light);
            color: #0d6efd;
        }

        .page-card,
        .stat-card {
            background: #ffffff;
            border: 1px solid #e5edf5;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(37, 48, 68, 0.04);
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--clinic-light);
            color: var(--clinic-blue);
        }

        .badge-status {
            border-radius: 6px;
            padding: 6px 10px;
            text-transform: capitalize;
        }

        .main-content {
            padding: 24px;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                min-height: auto;
                border-right: 0;
                border-bottom: 1px solid #e5edf5;
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
                @if(auth()->user()->isAdmin())
                    <a class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">
                        <i class="fa-solid fa-briefcase-medical me-2"></i>Layanan
                    </a>
                @endif
                <a class="nav-link {{ request()->routeIs('antrian.create') ? 'active' : '' }}" href="{{ route('antrian.create') }}">
                    <i class="fa-solid fa-ticket me-2"></i>Ambil Antrian
                </a>
                <a class="nav-link {{ request()->routeIs('antrian.index') ? 'active' : '' }}" href="{{ route('antrian.index') }}">
                    <i class="fa-solid fa-list-check me-2"></i>Data Antrian
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
