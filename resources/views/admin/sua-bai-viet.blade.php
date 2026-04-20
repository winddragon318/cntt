@extends('admin.layout')
@section('title', 'Chỉnh sửa bài viết')
@section('content')
<article class="w-100">
    <div class="overlay-menu"></div>
    <section class="add-item py-3">
        <div class="container-fluid">
            <div class="title-page mb-4">
                <h1 class="h3 fw-bold text-primary">Chỉnh sửa bài viết: <span class="text-dark">{{ $post->title }}</span></h1>
            </div>

            {{-- Lưu ý: action trỏ đến route update và sử dụng method POST kèm @method('POST') hoặc PUT --}}
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Nếu trong Route bạn dùng Route::put thì dùng @method('PUT'), nếu dùng Route::post thì để nguyên --}}

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">

                                <div class="mb-4">
                                    <label class="fw-bold mb-2 text-dark">Tiêu đề bài viết</label>
                                    <input class="form-control form-control-lg" name="title" id="titleSite" type="text"
                                           value="{{ $post->title }}" onkeyup="ChangeToSlug();" required />
                                </div>

                                <div class="mb-4">
                                    <label class="fw-bold mb-2 text-muted">Slug (Đường dẫn)</label>
                                    <input class="form-control bg-light" name="slug" id="slugSite" type="text"
                                           value="{{ $post->slug }}" readonly tabindex="-1" />
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="fw-bold mb-2">Danh mục bài viết</label>
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

                                    <div class="col-md-6 mb-4 d-flex align-items-end">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured"
                                                   value="1" {{ $post->is_featured ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold ms-2" for="is_featured" style="cursor: pointer;">Đặt làm tin nổi bật</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="fw-bold mb-2">Tóm tắt ngắn gọn</label>
                                    <textarea name="summary" class="form-control" rows="3">{{ $post->summary }}</textarea>
                                </div>

                                <div class="mb-4 border rounded p-3 bg-light">
                                    <label class="fw-bold mb-3 d-block">Ảnh đại diện bài viết</label>
                                    <div class="d-flex flex-wrap align-items-start gap-4">
                                        <div class="text-center">
                                            {{-- Hiển thị ảnh cũ nếu có, nếu không hiện placeholder --}}
                                            <img id="previewImage"
                                                 src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                                                 class="img-thumbnail shadow-sm" style="width: 250px; height: 160px; object-fit: cover; border-radius: 10px;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <button type="button" class="btn btn-outline-primary mb-2" onclick="document.getElementById('imageInput').click()">
                                                <i class="fas fa-sync me-2"></i> Thay đổi ảnh đại diện
                                            </button>
                                            <input type="file" name="thumbnail" id="imageInput" accept="image/*" hidden>
                                            <p class="small text-muted mb-0">Nếu không chọn ảnh mới, ảnh cũ sẽ được giữ nguyên.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label class="fw-bold mb-2">Nội dung bài viết</label>
                                    <div id="toolbar-container" class="border-bottom-0"></div>
                                    {{-- Đổ dữ liệu content vào div editor --}}
                                    <div id="editor" class="bg-white" style="min-height: 500px; border: 1px solid #ced4da;">
                                        {!! $post->content !!}
                                    </div>
                                    <input type="hidden" name="content" id="content_editor" value="{{ $post->content }}">
                                </div>

                                <div class="d-flex flex-wrap gap-3 mt-5">
                                    <button type="submit" class="btn btn-success px-5 py-3 fw-bold shadow">
                                        <i class="fas fa-check-circle me-2"></i> CẬP NHẬT BÀI VIẾT
                                    </button>
                                    <a class="btn btn-outline-secondary px-5 py-3" href="{{ route('admin.danh-sach-bai-viet') }}">
                                        Hủy bỏ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</article>

<style>
    .add-item .card { border-radius: 15px; }
    .form-control { border: 1px solid #ced4da !important; position: relative; }
    #editor { border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; padding: 15px; }
    @media (max-width: 768px) {
        #previewImage { width: 100% !important; }
        .btn-success, .btn-outline-secondary { width: 100%; }
    }
</style>

<script>
    // Preview ảnh khi chọn file mới
    document.getElementById("imageInput").addEventListener("change", function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById("previewImage").src = URL.createObjectURL(file);
        }
    });

    // Tự động tạo Slug khi sửa tiêu đề
    function ChangeToSlug() {
        var title = document.getElementById("titleSite").value;
        var slug = title.toLowerCase();
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\s+/g, '-');
        slug = slug.replace(/[^\w\-]+/g, '');
        document.getElementById('slugSite').value = slug;
    }

    // Đảm bảo dữ liệu từ Editor được cập nhật vào input hidden trước khi submit
    document.querySelector('form').addEventListener('submit', function() {
        // Lệnh này tùy thuộc vào trình soạn thảo bạn đang dùng (CKEditor, TinyMCE, v.v.)
        // Ví dụ với div contenteditable:
        document.querySelector('#content_editor').value = document.querySelector('#editor').innerHTML;
    });
</script>
@endsection
