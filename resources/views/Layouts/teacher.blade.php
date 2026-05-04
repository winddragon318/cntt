<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - HHT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        #wrapper { display: flex; width: 100%; align-items: stretch; }
        /* Sidebar */
        #sidebar { min-width: 250px; max-width: 250px; background: #2c3e50; color: #fff; min-height: 100vh; transition: all 0.3s; }
        #sidebar .sidebar-header { padding: 20px; background: #1a252f; text-align: center; }
        #sidebar ul li a { padding: 15px 20px; display: block; color: #adb5bd; text-decoration: none; border-bottom: 1px solid #34495e; }
        #sidebar ul li a:hover { background: #34495e; color: #fff; }
        #sidebar ul li a i { margin-right: 10px; }
        /* Content */
        #content { width: 100%; }
        .navbar { padding: 15px 10px; background: #fff; border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0">HHT STUDENT</h4>
        </div>
        <ul class="list-unstyled">
            <li><a href="#"><i class="mdi mdi-view-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="{{ route('profile.edit') }}"><i class="mdi mdi-account-cog"></i> Hồ sơ cá nhân</a></li>
            <li><a href="#"><i class="mdi mdi-book-open-variant"></i> Kết quả học tập</a></li>
            <li><a href="#"><i class="mdi mdi-calendar-check"></i> Lịch học</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">@csrf</form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger">
                    <i class="mdi mdi-logout"></i> Đăng xuất
                </a>
            </li>
        </ul>
    </nav>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button type="button" class="btn btn-light"><i class="mdi mdi-menu"></i></button>
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3 fw-bold">{{ Auth::user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="rounded-circle" width="40">
                </div>
            </div>
        </nav>
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
