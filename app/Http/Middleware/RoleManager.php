<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle($request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->roles->pluck('name')->toArray();

        // Nếu người dùng không có role cần thiết thì chặn lại
        if (!in_array($role, $userRole)) {
            abort(403, 'Bạn không có quyền truy cập khu vực này.');
        }
    return $next($request);
    }
}
