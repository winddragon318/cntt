@extends('layouts.teacher')
@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="font-weight-bold text-primary">
                <i class="fas fa-chalkboard-teacher mr-2"></i> Khóa học của tôi
            </h2>
            <p class="text-muted">Danh sách các học phần bạn được phân công giảng dạy.</p>
        </div>
    </div>

    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-left-primary">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Mã học phần: {{ $course->code }}
                        </div>
                        <h5 class="card-title font-weight-bold text-gray-800">{{ $course->name }}</h5>

                        <p class="card-text">
                            <strong>Lớp đang dạy:</strong><br>
                            @foreach($course->classes as $class)
                                <span class="badge badge-secondary text-dark">{{ $class->name }}</span>
                            @endforeach
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('teacher.courses.schedule', $course->id) }}" class="btn btn-primary btn-sm btn-block">
                            <i class="fas fa-calendar-alt"></i> Xem lịch giảng dạy
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning shadow-sm">
                    Hiện tại bạn chưa được phân công phụ trách khóa học nào. Vui lòng liên hệ Admin.
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection
