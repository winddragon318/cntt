@extends('admin.layout')
    @section('title', 'Sửa giáo viên')
    @section('content')
    <article>
       <div class="overlay-menu"></div>
        <section class="dashboard">
          <div class="container-fluid">
                <div class="container">
    <h3>Chỉnh sửa thông tin giáo viên</h3>

    <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Họ tên</label>
            <input type="text" name="name" value="{{ $teacher->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $teacher->email }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" value="{{ $teacher->birthday }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Giới tính</label>
            <select name="gender" class="form-control">
                <option value="1" {{ $teacher->gender == 1 ? 'selected' : '' }}>Nam</option>
                <option value="0" {{ $teacher->gender == 0 ? 'selected' : '' }}>Nữ</option>
                <option value="2" {{ $teacher->gender == 2 ? 'selected' : '' }}>Khác</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
          </div>
    </section>
    </article>
@endsection
