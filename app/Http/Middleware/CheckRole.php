<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Xử lý yêu cầu truy cập.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // 2. Sử dụng hàm hasRole đã viết trong Model User để kiểm tra quyền
        // Nếu không có quyền tương ứng (ví dụ: role:admin), trả về lỗi 403
        if (!$request->user()->hasRole($role)) {
            abort(403, 'Bạn không có quyền truy cập vào khu vực này.');
        }

        return $next($request);
    }
}