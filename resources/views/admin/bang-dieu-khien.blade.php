    @extends('admin.layout')
    @section('title', 'Bảng điều khiển')
    @section('content')
    <article>
        <div class="overlay-menu"></div>
        <section class="dashboard">
          <div class="container">
            <div class="row">
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="box-dashboard"><a href="{{ route('admin.bang-dieu-khien') }}"><img src="{{ asset('admin_assets/img/view-page.png') }}"/>
                    <h4>Xem trang</h4></a></div>
              </div>
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="box-dashboard"><a href="{{ route('admin.cau-hinh-tong-quat') }}"><img src="{{ asset('admin_assets/img/settings.png') }}"/>
                    <h4>Cấu hình tổng quát</h4></a></div>
              </div>
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="box-dashboard"><a href="{{ route('admin.danh-sach-san-pham') }}"><img src="{{ asset('admin_assets/img/product.png') }}"/>
                    <h4>Danh sách sản phẩm</h4></a></div>
              </div>
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="box-dashboard"><a href="danh-sach-bai-viet.html"><img src="{{ asset('admin_assets/img/post.png') }}"/>
                    <h4>Danh sách bài viết</h4></a></div>
              </div>
            </div>
          </div>
        </section>
      </article>
    @endsection
