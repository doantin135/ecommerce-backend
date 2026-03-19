<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ShopNow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #1a1a2e;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar .brand {
            padding: 24px 20px;
            color: #fff;
            font-size: 22px;
            font-weight: 800;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.6);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #e94560;
        }

        .main-content {
            margin-left: 240px;
            padding: 30px;
        }

        .stat-card {
            border-radius: 16px;
            border: none;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .topbar {
            background: #fff;
            padding: 16px 30px;
            margin-left: 240px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 100;
        }
    </style>
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="brand">🛍 ShopNow</div>
        <nav class="mt-2">
            <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="/admin/products" class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Sản phẩm
            </a>
            <a href="/admin/categories" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Danh mục
            </a>

            <a href="/admin/orders" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="bi bi-bag-check"></i> Đơn hàng
            </a>
        </nav>
    </div>

    {{-- Topbar --}}
    <div class="topbar d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-700">@yield('title', 'Dashboard')</h5>
        <span class="text-muted">Admin</span>
    </div>

    {{-- Content --}}
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
