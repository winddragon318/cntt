</head>
<body>
<div class="top-bar p-2">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <div class="d-none d-md-block">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Flag_of_Vietnam.svg" width="25" alt="VN" class="me-1">
            <img src="{{ asset('assets/images/england.png') }}" width="25" alt="EN">
        </div>
    </div>
</div>

<header class="main-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                <img src="{{ asset('assets/images/hht.png') }}" alt="Logo HHT" height="60" class="me-3">
                <div class="logo-text">
                    <h3>CAO ĐẲNG CÔNG NGHỆ CAO HÀ NỘI</h3>
                    <p>KHOA CÔNG NGHỆ THÔNG TIN</p>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm ...">
                    <button class="btn btn-search" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<nav class="container navbar navbar-expand-lg navbar-dark bg-custom-red navbar-custom p-0">
    <div class="container p-0 p-lg-1">
        <button class="navbar-toggler ms-auto me-2 my-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenuIUH" aria-controls="mainMenuIUH" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainMenuIUH">
            <ul class="navbar-nav w-100 justify-content-start">
                <li class="nav-item">
                    <a class="nav-link active fw-bold" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Giới thiệu
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('about.khoa') }}">Giới thiệu về khoa</a></li>
                        <li><a class="dropdown-item" href="{{ route('organization.structure') }}">Cơ cấu tổ chức</a></li>
                        <li><a class="dropdown-item" href="{{ route('faculty.members') }}">Đội ngũ giảng viên</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Đào tạo
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('dao-tao') }}">Thông tin tuyển sinh</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tin-tuc') }}">Tin tức - Sự kiện</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Hoạt động
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Đoàn thanh niên</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Sinh viên
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('thong-bao') }}">Thông báo sinh viên</a></li>
                        <li><a class="dropdown-item" href="#">Hướng dẫn biểu mẫu</a></li>
                        <li><a class="dropdown-item" href="{{ route('tuyen-dung') }}">Thực tập việc làm</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
