<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Score;
use App\Models\Course;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.dashboard'); // Đảm bảo bạn đã có file resources/views/student/dashboard.blade.php
    }

    public function timetable()
    {
        return view('student.timetable');
    }

    public function timetableEvents(Request $request)
    {
        $student = Auth::user();

        $courseIdsFromClass = $student->classes()
            ->with('courses:id')
            ->get()
            ->flatMap(fn ($class) => $class->courses->pluck('id'))
            ->unique()
            ->values();

        $courseIdsFromDirect = $student->studentCourses()->pluck('courses.id');
        $courseIds = $courseIdsFromClass->merge($courseIdsFromDirect)->unique()->values();

        $events = Schedule::query()
            ->whereIn('course_id', $courseIds)
            ->with(['course.teachers:id,name'])
            ->orderBy('date_on_class')
            ->get()
            ->map(function ($schedule) {
                $timeRange = match ($schedule->ca) {
                    'sáng' => ['period' => '1 - 5', 'time' => '07:00 - 12:00'],
                    'chiều' => ['period' => '6 - 10', 'time' => '12:30 - 17:30'],
                    'tối' => ['period' => '11 - 15', 'time' => '18:00 - 22:00'],
                    default => ['period' => '---', 'time' => '---'],
                };

                return [
                    'date' => Carbon::parse($schedule->date_on_class)->toDateString(),
                    'course_name' => $schedule->course->name ?? 'Chưa có môn học',
                    'classroom' => $schedule->course->classroom ?? 'Chưa cập nhật',
                    'ca' => $schedule->ca ?? 'chưa rõ',
                    'period' => $timeRange['period'],
                    'time' => $timeRange['time'],
                    'teacher_names' => $schedule->course->teachers->pluck('name')->join(', '),
                    'content' => $schedule->content,
                ];
            })
            ->values();

        return response()->json($events);
    }

    public function learningResults()
    {
        $student = Auth::user();
        $courseIds = $this->getStudentCourseIds($student);

        $scores = Score::query()
            ->where('student_id', $student->id)
            ->whereIn('course_id', $courseIds)
            ->with('course:id,name,code,credits,semester')
            ->get()
            ->map(function ($score) {
                $average = $score->final2 ?? $score->final1 ?? $score->score ?? null;
                return [
                    'course_id' => $score->course_id,
                    'code' => $score->course->code ?? '---',
                    'name' => $score->course->name ?? '---',
                    'credits' => $score->course->credits ?? 0,
                    'semester' => $score->course->semester ?? 'Chưa phân kỳ',
                    'average' => $average,
                ];
            });

        $groupedBySemester = $scores->groupBy('semester');

        return view('student.learning-results', compact('groupedBySemester'));
    }

    public function learningResultDetail($courseId)
    {
        $student = Auth::user();
        $courseIds = $this->getStudentCourseIds($student);

        abort_unless($courseIds->contains((int) $courseId), 403);

        $course = Course::findOrFail($courseId);
        $score = Score::where('course_id', $courseId)
            ->where('student_id', $student->id)
            ->first();

        return view('student.learning-result-detail', compact('course', 'score'));
    }

    private function getStudentCourseIds($student)
    {
        $courseIdsFromClass = $student->classes()
            ->with('courses:id')
            ->get()
            ->flatMap(fn ($class) => $class->courses->pluck('id'));

        $courseIdsFromDirect = $student->studentCourses()->pluck('courses.id');

        return $courseIdsFromClass
            ->merge($courseIdsFromDirect)
            ->unique()
            ->values();
    }
}
