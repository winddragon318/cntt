@extends('layouts.teacher')

@section('content')
<div class="result-page">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-primary">Kết quả học tập</h4>
            <p class="text-muted mb-0">Chọn khóa học để vào quản lý điểm chi tiết.</p>
        </div>
    </div>

    <div class="row g-3 g-lg-4">
        @forelse($courses as $course)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="course-card h-100">
                    <div class="course-card-body">
                        <span class="course-code">Mã học phần: {{ $course->code }}</span>
                        <h5 class="course-name">{{ $course->name }}</h5>

                        <div class="meta-grid">
                            <div class="meta-item">
                                <span class="meta-label">Số sinh viên</span>
                                <strong>{{ $course->students_count }}</strong>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Buổi học</span>
                                <strong>{{ $course->schedules_count }}</strong>
                            </div>
                        </div>

                        <div class="class-wrap">
                            <div class="class-title">Lớp liên kết</div>
                            <div class="d-flex flex-wrap gap-2">
                                @forelse($course->classes as $class)
                                    <span class="class-badge">{{ $class->name }}</span>
                                @empty
                                    <span class="text-muted small">Chưa gán lớp</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="course-card-footer">
                        <a href="{{ route('teacher.learning-results.show', $course->id) }}" class="btn btn-primary w-100">
                            Xem kết quả học tập
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning mb-0">
                    Bạn chưa được phân công khóa học nào để nhập kết quả học tập.
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .course-card {
        background: #ffffff;
        border: 1px solid #dbe2ea;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(24, 39, 75, 0.08);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .course-card-body {
        padding: 1rem 1rem 0.5rem 1rem;
    }

    .course-card-footer {
        padding: 0.75rem 1rem 1rem 1rem;
    }

    .course-code {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .course-name {
        margin: 0.35rem 0 0.8rem;
        font-weight: 700;
        color: #0f172a;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        margin-bottom: 0.8rem;
    }

    .meta-item {
        background: #f8fafc;
        border-radius: 10px;
        padding: 0.5rem 0.65rem;
    }

    .meta-label {
        display: block;
        color: #64748b;
        font-size: 0.78rem;
    }

    .class-title {
        font-size: 0.82rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 0.35rem;
    }

    .class-badge {
        display: inline-block;
        background: #e2e8f0;
        color: #0f172a;
        border-radius: 999px;
        font-size: 0.78rem;
        padding: 0.25rem 0.55rem;
        font-weight: 600;
    }

    /* PC */
    @media (min-width: 1025px) {
        .course-card-body {
            padding: 1.15rem 1.15rem 0.65rem 1.15rem;
        }
        .course-card-footer {
            padding: 0.9rem 1.15rem 1.15rem 1.15rem;
        }
    }

    /* iPad */
    @media (min-width: 768px) and (max-width: 1024px) {
        .result-page h4 {
            font-size: 1.3rem;
        }
        .course-name {
            font-size: 1.05rem;
        }
    }

    /* Mobile */
    @media (max-width: 767px) {
        .result-page h4 {
            font-size: 1.1rem;
        }
        .course-card {
            border-radius: 12px;
        }
        .course-card-body {
            padding: 0.85rem 0.85rem 0.45rem 0.85rem;
        }
        .course-card-footer {
            padding: 0.65rem 0.85rem 0.85rem 0.85rem;
        }
        .course-name {
            font-size: 1rem;
        }
        .meta-label,
        .class-title {
            font-size: 0.75rem;
        }
    }
</style>
@endsection

