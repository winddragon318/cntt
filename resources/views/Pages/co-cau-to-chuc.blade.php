@extends('layouts.app')
@section('title', 'Cơ cấu tổ chức - Khoa CNTT FIT IUH')
@section('content')
<div class="container news-page content-body py-4">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin tức - Sự kiện</li>
            </ol>
        </nav>
        <div class="social-share d-none d-md-block">
            <small class="text-muted me-2">CHIA SẺ</small>
            <a href="#" class="text-secondary me-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-secondary me-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-secondary me-2"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="banner-theme p-4 text-white d-flex align-items-center justify-content-between shadow-sm" style="background: linear-gradient(90deg, #1a237e 0%, #0d47a1 100%); border-radius: 8px;">
                <div class="theme-text">
                    <h5 class="mb-1 italic" style="font-family: 'Times New Roman', serif;">Chủ đề năm học:</h5>
                    <h4 class="fw-bold mb-0">NÂNG CAO CHẤT LƯỢNG ĐÀO TẠO & DỊCH VỤ</h4>
                    <p class="mb-0 small">ĐÁP ỨNG YÊU CẦU HOẠT ĐỘNG CỦA NHÀ TRƯỜNG THEO CƠ CHẾ TỰ CHỦ</p>
                </div>
                <div class="d-none d-sm-block">
                    <img src="{{ asset('assets/images/mortarboard.png') }}" alt="icon" class="img-fluid rounded-circle" style="width: 100px;">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 pe-lg-4">
           <article class="bg-white p-4 p-md-5 shadow-sm rounded">
                <header class="mb-4 border-bottom pb-3">
                    <h1 class="fw-bold text-primary-emphasis" style="color: #003366 !important;">
                        Khoa Công nghệ Thông tin
                    </h1>
                    <div class="text-muted d-flex align-items-center gap-2">
                        <i class="far fa-calendar-alt"></i>
                        <span>14-06-2021</span>
                    </div>
                </header>

                <div class="article-content lh-lg" style="text-align: justify;">
                 <div class="p-3">
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Cơ cấu tổ chức Khoa Công nghệ Thông tin</h3>
        <p class="text-muted small">07-02-2018</p>
    </div>

    <div class="mb-5">
        <p class="fw-bold text-uppercase mb-3">A. BAN CHỦ NHIỆM KHOA</p>

        <div class="mb-3">
            <div>1. <strong>TS. Lê Nhật Duy - Trưởng khoa</strong></div>
            <div class="ms-3">Email: lenhatduy@iuh.edu.vn</div>
            <div class="ms-3">ĐT: 083.8940390-233. Địa chỉ : Văn phòng khoa CNTT (H1)</div>
        </div>

        <div class="mb-3">
            <div>2. <strong>PGS. TS. Huỳnh Tường Nguyên - Phó trưởng khoa</strong></div>
            <div class="ms-3">Email: huynhtuongnguyen@iuh.edu.vn</div>
            <div class="ms-3">ĐT: 083.8940390-233. Địa chỉ : Văn phòng khoa CNTT (H1)</div>
        </div>

        <div class="mb-3">
            <div>3. <strong>TS. Đặng Thị Phúc - Phó Trưởng khoa</strong></div>
            <div class="ms-3">Email: phucdt@iuh.edu.vn</div>
            <div class="ms-3">ĐT: 083.8940390-233. Địa chỉ : Văn phòng khoa CNTT (H1)</div>
        </div>
    </div>

    <div>
        <p class="fw-bold text-uppercase mb-3">B. GIÁO VỤ</p>

        <div class="mb-3">
            <div>1. <strong>Phạm Thị Thùy Trang</strong></div>
            <div class="ms-3">Điện thoại : 083.8940390-233</div>
            <div class="ms-3">Địa chỉ : Văn phòng khoa CNTT (H1)</div>
        </div>

        <div class="mb-3">
            <div>2. <strong>Nguyễn Ngọc Phượng</strong></div>
            <div class="ms-3">Điện thoại : 083.8940390-233</div>
            <div class="ms-3">Địa chỉ : Văn phòng khoa CNTT (H1)</div>
        </div>
    </div>
</div>
                </div>
            </article>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <aside class="sidebar">

                <div class="sidebar-box mb-4">
                    <h5 class="sidebar-title fw-bold border-bottom pb-2 text-danger">TIN NỔI BẬT</h5>
                    <ul class="list-unstyled mt-3 sidebar-list">
                        <li><a href="#" class="text-decoration-none"><i class="fas fa-caret-right me-2"></i>Lịch thi HK2/2025-2026 từ ngày 13/4/2026 <span class="badge bg-danger ms-1">NEW</span></a></li>
                        <li><a href="#" class="text-decoration-none"><i class="fas fa-caret-right me-2"></i>Thông báo mở lớp học kỳ hè (Hk3/2025-2026)</a></li>
                        <li><a href="#" class="text-decoration-none"><i class="fas fa-caret-right me-2"></i>Thông báo nhận bằng tốt nghiệp đợt xét tháng 3/2026</a></li>
                    </ul>
                </div>

                <div class="banner-sidebar mb-4 shadow-sm rounded overflow-hidden">
                    <div class="p-3 text-center bg-primary text-white">
                        <h6 class="mb-0 fw-bold">TRUNG TÂM TIN HỌC</h6>
                        <h4 class="mb-0 fw-bold mt-2">TIN HỌC</h4>
                    </div>
                </div>

                <div class="sidebar-box mb-4">
                    <h5 class="sidebar-title fw-bold border-bottom pb-2 text-primary">THÔNG BÁO SINH VIÊN</h5>
                    <ul class="list-unstyled mt-3 sidebar-list">
                        <li><a href="#" class="text-decoration-none"><i class="fas fa-caret-right me-2"></i>Lịch thi HK2/2025-2026 chi tiết từng phòng</a></li>
                        <li><a href="#" class="text-decoration-none"><i class="fas fa-caret-right me-2"></i>[Alumni Talk Series]: HANDS-ON WITH AMAZON S3</a></li>
                    </ul>
                </div>

                <div class="sidebar-box mb-4 p-3 bg-light border-start border-4 border-primary">
                    <h5 class="sidebar-title fw-bold text-primary mb-3">THÔNG TIN TUYỂN SINH</h5>
                    <ul class="list-unstyled sidebar-list small">
                        <li class="mb-2"><a href="#" class="text-dark">• Thông báo tuyển sinh đào tạo liên thông từ Cao đẳng lên Đại học</a></li>
                        <li class="mb-2"><a href="#" class="text-dark">• Thông báo tuyển sinh Thạc sĩ năm 2026 - Đợt 1</a></li>
                    </ul>
                </div>

            </aside>
        </div>
    </div>
</div>

<style>
    /* CSS tinh chỉnh Layout */
    .news-page { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .post-title { font-size: 1.8rem; line-height: 1.3; }
    .italic { font-style: italic; }

    /* Sidebar styling */
    .sidebar-title { font-size: 1.1rem; letter-spacing: 0.5px; }
    .sidebar-list li { padding: 8px 0; border-bottom: 1px dashed #eee; transition: 0.3s; }
    .sidebar-list li:hover { padding-left: 5px; }
    .sidebar-list a { color: #333; display: block; font-size: 0.95rem; }
    .sidebar-list a:hover { color: #007bff; }

    /* Image responsive */
    .figure img { width: 100%; object-fit: cover; }

    /* Banner theme */
    .banner-theme h4 { font-size: 1.5rem; }

    @media (max-width: 991.98px) {
        .post-title { font-size: 1.5rem; }
        .pe-lg-4 { padding-right: 15px !important; }
    }
    /* Custom style để bài viết trông chuyên nghiệp hơn */
    .article-content p {
        margin-bottom: 1.5rem;
    }
    .fw-italic {
        font-style: italic;
    }
    .text-primary-emphasis {
        color: #003366 !important;
    }
</style>
@endsection
