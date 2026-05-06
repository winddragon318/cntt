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
                <th>Phòng học</th>
                <th>Kỳ học</th>
                <th>Tín chỉ</th>
                <th>Giáo viên</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($class->courses as $course)
            <tr>
                <td>{{ $course->code }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->classroom ?? '---' }}</td>
                <td>{{ $course->semester ?? '---' }}</td>
                <td><span class="badge badge-primary">{{ $course->credits ?? 0 }}</span></td>
                <td>
                    @foreach($course->teachers as $teacher)
                        <span class="badge badge-info">{{ $teacher->name }}</span>
                    @endforeach
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCourseModal{{ $course->id }}">Sửa</button>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>

            <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header"><h5>Sửa khóa học</h5></div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Mã khóa học (Code)</label>
                                    <input type="text" name="code" class="form-control" value="{{ $course->code }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tên khóa học</label>
                                    <input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Phòng học</label>
                                    <input type="text" name="classroom" class="form-control" value="{{ $course->classroom }}" placeholder="VD: A2-305">
                                </div>
                                <div class="form-group">
                                    <label>Kỳ học</label>
                                    <input type="text" name="semester" class="form-control" value="{{ $course->semester }}" placeholder="VD: HK1 2024-2025">
                                </div>
                                <div class="form-group">
                                    <label>Tín chỉ</label>
                                    <input type="number" name="credits" min="1" max="10" class="form-control" value="{{ $course->credits ?? 3 }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Giáo viên phụ trách</label>
                                    <select name="teacher_ids[]" class="form-control select2" multiple required>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ $course->teachers->contains('id', $teacher->id) ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                        <label>Phòng học</label>
                        <input type="text" name="classroom" class="form-control" placeholder="VD: A2-305">
                    </div>
                    <div class="form-group">
                        <label>Kỳ học</label>
                        <input type="text" name="semester" class="form-control" placeholder="VD: HK1 2024-2025">
                    </div>
                    <div class="form-group">
                        <label>Tín chỉ</label>
                        <input type="number" name="credits" min="1" max="10" class="form-control" value="3" required>
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
