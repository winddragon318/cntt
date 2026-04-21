@extends('layouts.student')

@section('student_content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2 class="fw-bold">Chào mừng trở lại, {{ Auth::user()->name }}!</h2>
        <p class="text-muted">Hôm nay bạn có 2 thông báo mới từ khoa.</p>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 mb-3 bg-primary text-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mb-1">Điểm TB</h6>
                    <h3>3.6</h3>
                </div>
                <i class="mdi mdi-school mdi-36px"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 mb-3 bg-success text-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mb-1">Tín chỉ tích lũy</h6>
                    <h3>85</h3>
                </div>
                <i class="mdi mdi-book mdi-36px"></i>
            </div>
        </div>
    </div>
</div>
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white fw-bold">Thông báo mới nhất</div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Nội dung</th>
                    <th>Người gửi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>21/04/2024</td>
                    <td>Thông báo lịch thi học kỳ 2</td>
                    <td>Phòng Đào tạo</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
