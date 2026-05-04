@extends('admin.layout')
    @section('title', 'sửa lớp học')
    @section('content')
    <article>
       <div class="overlay-menu"></div>
        <section class="dashboard">
          <div class="container-fluid">
            <h3>Chỉnh sửa lớp học</h3>

<form action="{{ route('admin.classes.update', $class->id) }}" method="POST">
    @csrf
    @method('PUT') {{-- Bắt buộc phải có để Laravel hiểu là Update --}}

    <div class="form-group">
        <label>Tên lớp</label>
        <input type="text" name="name" value="{{ $class->name }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Niên khóa</label>
        <input type="text" name="school_year" value="{{ $class->school_year }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
          </div>
    </section>
    </article>
    @endsection
