<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy dữ liệu cho trang Home
        $news = Post::where('categories', 'Tin tức')->latest()->take(2)->get();
        $featured = Post::where('is_featured', 1)->latest()->take(3)->get();
        $notifications = Post::where('categories', 'Thông báo')->latest()->take(3)->get();
        $admissions = Post::where('categories', 'Tuyển sinh')->latest()->take(2)->get();
        $careers = Post::where('categories', 'Thực tập')
                   ->orWhere('categories', 'tuyen-dung')
                   ->latest()
                   ->take(3) // Lấy khoảng 3 tin
                   ->get();

        // Truyền sang view 'pages.home' (đúng thư mục của bạn)
        return view('pages.home', compact('news', 'featured', 'notifications', 'admissions', 'careers'));
    }
}
