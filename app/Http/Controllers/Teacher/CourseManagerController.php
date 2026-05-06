<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Course;
use App\Models\User;
use App\Models\Schedule;

class CourseManagerController extends Controller
{
    public function index()
    {
        // Lấy tất cả khóa học và thông tin giáo viên đi kèm
        $courses = Course::with('teachers')->get();
        // Lấy danh sách những người có quyền teacher để hiển thị trong form thêm/sửa
        $teachers = User::whereHas('roles', function($q) {
            $q->where('name', 'teacher');
        })->get();
        return view('teacher.courses.index', compact('courses', 'teachers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:courses,code',
            'teacher_ids' => 'required|array'
        ]);

        $course = Course::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        // Gán giáo viên vào khóa học qua bảng trung gian teacher_course
        $course->teachers()->attach($request->teacher_ids);

        return redirect()->back()->with('success', 'Đã tạo khóa học mới!');
    }
    public function showSchedule($courseId)
    {
        $course = Auth::user()->courses()->findOrFail($courseId);
        $schedules = $course->schedules()->orderBy('stt')->get();
        return view('teacher.courses.schedule', compact('course', 'schedules'));
    }

    public function importSchedule(Request $request, $courseId)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);
        Excel::import(new ScheduleImport($courseId), $request->file('file'));
        return redirect()->back()->with('success', 'Import lịch trình thành công!');
    }
    // Hàm hiển thị trang sửa
    public function editSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        // Lấy thông tin khóa học để làm breadcrumb hoặc tiêu đề
        $course = $schedule->course;

        return view('teacher.courses.edit_schedule', compact('schedule', 'course'));
    }
    // Hàm xử lý cập nhật (giữ nguyên logic cũ nhưng redirect về trang lịch trình)
    public function updateSchedule(Request $request, $id)
    {
    $request->validate([
        'date_on_class' => 'required|date',
        'ca' => 'required|in:sáng,chiều,tối',
        'theory_hours' => 'numeric|min:0',
        'practice_hours' => 'numeric|min:0',
        'test_hours' => 'numeric|min:0',
        'content' => 'nullable|string',
    ]);
    $schedule = Schedule::findOrFail($id);
    $schedule->update($request->all());
    return redirect()->route('teacher.courses.schedule', $schedule->course_id)
                     ->with('success', 'Cập nhật lịch dạy thành công!');
    }
    public function destroySchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $courseId = $schedule->course_id; // Lưu lại ID khóa học để quay về trang cũ
        $schedule->delete();
        return redirect()->route('teacher.courses.schedule', $courseId)
                     ->with('success', 'Đã xóa một buổi dạy khỏi lịch trình!');
    }
    // Hàm hiển thị trang Calendar tổng quát
    public function showFullCalendar()
    {
        // Chỉ đơn giản là trả về view trang lịch
        return view('teacher.calendar');
    }
    public function getCalendarEvents()
{
    $teacher = Auth::user();

    $events = Schedule::whereIn('course_id', $teacher->courses->pluck('id'))
        ->with('course.classes')
        ->get()
        ->map(function ($schedule) {
            $className = optional($schedule->course->classes->first())->name ?? 'Chưa có lớp';
            $displayTitle = $schedule->course->name . ' - ' . $className;

            $startTime = '07:00:00';
            $endTime = '12:00:00';

            if ($schedule->ca === 'chiều') {
                $startTime = '12:00:00';
                $endTime = '17:00:00';
            } elseif ($schedule->ca === 'tối') {
                $startTime = '17:00:00';
                $endTime = '22:00:00';
            }

            return [
                'id'    => $schedule->id,
                'title' => $displayTitle,
                'start' => $schedule->date_on_class->format('Y-m-d') . 'T' . $startTime,
                'end' => $schedule->date_on_class->format('Y-m-d') . 'T' . $endTime,
                'allDay' => false,
                'backgroundColor' => '#4e73df',
                'borderColor' => '#4e73df',
                'extendedProps' => [
                    'stt'     => $schedule->stt,
                    'ca'      => $schedule->ca,
                    'content' => $schedule->content,
                    'hours'   => $schedule->hours,
                ]
            ];
        });

    return response()->json($events);
}
}
