@extends('admin.layout')
@section('title', 'Danh sách bài viết')
@section('content')
<article>
    <div class="overlay-menu"></div>
    <section class="manager py-3">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h5 class="mb-0 fw-bold text-dark">Danh sách bài viết</h5>
                <a href="{{ route('admin.them-bai-viet') }}" class="btn btn-primary shadow-sm px-4">
                    <i class="fas fa-plus-circle me-1"></i> THÊM MỚI
                </a>
            </div>

            <form method="GET" action="{{ route('admin.danh-sach-bai-viet') }}" class="d-flex flex-wrap gap-2 mb-3">
                <select name="category" class="form-control" style="max-width: 280px;">
                    <option value="">-- Tất cả danh mục --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary">Lọc</button>
                @if(request()->filled('category'))
                    <a href="{{ route('admin.danh-sach-bai-viet') }}" class="btn btn-outline-secondary">Xóa lọc</a>
                @endif
            </form>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th style="width: 100px;">Ảnh</th>
                                    <th>Tiêu đề bài viết</th>
                                    <th>Danh mục</th>
                                    <th class="text-center">Nổi bật</th>
                                    <th class="text-center">Lượt xem</th>
                                    <th class="text-center">Ngày đăng</th>
                                    <th class="text-end px-4" style="width: 150px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>#{{ $post->id }}</td>
                                    <td>
                                        <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://via.placeholder.com/80x60' }}"
                                             alt="thumb" class="rounded border" style="width: 70px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $post->title }}</div>
                                        <small class="text-muted">{{ Str::limit($post->summary, 50) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-outline-primary border text-primary px-3">
                                            {{ $post->categories ?? 'Không xác định' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($post->is_featured)
                                            <span class="text-warning"><i class="fas fa-star"></i></span>
                                        @else
                                            <span class="text-muted"><i class="far fa-star"></i></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">{{ number_format($post->views) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <small>{{ $post->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td class="text-end px-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm action-btn btn-edit" title="Sửa">
                                                Sửa
                                            </a>
                                            <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm action-btn btn-delete" title="Xóa">
                                                    Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($posts->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">Không có bài viết nào.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
</article>

<style>
    /* Tùy chỉnh bảng */
    .table thead th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 15px 10px;
    }
    .table tbody td {
        padding: 12px 10px;
        vertical-align: middle;
    }
    .bg-outline-primary {
        background-color: #eaf2ff !important;
        border: 1px solid #0d6efd !important;
        color: #0b5ed7 !important;
        font-weight: 700;
        font-size: 0.78rem;
        letter-spacing: 0.2px;
    }
    .btn-sm {
        min-width: 60px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-weight: 600;
    }

    /* Hiệu ứng hover dòng */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.02);
        cursor: default;
    }

    /* Ngăn chặn đè lớp và tràn chữ */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: normal;
        line-height: 1.4;
    }

    .text-truncate-1 {
        display: block;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table td, .table th {
        white-space: nowrap; /* Giữ các ô gọn gàng */
    }

    /* Riêng cột tiêu đề cho phép xuống dòng nếu cần nhưng giới hạn 2 dòng */
    .table td:nth-child(3) {
        white-space: normal;
    }

    .action-btn {
        min-width: 60px !important;
        height: 35px !important;
        padding: 0 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .btn-edit {
        background-color: #e8f3ff;
        border: 1px solid #0d6efd;
        color: #000000;
    }

    .btn-edit:hover {
        background-color: #0d6efd;
        color: #ffffff;
    }

    .btn-delete {
        background-color: #ffeef0;
        border: 1px solid #dc3545;
        color: #000000;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: #ffffff;
    }

    /* Đảm bảo form không chiếm diện tích dư thừa */
    .table td .d-flex form {
        display: flex;
        margin: 0;
    }

    @media (max-width: 768px) {
        .btn-top .btn { flex: 1 1 auto; font-size: 0.8rem; }
    }
</style>

@endsection
