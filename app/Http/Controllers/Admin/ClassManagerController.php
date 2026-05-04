<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
class ClassManagerController extends Controller
{
    // Hiển thị danh sách lớp
    public function index()
    {
        $classes = Classes::all();
        return view('admin.classes.index', compact('classes'));
    }

    // Lưu lớp học mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'school_year' => 'required|string|max:20',
        ]);

        Classes::create([
            'name' => $request->name,
            'school_year' => $request->school_year,
        ]);

        return redirect()->back()->with('success', 'Tạo lớp học mới thành công!');
    }
    // 1. Hiển thị form sửa
public function edit($id)
{
    $class = Classes::findOrFail($id);
    return view('admin.classes.edit', compact('class'));
}

// 2. Xử lý cập nhật dữ liệu
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'school_year' => 'required|string|max:20',
    ]);

    $class = Classes::findOrFail($id);
    $class->update([
        'name' => $request->name,
        'school_year' => $request->school_year,
    ]);

    return redirect()->route('admin.classes.index')->with('success', 'Cập nhật lớp học thành công!');
}

// 3. Xử lý xóa
public function destroy($id)
{
    $class = Classes::findOrFail($id);
    $class->delete();

    return redirect()->back()->with('success', 'Đã xóa lớp học thành công!');
}
}
