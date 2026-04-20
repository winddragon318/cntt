@extends('layouts.app')
@section('title', 'Giới thiệu về Khoa - Khoa CNTT FIT IUH')
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

                    <p class="lead fw-normal">
                        Khoa Công nghệ thông tin (CNTT) được hình thành từ năm 1996. Trải qua chặng đường dài không ngừng nỗ lực hoàn thiện và phát triển, Khoa CNTT đang từng bước khẳng định uy tín của mình với phương châm
                        <strong class="text-primary">"Đào tạo sinh viên vững lý thuyết, giỏi thực hành và làm chủ công nghệ mới"</strong>.
                    </p>

                    <div class="my-4 p-3 bg-light border-start border-4 border-primary">
                        <p class="mb-2"><strong>Tầm nhìn:</strong> <em class="text-secondary">Trở thành đơn vị uy tín hàng đầu về đào tạo và nghiên cứu về máy tính và công nghệ thông tin, hội nhập với khu vực và thế giới.</em></p>
                        <p class="mb-0"><strong>Sứ mệnh:</strong> <em class="text-secondary">Cung cấp cho xã hội nguồn nhân lực có trình độ chuyên môn và kỹ năng trong lĩnh vực máy tính và công nghệ thông tin đáp ứng được yêu cầu cho sự phát triển kinh tế - xã hội...</em></p>
                    </div>

                    <h3 class="h4 fw-bold mt-4 mb-3 text-uppercase border-start border-primary border-4 ps-2">Chức năng - Nhiệm vụ</h3>
                    <p>Khoa CNTT là đơn vị trực thuộc trường, có các chức năng và nhiệm vụ sau:</p>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i>Tổ chức đào tạo ngành máy tính và công nghệ thông tin các bậc từ đại học đến Sau đại học.</li>
                        <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i>Tổ chức đào tạo chứng chỉ tin học cho toàn trường.</li>
                        <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i>Thực hiện nhiệm vụ nghiên cứu khoa học và chuyển giao công nghệ.</li>
                        <li class="list-group-item border-0 ps-0"><i class="fas fa-check-circle text-success me-2"></i>Thực hiện quan hệ, hợp tác với các đơn vị trong và ngoài nước.</li>
                    </ul>

                    <h3 class="h4 fw-bold mt-4 mb-3 text-uppercase border-start border-primary border-4 ps-2">Đội ngũ</h3>
                    <p>Tính đến tháng 3/2024, khoa CNTT có <strong>63 viên chức</strong>, bao gồm 57 giảng viên và 6 nhân viên. Phần lớn đội ngũ giảng viên được đào tạo và trải nghiệm ở các trường đại học có uy tín trong và ngoài nước, hiện tại trong khoa có 3 Phó giáo sư-Tiến sĩ, 29 Tiến sĩ.</p>

                    <figure class="figure w-100 my-4">
                        <img src="{{ asset('assets/images/hht1-900x506.jpg') }}" class="figure-img img-fluid rounded shadow w-100" alt="Lễ khai giảng năm học 2022-2023">
                        <figcaption class="figure-caption text-center fw-italic mt-2">Lễ khai giảng năm học 2022-2023</figcaption>
                    </figure>

                    <h3 class="h4 fw-bold mt-4 mb-3 text-uppercase border-start border-primary border-4 ps-2">Thành tựu nổi bật</h3>
                    <p>
                        <strong>Về đào tạo:</strong> Khoa CNTT hiện đang bậc Tiến sĩ và Thạc sĩ ngành Khoa học máy tính; đào tạo bậc đại học 05 ngành, gồm Khoa học máy tính, Công nghệ thông tin, Hệ thống thông tin, Khoa học dữ liệu và Kỹ thuật phần mềm.
                    </p>

                    <div class="alert alert-info">
                        Hiện nay Khoa có 02 CTĐT đạt chuẩn kiểm định <strong>ABET</strong> và 01 CTĐT đạt chuẩn <strong>AUN-QA</strong>.
                    </div>

                    <p>
                        <strong>Về Nghiên cứu khoa học – Hợp tác quốc tế:</strong> Hàng năm, đội ngũ giảng viên của Khoa tham gia nghiên cứu khoa học và công bố kết quả trên nhiều tạp chí chuyên ngành uy tín quốc tế danh mục SCI(E). Khoa cũng ký kết hợp tác với nhiều trường đại học lớn như Đại học Chicago (Hoa Kỳ), Đại học Quốc gia Chonnam (Hàn Quốc)...
                    </p>
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
