<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>ADMINCP</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/mdb.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/jquery.fancybox.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/materialdesignicons.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/sweetalert2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/datepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/layout.css') }}"/>
    <link rel="shortcut icon" href="{{ asset('admin_assets/img/favicon.png') }}"/>
  </head>
  <body>
    <aside>
      <div class="menu-close"><i class="mdi mdi-close d-block d-xl-none"></i></div>
      <div class="logo"><a href="{{ route('admin.bang-dieu-khien') }}"><img class="logo-large" src="{{ asset('assets/images/hht.png') }}"/></a><img class="logo-mini" src="{{ asset('admin_assets/img/logo-mini.png') }}"/></div>
      <div class="menu">
        <nav class="sidebar" id="sidebar">
          <ul class="nav">
            <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#manager" aria-expanded="false" aria-controls="ui-basic"><i class="mdi mdi-view-dashboard-outline menu-icon"></i><span class="menu-title">Quản lý website</span></a><i class="mdi mdi-chevron-down menu-down" data-toggle="collapse" href="#manager" aria-expanded="false" aria-controls="ui-basic"></i>
              <div class="collapse show" id="manager">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.bang-dieu-khien') }}">Bảng điều khiển</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.cau-hinh-tong-quat') }}">Cấu hình tổng quát</a></li>
                </ul>
              </div>
            </li>
             <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="ui-basic"><i class="mdi mdi-account-circle-outline menu-icon"></i><span class="menu-title">Quản lý tài khoản</span></a><i class="mdi mdi-chevron-down menu-down" data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="ui-basic"></i>
              <div class="collapse show" id="account">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.danh-sach-tai-khoan') }}">Danh sách tài khoản</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.them-tai-khoan') }}">Thêm tài khoản</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#product-manager" aria-expanded="false" aria-controls="ui-basic"><i class="mdi mdi-shopify menu-icon"></i><span class="menu-title">Quản lý bài viết</span></a><i class="mdi mdi-chevron-down menu-down" data-toggle="collapse" href="#product-manager" aria-expanded="false" aria-controls="ui-basic"></i>
              <div class="collapse show" id="product-manager">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.danh-sach-bai-viet') }}">Danh sách bài viết</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.them-bai-viet') }}">Thêm bài viết</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <main>
      <header>
        <div class="container-fluid">
          <div class="menu-btn"><i class="mdi mdi-menu">              </i></div>
          <div class="username">Admin Dashboard</div>
          <div class="custom">
            <ul>
                <li class="noti bell"><a href="quan-ly-lien-he.html" title="Xem thông báo"><i class="mdi mdi-bell-outline"></i></a></li>
                <li><a href="#"><i class="mdi mdi-eye-outline"></i><span>Xem trang</span></a></li>
                <li>
                    <a href="{{ route('profile.edit') }}">
                        <i class="mdi mdi-key-change"></i>
                            <span>Đổi mật khẩu</span>
                        </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">@csrf</form>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout"></i>
                            <span>Đăng xuất</span>
                        </a>
                </li>
            </ul>
          </div>
        </div>
      </header>
      // Nội dung chính sẽ được chèn vào đây
      <article>
        <div class="overlay-menu"></div>
        @yield('content')
      </article>
      <script src="{{ asset('admin_assets/js/jquery-3.3.1.min.js') }}"></script>
      <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('admin_assets/js/mdb.min.js') }}"></script>
      <script src="{{ asset('admin_assets/js/jquery.fancybox.min.js') }}"></script>
      <script src="{{ asset('admin_assets/js/sweetalert2.min.js') }}"></script>
      <script src="{{ asset('admin_assets/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('admin_assets/js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/decoupled-document/ckeditor.js"></script>
      <script src="{{ asset('admin_assets/js/data.js') }}"></script>
      <script src="{{ asset('admin_assets/js/datepicker.min.js') }}"></script>
      <script src="{{ asset('admin_assets/js/layout.js') }}"></script>
      @stack('scripts')
    </main>
  </body>
</html>
