<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Course;
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
// Hiển thị danh sách học sinh trong lớp
public function show($id)
{
    $class = Classes::with('students')->findOrFail($id);
    return view('admin.classes.show', compact('class'));
}

    // Xử lý Import
    public function import(Request $request, $id)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);
        Excel::import(new StudentImport($id), $request->file('excel_file'));
        return redirect()->back()->with('success', 'Import sinh viên vào lớp thành công!');
    }
    public function curriculum($id)
{
    $class = Classes::with('courses.teachers')->findOrFail($id);

    // Lấy danh sách giáo viên để chọn khi thêm khóa học
    $teachers = User::whereHas('roles', function($q){
        $q->where('name', 'teacher');
    })->get();

    return view('admin.classes.curriculum', compact('class', 'teachers'));
}

public function storeCourse(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'code' => 'required|unique:courses,code',
        'teacher_ids' => 'required|array'
    ]);

    // 1. Tạo khóa học mới
    $course = Course::create([
        'name' => $request->name,
        'code' => $request->code,
    ]);

    // 2. Gán giáo viên vào khóa học (Bảng teacher_course)
    $course->teachers()->attach($request->teacher_ids);

    // 3. Gán khóa học vào lớp (Bảng class_course)
    $class = Classes::findOrFail($id);
    $class->courses()->attach($course->id);

    return redirect()->back()->with('success', 'Đã thêm khóa học vào chương trình!');
}
}
