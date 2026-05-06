@extends('layouts.teacher') <!-- Hoặc layout bạn đang dùng -->

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Chỉnh sửa lịch giảng dạy - Buổi {{ $schedule->stt }} ({{ $course->name }})
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('teacher.schedule.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Ngày lên lớp</label>
                        <input type="date" name="date_on_class" class="form-control"
                               value="{{ $schedule->date_on_class->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Ca học</label>
                        <select name="ca" class="form-control" required>
                            <option value="">-- Chọn ca --</option>
                            <option value="sáng" {{ old('ca', $schedule->ca) === 'sáng' ? 'selected' : '' }}>Sáng</option>
                            <option value="chiều" {{ old('ca', $schedule->ca) === 'chiều' ? 'selected' : '' }}>Chiều</option>
                            <option value="tối" {{ old('ca', $schedule->ca) === 'tối' ? 'selected' : '' }}>Tối</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Lý thuyết (giờ)</label>
                        <input type="number" step="0.1" name="theory_hours" class="form-control" value="{{ $schedule->theory_hours }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Thực hành (giờ)</label>
                        <input type="number" step="0.1" name="practice_hours" class="form-control" value="{{ $schedule->practice_hours }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Kiểm tra (giờ)</label>
                        <input type="number" step="0.1" name="test_hours" class="form-control" value="{{ $schedule->test_hours }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Tóm tắt nội dung lên lớp</label>
                    <textarea name="content" class="form-control" rows="5">{{ $schedule->content }}</textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('teacher.courses.schedule', $course->id) }}" class="btn btn-secondary">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
