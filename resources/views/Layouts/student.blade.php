<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - HHT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        #wrapper { display: flex; width: 100%; align-items: stretch; }
        #sidebar { min-width: 250px; max-width: 250px; background: #2c3e50; color: #fff; min-height: 100vh; transition: all 0.3s; }
        #sidebar.active { margin-left: -250px; }
        #sidebar .sidebar-header { padding: 20px; background: #1a252f; text-align: center; }
        #sidebar ul li a { padding: 15px 20px; display: block; color: #adb5bd; text-decoration: none; border-bottom: 1px solid #34495e; }
        #sidebar ul li a:hover { background: #34495e; color: #fff; }
        #sidebar ul li a i { margin-right: 10px; }
        #content { width: 100%; min-width: 0; }
        .navbar { padding: 15px 10px; background: #fff; border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        #sidebarOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1020;
        }

        /* PC */
        @media (min-width: 1025px) {
            #content .container-fluid.p-4 {
                padding: 1.25rem !important;
            }
        }

        /* iPad */
        @media (min-width: 768px) and (max-width: 1024px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1030;
                margin-left: -250px;
            }
            #sidebar.mobile-open {
                margin-left: 0;
            }
            #sidebarOverlay.show {
                display: block;
            }
            #content .container-fluid.p-4 {
                padding: 1rem !important;
            }
        }

        /* Mobile */
        @media (max-width: 767px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1030;
                margin-left: -250px;
            }
            #sidebar.mobile-open {
                margin-left: 0;
            }
            #sidebarOverlay.show {
                display: block;
            }
            .navbar {
                padding: 10px 8px;
            }
            #content .container-fluid.p-4 {
                padding: 0.8rem !important;
            }
        }
    </style>
</head>
<body>
<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0">HHT STUDENT</h4>
        </div>
        <ul class="list-unstyled">
            <li><a href="{{ route('student.dashboard') }}"><i class="mdi mdi-view-dashboard"></i>DashBoard</a></li>
            <li><a href="/"><i class="mdi mdi-newspaper"></i>Tin tức</a></li>
            <li><a href="{{ route('profile.edit') }}"><i class="mdi mdi-account-cog"></i> Hồ sơ cá nhân</a></li>
            <li><a href="{{ route('student.learning-results') }}"><i class="mdi mdi-book-open-variant"></i> Kết quả học tập</a></li>
            <li><a href="{{ route('student.timetable') }}"><i class="mdi mdi-calendar-check"></i> Lịch học</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">@csrf</form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger">
                    <i class="mdi mdi-logout"></i> Đăng xuất
                </a>
            </li>
        </ul>
    </nav>
    <div id="sidebarOverlay"></div>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button type="button" id="sidebarToggle" class="btn btn-light"><i class="mdi mdi-menu"></i></button>
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
<script>
    (function () {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');
        const mobileWidth = 1024;

        function closeMobileSidebar() {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        }

        toggleBtn.addEventListener('click', function () {
            if (window.innerWidth <= mobileWidth) {
                const opening = !sidebar.classList.contains('mobile-open');
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('show', opening);
                return;
            }

            sidebar.classList.toggle('active');
        });

        overlay.addEventListener('click', closeMobileSidebar);

        window.addEventListener('resize', function () {
            if (window.innerWidth > mobileWidth) {
                closeMobileSidebar();
            } else {
                sidebar.classList.remove('active');
            }
        });
    })();
</script>
</body>
</html>
