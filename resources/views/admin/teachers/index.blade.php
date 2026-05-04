@extends('admin.layout')
    @section('title', 'Danh sách giáo viên')
    @section('content')
    <article>
       <div class="overlay-menu"></div>
        <section class="dashboard">
          <div class="container-fluid">
            {{-- Form thêm mới --}}
                <form action="{{ route('admin.teachers.store') }}" method="POST">
                @csrf
                    <input type="text" name="name" placeholder="Họ tên giáo viên" required>
                    <input type="email" name="email" placeholder="Email (dùng để đăng nhập)" required>
                    <input type="date" name="birthday">
                        <select name="gender">
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    <button type="submit">Thêm Giáo Viên</button>
                </form>
                <hr>

            {{-- Danh sách giáo viên hiện có --}}
            <table>
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Mã đăng nhập (Email)</th>
                        <th>Ngày sinh</th>
                    </tr>
                </thead>
            <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->login_code }}</td>
                        <td>{{ $teacher->birthday }}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm mr-2">Sửa</a>
                            <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa giáo viên này?')">
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
