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
                <td>{{ $class->name }}</td>
                <td>{{ $class->school_year }}</td>
                <td>
                    <div class="d-flex">
                    <!-- Nút Sửa -->
                    <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-warning btn-sm mr-2">Sửa</a>
                    <!-- Nút Xóa (Phải nằm trong form mới dùng được DELETE) -->
                    <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa lớp này?')">
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
