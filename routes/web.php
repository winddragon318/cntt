<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('/student/dashboard', function () {
    return view('student.Dashboard');
})->name('student.dashboard');
// Route xem chi tiết bài viết
Route::get('/news/{slug}', [PostController::class, 'show'])->name('news.show');
//------------------//
// --- DASHBOARD (Sau khi login thành công) ---
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- NHÓM QUẢN TRỊ (Giữ nguyên URL cũ của bạn) ---
Route::middleware(['auth'])->prefix('admin')->group(function () {

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
});

// --- PROFILE & AUTH ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
