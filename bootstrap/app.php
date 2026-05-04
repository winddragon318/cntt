<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
    // 1. Định nghĩa bí danh cho middleware phân quyền
    $middleware->alias([
        'role' => \App\Http\Middleware\CheckRole::class, 
    ]);
    // 2. Logic điều hướng (Code của bạn)
    $middleware->redirectTo(
        guests: '/login',
        users: function ($request) {
            $user = $request->user();
            if (!$user) return '/';

            if ($user->roles->contains('name', 'admin')) {
                return route('admin.dashboard');
            }
            if ($user->roles->contains('name', 'teacher')) {
                return route('teacher.dashboard');
            }
            if ($user->roles->contains('name', 'student')) {
                return route('student.dashboard');
            }
            return '/'; 
        }
    );
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
