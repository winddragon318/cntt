@extends('layouts.student')

@section('content')
<div class="result-page">
    <div class="result-header mb-3">
        <h4 class="mb-0 fw-bold">Kết quả học tập</h4>
    </div>

    <div class="result-tabs">
        <a href="{{ route('student.dashboard') }}" class="tab-item">Tổng quan</a>
        <span class="tab-item active">Tổng kết</span>
    </div>

    @forelse($groupedBySemester as $semester => $items)
        <div class="semester-block">
            <h5 class="semester-title">{{ $semester }}</h5>

            <div class="table-wrap">
                <table class="table table-bordered mb-0 score-table">
                    <thead>
                        <tr>
                            <th>Mã môn</th>
                            <th>Môn học</th>
                            <th>TC</th>
                            <th>Điểm TB</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $row)
                            <tr onclick="window.location='{{ route('student.learning-results.detail', $row['course_id']) }}'" style="cursor:pointer;">
                                <td>{{ $row['code'] }}</td>
                                <td>{{ $row['name'] }}</td>
                                <td class="text-center">{{ $row['credits'] }}</td>
                                <td class="text-center">{{ $row['average'] !== null ? number_format($row['average'], 1) : '---' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @php
                $creditSum = $items->sum('credits');
                $weighted = $creditSum > 0
                    ? $items->sum(function ($i) { return ($i['average'] ?? 0) * $i['credits']; }) / $creditSum
                    : null;
            @endphp
            <div class="summary-line">
                <span>Điểm TBC học lực</span>
                <strong>{{ $weighted !== null ? number_format($weighted, 2) : '---' }}</strong>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Chưa có dữ liệu kết quả học tập.</div>
    @endforelse
</div>

<style>
    .result-header {
        background: #0d6efd;
        color: #fff;
        border-radius: 12px;
        padding: 12px 16px;
    }
    .result-tabs {
        display: flex;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 14px;
    }
    .tab-item {
        flex: 1;
        text-align: center;
        padding: 10px 8px;
        color: #64748b;
        text-decoration: none;
        font-weight: 600;
    }
    .tab-item.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }
    .semester-block {
        margin-bottom: 18px;
    }
    .semester-title {
        color: #0d6efd;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .table-wrap {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #bfdbfe;
        background: #fff;
    }
    .score-table thead th {
        background: #0d6efd;
        color: #fff;
        font-weight: 700;
        white-space: nowrap;
    }
    .score-table td {
        vertical-align: middle;
    }
    .summary-line {
        margin-top: 8px;
        display: flex;
        justify-content: space-between;
        font-size: 1.03rem;
        padding: 4px 2px;
    }

    /* PC */
    @media (min-width: 1025px) {
        .score-table td, .score-table th { font-size: 1rem; }
    }

    /* iPad */
    @media (min-width: 768px) and (max-width: 1024px) {
        .score-table td, .score-table th { font-size: 0.9rem; }
    }

    /* Mobile */
    @media (max-width: 767px) {
        .result-header h4 { font-size: 1.45rem; }
        .score-table td, .score-table th { font-size: 0.82rem; }
        .summary-line { font-size: 0.95rem; }
    }
</style>
@endsection

