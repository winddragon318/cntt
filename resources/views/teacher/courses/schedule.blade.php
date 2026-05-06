@extends('layouts.teacher')
@section('content')
    <h3>Lịch trình giảng dạy: {{ $course->name }}</h3>
<!-- Form Import -->
<form action="{{ route('teacher.courses.import', $course->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
    @csrf
    <input type="file" name="file" required>
    <button type="submit" class="btn btn-success">Import Excel</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Ngày lên lớp</th>
            <th>Ca</th>
            <th>Lý thuyết</th>
            <th>Thực hành</th>
            <th>Kiểm tra</th>
            <th>Nội dung</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($schedules as $item)
        <tr>
            <td>{{ $item->stt }}</td>
            <td>{{ $item->date_on_class->format('d/m/Y') }}</td>
            <td>{{ $item->ca ?? 'Chưa chọn' }}</td>
            <td>{{ $item->theory_hours }}</td>
            <td>{{ $item->practice_hours }}</td>
            <td>{{ $item->test_hours }}</td>
            <td>{{ $item->content }}</td>
            <td>
                <!-- Nút Sửa/Xóa -->
                <a href="{{ route('teacher.schedule.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('teacher.schedule.destroy', $item->id) }}"
                    method="POST" style="display:inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa buổi dạy này không?')">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
