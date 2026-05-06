@extends('layouts.student')

@section('content')
<div class="detail-page">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 fw-bold text-primary">Chi tiết kết quả học tập</h4>
        <a href="{{ route('student.learning-results') }}" class="btn btn-outline-secondary btn-sm">Quay lại</a>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <h5 class="mb-1">{{ $course->name }}</h5>
            <div class="text-muted">Mã môn: {{ $course->code }} | Tín chỉ: {{ $course->credits ?? 0 }}</div>
        </div>
    </div>

    @if($score)
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row g-2">
                    @foreach(['tx1','tx2','tx3','tx4','tx5','tx6','exam1','exam2','final1','final2'] as $field)
                        <div class="col-6 col-md-3">
                            <div class="score-box">
                                <span class="label text-uppercase">{{ $field }}</span>
                                <strong>{{ $score->$field ?? '---' }}</strong>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 col-md-6">
                        <div class="score-box">
                            <span class="label">Xếp loại</span>
                            <strong>{{ $score->rank ?? '---' }}</strong>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="score-box">
                            <span class="label">Ghi chú</span>
                            <strong>{{ $score->note ?? '---' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">Môn học này chưa có dữ liệu điểm.</div>
    @endif
</div>

<style>
    .score-box {
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 10px;
        padding: 8px 10px;
    }
    .score-box .label {
        display: block;
        color: #64748b;
        font-size: 0.8rem;
        margin-bottom: 2px;
    }
    .score-box strong {
        color: #0f172a;
        font-size: 1rem;
    }
    @media (max-width: 767px) {
        .score-box strong { font-size: 0.92rem; }
    }
</style>
@endsection

