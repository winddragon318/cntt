@extends('Layouts.app')
@section('title', 'Trang chủ - Khoa CNTT FIT IUH')
@section('content')
<div class="container content-body">
    <div class="fit-grid-wrapper">

        <div class="fit-slider-box">
            <div id="mainCarousel" class="carousel slide shadow-sm" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/slide1.jpg') }}" alt="Slider 1">
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-box mb-4">
    <h5 class="sidebar-title fw-bold border-bottom pb-2 text-danger">TIN NỔI BẬT</h5>
    <ul class="list-unstyled mt-3 sidebar-list">
        @foreach($featured as $item)
            <li>
                <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none text-dark small">
                    <i class="fas fa-caret-right me-2"></i>
                    {{ $item->title }}

                    {{-- Tự động hiển thị badge NEW nếu bài đăng trong vòng 3 ngày gần đây --}}
                    @if($item->created_at->diffInDays(now()) < 3)
                        <span class="badge bg-danger ms-1">NEW</span>
                    @endif
                </a>
            </li>
        @endforeach

        {{-- Hiển thị nếu không có bài viết nào được đánh dấu nổi bật --}}
        @if($featured->isEmpty())
            <li class="text-muted small ps-2">Chưa có tin nổi bật mới nhất.</li>
        @endif
    </ul>
</div>

       <div class="fit-card">
    <h3 class="text-fit-blue">Tin tức - Sự kiện</h3>
    <div class="news-list">
        @foreach($news as $item)
        <article class="news-item">
            <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('assets/images/anh1.jpg') }}" alt="news">

            <a href="{{ url('news/' . $item->slug) }}">
                {{ Str::limit($item->title, 70, '...') }}

                @if($item->created_at->diffInDays(now()) < 3)
                    <span class="badge badge-new">NEW</span>
                @endif
            </a>
        </article>
        @endforeach
    </div>
</div>

        <div class="fit-card">
    <h3 class="text-fit-blue">Thông báo sinh viên</h3>
    <div class="news-list">
        @foreach($notifications as $item)
        <article class="news-item">
            <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('assets/images/default-notification.jpg') }}" alt="notification">

            <a href="{{ route('news.show', $item->slug) }}">
                {{ \Illuminate\Support\Str::limit($item->title, 70, '...') }}

                @if($item->created_at->diffInDays(now()) < 3)
                    <span class="badge badge-new">NEW</span>
                @endif
            </a>
        </article>
        @endforeach

        {{-- Hiển thị thông báo nếu chưa có dữ liệu --}}
        @if($notifications->isEmpty())
            <p class="text-muted small p-3">Chưa có thông báo mới.</p>
        @endif
    </div>
</div>

        <div class="fit-card text-center">
            <h3 class="text-fit-red">Trung tâm tin học</h3>
            <div class="ratio-box shadow-sm">
                <img src="{{ asset('assets/images/anh1.jpg') }}" alt="Banner TTTH">
            </div>
        </div>

        <div class="fit-card">
    <h3 class="text-fit-blue">Thông tin tuyển sinh</h3>
    <div class="ratio-box mb-3 shadow-sm">
        <img src="{{ asset('assets/images/thongtintuyensinh.png') }}" alt="Tuyển sinh FIT">
    </div>
    <ul class="list-unstyled list-links">
        @foreach($admissions as $item)
            <li>
                <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none text-dark">
                    › {{ $item->title }}
                </a>
            </li>
        @endforeach

        {{-- Hiển thị thông báo nếu trống dữ liệu --}}
        @if($admissions->isEmpty())
            <li class="text-muted small">› Đang cập nhật thông tin tuyển sinh...</li>
        @endif
    </ul>
</div>

        <div class="fit-card">
    <h3 class="text-fit-blue">Thực tập - Tuyển dụng</h3>
    <div class="ratio-box mb-3 shadow-sm">
        <img src="{{ asset('assets/images/thuctaptuyendung.png') }}" alt="Thực tập">
    </div>
    <ul class="list-unstyled list-links">
        @foreach($careers as $item)
            <li>
                <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none text-dark">
                    › {{ $item->title }}

                    {{-- Hiển thị badge NEW nếu bài mới đăng trong 3 ngày --}}
                    @if($item->created_at->diffInDays(now()) < 3)
                        <span class="badge badge-new">NEW</span>
                    @endif
                </a>
            </li>
        @endforeach

        @if($careers->isEmpty())
            <li class="text-muted small">› Đang cập nhật thông tin tuyển dụng...</li>
        @endif
    </ul>
</div>

        <div class="fit-card">
            <h3 class="text-fit-red">Video giới thiệu</h3>
            <div class="ratio ratio-16x9 shadow-sm">
                <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY" title="YouTube video Khoa CNTT" allowfullscreen></iframe>
            </div>
            <p class="small mt-2 text-muted">Giới thiệu Khoa CNTT - FIT IUH</p>
        </div>

    </div>
</div>
@endsection
