@extends('layouts.student')

@section('student_content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 fw-bold text-dark">Hồ sơ cá nhân</h2>

            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white fw-bold">Thông tin cá nhân</div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                        @if (session('status') === 'profile-updated')
                            <span class="text-success ms-2 small">Đã cập nhật!</span>
                        @endif
                    </form>
                </div>
            </div>
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white fw-bold">Đổi mật khẩu</div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" class="form-control">
                            @error('current_password', 'updatePassword') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" name="password" class="form-control">
                            @error('password', 'updatePassword') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-danger">Cập nhật mật khẩu</button>
                        @if (session('status') === 'password-updated')
                            <span class="text-success ms-2 small">Đã đổi mật khẩu thành công!</span>
                        @endif
                    </form>
                </div>
            </div>
            <div class="card shadow-sm border-0 border-top border-danger border-3">
                <div class="card-body">
                    <h5 class="text-danger">Xóa tài khoản</h5>
                    <p class="text-muted small">Sau khi xóa, mọi dữ liệu sẽ không thể khôi phục.</p>
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        Xóa tài khoản vĩnh viễn
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('delete')
            <div class="modal-header">
                <h5 class="modal-title">Bạn có chắc chắn muốn xóa?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="small text-muted">Vui lòng nhập mật khẩu để xác nhận việc xóa tài khoản.</p>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu của bạn">
                @error('password', 'userDeletion') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
            </div>
        </form>
    </div>
</div>
@endsection
