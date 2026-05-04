@extends('admin.layout')
    @section('title', 'Danh sách lớp học')
    @section('content')
    <article>
       <div class="overlay-menu"></div>
        <section class="dashboard">
          <div class="container-fluid">
            <div class="container">
    <h3>Chương trình khung lớp: {{ $class->name }}</h3>

    <!-- Nút mở Modal thêm khóa học -->
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addCourseModal">
        + Thêm khóa học mới
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã môn</th>
                <th>Tên khóa học</th>
                <th>Giáo viên</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($class->courses as $course)
            <tr>
                <td>{{ $course->code }}</td>
                <td>{{ $course->name }}</td>
                <td>
                    @foreach($course->teachers as $teacher)
                        <span class="badge badge-info">{{ $teacher->name }}</span>
                    @endforeach
                </td>
                <td>
                    <button class="btn btn-warning btn-sm">Sửa</button>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Thêm Khóa Học -->
<div class="modal fade" id="addCourseModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.classes.storeCourse', $class->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5>Thêm khóa học mới</h5></div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mã khóa học (Code)</label>
                        <input type="text" name="code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tên khóa học</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Giáo viên phụ trách</label>
                        <select name="teacher_ids[]" class="form-control select2" multiple required>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </div>
        </form>
    </div>
</div>
          </div>
        </section>
    </article>
@endsection
