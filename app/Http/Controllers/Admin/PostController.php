<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Mảng danh mục dùng chung cho toàn bộ Controller
    private $category_list = ['Tin tức', 'Thông báo', 'Tuyển sinh', 'Sự kiện','tuyen-dung'];

    // 1. Trang danh sách bài viết
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('category') && in_array($request->category, $this->category_list, true)) {
            $query->where('categories', $request->category);
        }

        $posts = $query->latest()->paginate(10)->withQueryString();

        // Truyền mảng danh mục cứng sang để làm bộ lọc nếu cần
        $categories = $this->category_list;

        return view('admin.danh-sach-bai-viet', compact('posts', 'categories'));
    }

    // 2. Trang thêm bài viết mới
    public function create()
    {
        $categories = $this->category_list;
        return view('admin.them-bai-viet', compact('categories'));
    }

    // 3. Xử lý lưu bài viết
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'content' => 'required',
            'categories' => 'required', // Kiểm tra giá trị từ mảng categories
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::check() ? Auth::id() : 1;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['views'] = 0;

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/posts', 'public');
            $data['thumbnail'] = $path;
        }

        Post::create($data);

        return redirect()->route('admin.danh-sach-bai-viet')->with('success', 'Lưu bài viết thành công!');
    }

    // 4. Trang chỉnh sửa bài viết
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = $this->category_list; // Dùng mảng cứng
        return view('admin.sua-bai-viet', compact('post', 'categories'));
    }

    // 5. Xử lý cập nhật bài viết
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $id,
            'content' => 'required',
            'categories' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $path = $request->file('thumbnail')->store('uploads/posts', 'public');
            $data['thumbnail'] = $path;
        }

        $post->update($data);

        return redirect()->route('admin.danh-sach-bai-viet')
                         ->with('success', 'Cập nhật bài viết thành công!');
    }

    // 6. Xử lý xóa bài viết
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        return redirect()->back()->with('success', 'Đã xóa bài viết vĩnh viễn!');
    }

    // Upload ảnh cho Editor
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/editor', $fileName, 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }
    }
    public function show($slug)
{
    // Tìm bài viết theo slug
    $post = Post::where('slug', $slug)->firstOrFail();

    // Trả về view hiển thị nội dung chi tiết
    return view('pages.news', compact('post'));
}
public function daoTao()
{
    $posts = Post::where('categories', 'Tuyển sinh')
                ->latest()
                ->paginate(6);

    return view('pages.dao-tao', compact('posts'));
}
public function tinTuc()
{
    $posts = Post::where('categories', 'Tin tức')
                ->latest()
                ->paginate(6);

    return view('pages.tin-tuc', compact('posts'));
}
public function thongBao()
{
    $posts = Post::where('categories', 'Thông báo')
                ->latest()
                ->paginate(6);

    return view('pages.thong-bao', compact('posts'));
}
public function tuyenDung()
{
    $posts = Post::where('categories', 'tuyen-dung')
                ->latest()
                ->paginate(6);

    return view('pages.tuyen-dung', compact('posts'));
}
}
