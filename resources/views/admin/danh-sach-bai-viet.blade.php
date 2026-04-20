@extends('admin.layout')
@section('title', 'Danh sách bài viết')
@section('content')
<article>
    <div class="overlay-menu"></div>
    <section class="manager py-3">
        <div class="container-fluid">
            <div class="btn-top text-center mb-4">
                <a href="{{ route('admin.them-bai-viet') }}" class="btn btn-primary shadow-sm px-4">
                    <i class="fas fa-plus-circle me-1"></i> THÊM MỚI
                </a>
                <button class="btn btn-success" id="active-all" disabled>Hiển thị toàn bộ</button>
                <button class="btn btn-warning text-white" id="private-all" disabled>Ẩn toàn bộ</button>
                <button class="btn btn-info text-white" id="go-trash">Dọn rác</button>
            </div>

            <div class="filter-category mb-3" style="max-width: 300px;">
                <select name="categories" class="form-control @error('categories') is-invalid @enderror" required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach(['Tin tức', 'Thông báo', 'Tuyển sinh', 'Sự kiện','tuyen-dung'] as $cat)
                        <option value="{{ $cat }}" {{ old('categories') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                    @error('categories')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center" style="width: 50px;">
                                        <input type="checkbox" id="checkAll">
                                    </th>
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
                                    <td class="text-center">
                                        <input type="checkbox" class="post-checkbox" value="{{ $post->id }}">
                                    </td>
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
                                            {{ $post->category->name ?? 'Không xác định' }}
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
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-outline-info" title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{-- $posts->links() --}}
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
        background-color: transparent;
        border: 1px solid #0d6efd;
    }
    .btn-sm {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }

    /* Hiệu ứng hover dòng */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.02);
        cursor: default;
    }

    /* Checkbox tùy chỉnh */
    input[type="checkbox"] {
        cursor: pointer;
        width: 16px;
        height: 16px;
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
    .table td:nth-child(4) {
        white-space: normal;
    }

    .action-btn {
        width: 35px !important;
        height: 35px !important;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    /* Đảm bảo form không chiếm diện tích dư thừa */
    form { display: inline-block; }

    @media (max-width: 768px) {
        .btn-top .btn { flex: 1 1 auto; font-size: 0.8rem; }
    }
</style>

<script>
    // Xử lý chọn tất cả checkbox
    document.getElementById('checkAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.post-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        toggleTopButtons();
    });

    // Theo dõi thay đổi của các checkbox con
    document.querySelectorAll('.post-checkbox').forEach(cb => {
        cb.addEventListener('change', toggleTopButtons);
    });

    function toggleTopButtons() {
        const anyChecked = document.querySelectorAll('.post-checkbox:checked').length > 0;
        document.getElementById('active-all').disabled = !anyChecked;
        document.getElementById('private-all').disabled = !anyChecked;
        document.getElementById('delete-all').disabled = !anyChecked;
    }

    function filterCategory() {
        // Logics lọc theo danh mục (Sẽ gửi request AJAX hoặc reload trang kèm query)
        const catId = document.getElementById('categoryFilter').value;
        window.location.href = "{{ route('admin.danh-sach-bai-viet') }}?category_id=" + catId;
    }
</script>
@endsection
