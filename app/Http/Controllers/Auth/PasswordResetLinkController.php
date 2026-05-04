<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate(['login_code' => ['required']]);
        // Tìm user dựa trên login_code
        $user = User::where('login_code', $request->login_code)->first();
        // Nếu không thấy user hoặc user chưa có email
        if (!$user || !$user->email) {
            return back()->withErrors([
                'login_code' => 'Tài khoản này chưa cập nhật Email. Vui lòng liên hệ Admin!'
            ]);
        }
        // Nếu có email, tiến hành gửi link như mặc định của Breeze
        // (Lưu ý: Breeze mặc định tìm theo email, bạn cần gửi thêm trường email vào Broker)
        $status = Password::sendResetLink(['email' => $user->email]);
        return $status == Password::RESET_LINK_SENT
                 ? back()->with('status', __($status))
                : back()->withErrors(['login_code' => __($status)]);
    }
}
