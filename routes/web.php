<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Đường dẫn "bang-dieu-khien" như bạn muốn
    Route::get('/bang-dieu-khien', function () {
        return view('admin.bang-dieu-khien');
    })->name('admin.bang-dieu-khien');

Route::get('/cau-hinh-tong-quat', function () {
        return view('admin.cau-hinh-tong-quat');
    })->name('admin.cau-hinh-tong-quat');

Route::get('/danh-sach-tai-khoan', function () {
        return view('admin.danh-sach-tai-khoan');
    })->name('admin.danh-sach-tai-khoan');
 Route::get('/them-tai-khoan', function () {
        return view('admin.them-tai-khoan');
    })->name('admin.them-tai-khoan');
    Route::get('/danh-sach-san-pham', function () {
        return view('admin.danh-sach-san-pham');
    })->name('admin.danh-sach-san-pham');
     Route::get('/them-san-pham', function () {
        return view('admin.them-san-pham');
    })->name('admin.them-san-pham');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
