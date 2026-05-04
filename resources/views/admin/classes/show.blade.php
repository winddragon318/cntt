@extends('admin.layout')
    @section('title', 'Danh sách học sinh của lớp ' . $class->name)
    @section('content')
    <article>
       <div class="overlay-menu"></div>
        <section class="dashboard">
          <div class="container-fluid">
                <h3>Lớp: {{ $class->name }}</h3>

<!-- Form Import -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.classes.import', $class->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Chọn file Excel (Book1.xlsx)</label>
            <input type="file" name="excel_file" class="form-control" required>
            <button type="submit" class="btn btn-primary mt-2">Import Sinh Viên</button>
        </form>
    </div>
</div>

<!-- Danh sách sinh viên -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>MSV (Login Code)</th>
            <th>Họ và Tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
        </tr>
    </thead>
    <tbody>
        @foreach($class->students as $student)
        <tr>
            <td>{{ $student->login_code }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->gender == 1 ? 'Nữ' : 'Nam' }}</td>
            <td>{{ $student->birthday }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
          </div>
    </section>
    </article>
@endsection
