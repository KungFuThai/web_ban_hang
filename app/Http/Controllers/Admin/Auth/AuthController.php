<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgetPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ProcessResetPasswordRequest;
use App\Models\Admin;
use App\Models\ForgetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loggingIn(LoginRequest $request)
    {
        $password = $request->get('password');
        $adminFind = Admin::query()
            ->where('email', $request->get('email'))
            ->firstOrFail();
        if ( ! Hash::check($password, $adminFind->password)) {
            return redirect()->route('login')->with('error', 'Sai cái gì đó rồi');
        }
        $admin = session()->get('admin');
        $admin = [
            'id' => $adminFind->id,
            'full_name' => $adminFind->full_name,
            'role' => $adminFind->role,
        ];
        session()->put('admin', $admin);

        return redirect()->route('welcome')->with('success', 'Chào mừng bạn quay trở lại!');
    }

    public function logout()
    {
        if(session()->has('admin')){
            session()->forget('admin');
        }

        return redirect()->route('login');
    }

    public function forgetPassword()
    {
        return view('auth.forget');
    }

    public function processForgetPassword(ForgetPasswordRequest $request)
    {
        $email = $request->email;
        $forgetPassword = ForgetPassword::query()
            ->firstOrCreate(['email' => $email],
                [
                    'email' => $email,
                    'token' => Str::random(60),
                ]);
        Mail::send('auth.mail', compact('forgetPassword'), function ($email) use ($forgetPassword) {
            $title = config('app.name').' '.'đổi mật khẩu';
            $email->subject(config('app.name').' '.'đổi mật khẩu');
            $email->to($forgetPassword->email);
        });
        return redirect()->back()->with('success','Mail đã được gửi thành công bạn vui lòng kiểm tra mail của mình để thực hiện bước tiếp theo');
    }

    public function resetPassword(Request $request)
    {
        $token = $request->token;
        if(ForgetPassword::where('token', $token )->exists()) {
            return view('auth.reset', [
                'token' => $token,
            ]);
        }
        return redirect()->back();
    }

    public function processResetPassword(ProcessResetPasswordRequest $request)
    {
        $token = $request->token;
        $email = ForgetPassword::query()->where('token', $token)->pluck('email')->toArray();
        $password = $request->password;
        $admin = Admin::query()
            ->where('email', $email)
            ->update([
                'password' => Hash::make($password),
            ]);

        ForgetPassword::query()->where('token', $token)->delete();

        return $this->logout()->with('success', 'Bạn đã đổi mật khẩu thành công bây giờ hãy đăng nhập lại');
    }
}
