@extends('admin.layout')
    @section('title', 'Danh sách lớp học')
    @section('content')
    <article>
       <div class="overlay-menu"></div>
        <section class="dashboard">
          <div class="container-fluid">
            <div class="card">
                <div class="card-header">Thêm lớp học mới</div>
                <div class="card-body">
                <form action="{{ route('admin.classes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control" placeholder="Tên lớp (VD: CNTT K15A)" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="school_year" class="form-control" placeholder="Niên khóa (VD: 2024-2027)" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">Lưu lớp</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên lớp</th>
                    <th>Niên khóa</th>
                </tr>
            </thead>
        <tbody>
            @foreach($classes as $class)
<tr>
    <td>{{ $class->id }}</td>
    <!-- Gắn link vào tên lớp -->
    <td>
        <a href="{{ route('admin.classes.show', $class->id) }}" style="font-weight: bold; text-decoration: none;">
            {{ $class->name }}
        </a>
    </td>
    <td>{{ $class->school_year }}</td>
    <td>
        <div class="d-flex">
            <a href="{{ route('admin.classes.curriculum', $class->id) }}" class="btn btn-primary btn-sm mr-2">
                <i class="fas fa-book"></i> Chương trình khung
            </a>
            <!-- Nút Xem chi tiết/Import -->
            <a href="{{ route('admin.classes.show', $class->id) }}" class="btn btn-info btn-sm mr-2">
                <i class="fas fa-users"></i> Danh sách SV
            </a>
            <!-- Nút Sửa -->
            <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-warning btn-sm mr-2">Sửa</a>

            <!-- Nút Xóa -->
            <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" onsubmit="return confirm('Xóa lớp sẽ xóa toàn bộ liên kết sinh viên. Tiếp tục?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
            </form>
        </div>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
    </div>
    </section>
    </article>
@endsection
