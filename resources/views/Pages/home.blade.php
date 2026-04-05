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

        <div class="fit-card">
            <h3 class="text-fit-red">Tin nổi bật</h3>
            <ul class="list-unstyled list-links">
                <li><a href="#" class="text-dark">Lịch thi HK2/2025-2026 từ ngày 06/04/2026 <span class="badge badge-new">NEW</span></a></li>
                <li><a href="#" class="text-dark">Lịch thi HK2/2025-2026 từ ngày 30/03/2026</a></li>
                <li><a href="#" class="text-dark">Thông báo kế hoạch định hướng tách ngành...</a></li>
            </ul>
        </div>

        <div class="fit-card">
            <h3 class="text-fit-blue">Tin tức - Sự kiện</h3>
            <div class="news-list">
                <article class="news-item">
                    <img src="{{ asset('assets/images/anh1.jpg') }}" alt="news">
                    <a href="#">Khoa Công nghệ thông tin thăm và làm việc với 04 Trường Ấn Độ... <span class="badge badge-new">NEW</span></a>
                </article>
                <article class="news-item">
                    <img src="{{ asset('assets/images/anh1.jpg') }}" alt="news">
                    <a href="#">[RECAP] SEMINAR: ỨNG DỤNG AI TRONG LẬP TRÌNH...</a>
                </article>
            </div>
        </div>

        <div class="fit-card">
            <h3 class="text-fit-blue">Thông báo sinh viên</h3>
            <div class="news-list">
                <article class="news-item">
                    <img src="{{ asset('assets/images/anh1.jpg') }}" alt="notification">
                    <a href="#">Lịch thi HK2/2025-2026 từ ngày 06/04/2026 <span class="badge badge-new">NEW</span></a>
                </article>
                <article class="news-item">
                    <img src="{{ asset('assets/images/anh1.jpg') }}" alt="notification">
                    <a href="#">[Kết nối DN]: Tham quan kiến tập tại FPT Software...</a>
                </article>
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
                <img src="{{ asset('assets/images/anh1.jpg') }}" alt="Tuyển sinh FIT">
            </div>
            <ul class="list-unstyled list-links">
                <li>› Thông báo tuyển sinh đại học - đợt 1 năm 2026</li>
                <li>› Thông báo tuyển sinh thạc sĩ năm 2026</li>
            </ul>
        </div>

        <div class="fit-card">
            <h3 class="text-fit-blue">Thực tập - Tuyển dụng</h3>
            <div class="ratio-box mb-3 shadow-sm">
                <img src="{{ asset('assets/images/anh1.jpg') }}" alt="Thực tập">
            </div>
            <ul class="list-unstyled list-links">
                <li>› [FPT SOFTWARE NHA TRANG]: Tuyển FRESHER... <span class="badge badge-new">NEW</span></li>
                <li>› [Team Solutions] Tuyển dụng Thực tập sinh .NET</li>
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
