<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Admin\TeacherManagerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\ClassManagerController;
use App\Http\Controllers\Teacher\CourseManagerController;

// --- TRANG CHỦ ---
Route::get('/', [HomeController::class, 'index'])->name('home');
/*Route::get('/news', function () {
    return view('pages.news');
})->name('news');*/
Route::get('/gioi-thieu-khoa', function () {
    return view('pages.gioi-thieu-ve-khoa');
})->name('about.khoa');
Route::get('/co-cau-to-chuc', function () {
    return view('pages.co-cau-to-chuc');
})->name('organization.structure');
Route::get('/doi-ngu-giang-vien', function () {
    return view('pages.doi-ngu-giang-vien');
})->name('faculty.members');
Route::get('/dao-tao', [PostController::class, 'daoTao'])
    ->name('dao-tao');
Route::get('/tin-tuc-su-kien', [PostController::class, 'tinTuc'])
    ->name('tin-tuc');
Route::get('/thong-bao-sinh-vien', [PostController::class, 'thongBao'])
    ->name('thong-bao');
Route::get('/tuyen-dung', [PostController::class, 'tuyenDung'])
    ->name('tuyen-dung');
// Route xem chi tiết bài viết
Route::get('/news/{slug}', [PostController::class, 'show'])->name('news.show');
//------------------//

// Route cho Giáo viên
Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.') // Tiền tố chung cho tất cả route bên trong
    ->group(function () {
        Route::get('/dashboard', [TeacherController::class, 'index'])->name('dashboard');
        // Quản lý khóa học của giáo viên
        Route::get('/courses', [CourseManagerController::class, 'index'])->name('courses.index');
        Route::get('/courses/{id}', [CourseManagerController::class, 'show'])->name('courses.show');
        // Xem lịch trình của môn học
    Route::get('/courses/{id}/schedule', [CourseManagerController::class, 'showSchedule'])->name('courses.schedule');
    // Import lịch trình
    Route::post('/courses/{id}/import', [CourseManagerController::class, 'importSchedule'])->name('courses.import');
    // Xóa lịch trình lẻ
    Route::delete('/schedule/{id}', [CourseManagerController::class, 'destroySchedule'])->name('schedule.destroy');
    // Trang hiển thị form sửa
    Route::get('/schedule/{id}/edit', [CourseManagerController::class, 'editSchedule'])->name('schedule.edit');
    // Cập nhật lịch trình lẻ
    Route::put('/schedule/{id}', [CourseManagerController::class, 'updateSchedule'])->name('schedule.update');
    // API lấy sự kiện cho calendars
    Route::get('/api/calendar-events', [CourseManagerController::class, 'getCalendarEvents'])->name('api.calendar.events');
    Route::get('/calendar', [CourseManagerController::class, 'showFullCalendar'])->name('calendar');
    Route::get('/learning-results', [CourseManagerController::class, 'showLearningResults'])->name('learning-results');
    Route::get('/learning-results/{course}', [CourseManagerController::class, 'showCourseResults'])->name('learning-results.show');
    Route::post('/learning-results/{course}/import', [CourseManagerController::class, 'importCourseResults'])->name('learning-results.import');
    Route::put('/learning-results/{course}/students/{student}', [CourseManagerController::class, 'updateStudentScore'])->name('learning-results.update-score');
    });
// Route cho Sinh viên
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/timetable', [StudentController::class, 'timetable'])->name('student.timetable');
    Route::get('/api/timetable-events', [StudentController::class, 'timetableEvents'])->name('student.api.timetable-events');
    Route::get('/learning-results', [StudentController::class, 'learningResults'])->name('student.learning-results');
    Route::get('/learning-results/{course}', [StudentController::class, 'learningResultDetail'])->name('student.learning-results.detail');
});

// --- NHÓM QUẢN TRỊ (Giữ nguyên URL cũ của bạn) ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Bảng điều khiển
    Route::get('/bang-dieu-khien', function () {
        return view('admin.bang-dieu-khien');
    })->name('admin.bang-dieu-khien');

    // Cấu hình
    Route::get('/cau-hinh-tong-quat', function () {
        return view('admin.cau-hinh-tong-quat');
    })->name('admin.cau-hinh-tong-quat');

    // Quản lý Tài khoản
    Route::get('/danh-sach-tai-khoan', function () {
        return view('admin.danh-sach-tai-khoan');
    })->name('admin.danh-sach-tai-khoan');

    Route::get('/them-tai-khoan', function () {
        return view('admin.them-tai-khoan');
    })->name('admin.them-tai-khoan');

    //quản lý bài viết
    Route::get('/danh-sach-bai-viet', [PostController::class, 'index'])->name('admin.danh-sach-bai-viet');
    Route::get('/them-bai-viet', [PostController::class, 'create'])->name('admin.them-bai-viet');
    Route::post('/admin/luu-bai-viet', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/sua-bai-viet/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::post('/cap-nhat-bai-viet/{id}', [PostController::class, 'update'])->name('admin.posts.update');

    // Xóa bài viết (Lưu ý: Bạn dùng @method('DELETE') trong Form nên dùng Route::delete)
    Route::delete('/xoa-bai-viet/{id}', [PostController::class, 'destroy'])->name('admin.posts.delete');
    Route::post('/posts/upload-image', [PostController::class, 'uploadImage'])->name('admin.posts.upload_image');
    // Quản lý giáo viên
    Route::get('/teachers', [TeacherManagerController::class, 'index'])->name('admin.teachers.index');
    Route::post('/teachers', [TeacherManagerController::class, 'store'])->name('admin.teachers.store');
    Route::get('/teachers/{id}/edit', [TeacherManagerController::class, 'edit'])->name('admin.teachers.edit');
    Route::put('/teachers/{id}', [TeacherManagerController::class, 'update'])->name('admin.teachers.update');
    Route::delete('/teachers/{id}', [TeacherManagerController::class, 'destroy'])->name('admin.teachers.destroy');
    // Quản lý lớp học
    Route::get('/classes', [ClassManagerController::class, 'index'])->name('admin.classes.index');
    Route::post('/classes', [ClassManagerController::class, 'store'])->name('admin.classes.store');
    Route::get('/classes/{id}/edit', [ClassManagerController::class, 'edit'])->name('admin.classes.edit');
    Route::put('/classes/{id}', [ClassManagerController::class, 'update'])->name('admin.classes.update');
    Route::delete('/classes/{id}', [ClassManagerController::class, 'destroy'])->name('admin.classes.destroy');
    // Hiển thị danh sách học sinh trong lớp
    Route::get('/classes/{id}', [ClassManagerController::class, 'show'])->name('admin.classes.show');
    Route::post('/classes/{id}/import', [ClassManagerController::class, 'import'])->name('admin.classes.import');
    // Xem chương trình khung của lớp
    Route::get('/classes/{id}/curriculum', [ClassManagerController::class, 'curriculum'])->name('admin.classes.curriculum');
    // Thêm khóa học mới trực tiếp vào lớp này
    Route::post('/classes/{id}/courses', [ClassManagerController::class, 'storeCourse'])->name('admin.classes.storeCourse');
    // Sửa/Xóa khóa học (dùng chung cho toàn hệ thống)
    Route::put('/courses/{id}', [ClassManagerController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/courses/{id}', [ClassManagerController::class, 'destroyCourse'])->name('admin.courses.destroy');
});

// --- PROFILE & AUTH ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
