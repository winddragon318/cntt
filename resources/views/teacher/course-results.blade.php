@extends('layouts.teacher')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <div>
        <h4 class="mb-1 fw-bold text-primary">Bảng điểm: {{ $course->name }}</h4>
        <p class="text-muted mb-0">Danh sách sinh viên và điểm import từ file Excel.</p>
    </div>
    <a href="{{ route('teacher.learning-results') }}" class="btn btn-outline-secondary">Quay lại</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <form action="{{ route('teacher.learning-results.import', $course->id) }}" method="POST" enctype="multipart/form-data" class="row g-2 align-items-end">
            @csrf
            <div class="col-12 col-md-7 col-lg-8">
                <label class="form-label fw-semibold">Import điểm từ file Excel</label>
                <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
            </div>
            <div class="col-12 col-md-5 col-lg-4">
                <button type="submit" class="btn btn-primary w-100">Import file</button>
            </div>
        </form>
        @error('file')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0 score-table">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Mã SV</th>
                        <th>Họ tên</th>
                        <th>TX1</th>
                        <th>TX2</th>
                        <th>TX3</th>
                        <th>TX4</th>
                        <th>TX5</th>
                        <th>TX6</th>
                        <th>Thi L1</th>
                        <th>Thi L2</th>
                        <th>TK L1</th>
                        <th>TK L2</th>
                        <th>Xếp loại</th>
                        <th>Ghi chú</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $idx => $student)
                        @php $score = $scores->get($student->id); @endphp
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ $student->login_code }}</td>
                            <td class="fw-semibold">{{ $student->name }}</td>
                            <td>{{ $score?->tx1 }}</td>
                            <td>{{ $score?->tx2 }}</td>
                            <td>{{ $score?->tx3 }}</td>
                            <td>{{ $score?->tx4 }}</td>
                            <td>{{ $score?->tx5 }}</td>
                            <td>{{ $score?->tx6 }}</td>
                            <td>{{ $score?->exam1 }}</td>
                            <td>{{ $score?->exam2 }}</td>
                            <td>{{ $score?->final1 }}</td>
                            <td>{{ $score?->final2 }}</td>
                            <td>{{ $score?->rank }}</td>
                            <td>{{ $score?->note }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-edit-score" data-bs-toggle="modal" data-bs-target="#editScoreModal{{ $student->id }}">
                                    Sửa điểm
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="editScoreModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sửa điểm - {{ $student->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('teacher.learning-results.update-score', ['course' => $course->id, 'student' => $student->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row g-2">
                                                @foreach (['tx1','tx2','tx3','tx4','tx5','tx6','exam1','exam2','final1','final2'] as $field)
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label text-uppercase">{{ $field }}</label>
                                                        <input type="number" step="0.1" min="0" max="10" name="{{ $field }}" class="form-control" value="{{ $score?->$field }}">
                                                    </div>
                                                @endforeach
                                                <div class="col-12 col-md-6">
                                                    <label class="form-label">Xếp loại</label>
                                                    <input type="text" name="rank" class="form-control" value="{{ $score?->rank }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Ghi chú</label>
                                                    <textarea name="note" class="form-control" rows="2">{{ $score?->note }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="16" class="text-center py-4 text-muted">
                                Chưa có sinh viên trong khóa học này hoặc chưa import danh sách.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .score-table th,
    .score-table td {
        white-space: nowrap;
        font-size: 0.9rem;
    }
    .btn-edit-score {
        background: #fff7ed;
        color: #111827;
        border: 1px solid #fb923c;
        font-weight: 600;
    }
    .btn-edit-score:hover {
        background: #f97316;
        color: #fff;
    }

    /* iPad */
    @media (min-width: 768px) and (max-width: 1024px) {
        .score-table th,
        .score-table td {
            font-size: 0.84rem;
        }
    }

    /* Mobile */
    @media (max-width: 767px) {
        .score-table th,
        .score-table td {
            font-size: 0.8rem;
        }
    }
</style>
@endsection

