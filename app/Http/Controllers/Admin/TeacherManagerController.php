<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherManagerController extends Controller
{
    // 1. Trang danh sách giáo viên
    public function index()
    {
        $teachers = User::whereHas('roles', function($q) {
            $q->where('name', 'teacher');
        })->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    // 2. Xử lý lưu giáo viên
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Tạo tài khoản giáo viên
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'login_code' => $request->email, // Mặc định dùng Email để đăng nhập
            'password' => Hash::make('1111'), // Mật khẩu mặc định
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        ]);

        // Gán Role 'teacher' cho User vừa tạo
        $teacherRole = Role::where('name', 'teacher')->first();
        if ($teacherRole) {
            $user->roles()->attach($teacherRole->id);
        }

        return redirect()->route('admin.teachers.index')->with('success', 'Thêm giáo viên thành công!');
    }
    // 1. Hiển thị form chỉnh sửa giáo viên
    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    // 2. Cập nhật thông tin giáo viên
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'gender' => 'required|in:0,1,2',
        ]);
        $teacher = User::findOrFail($id);
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'login_code' => $request->email, // Cập nhật luôn login_code nếu email thay đổi
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        ]);
        return redirect()->route('admin.teachers.index')->with('success', 'Cập nhật thông tin giáo viên thành công!');
    }

    // 3. Xóa giáo viên
    public function destroy($id)
    {
        $teacher = User::findOrFail($id);
        // Gỡ bỏ các quyền trong bảng trung gian role_user
        $teacher->roles()->detach();
        // Xóa giáo viên
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Đã xóa giáo viên thành công!');
    }
}
