<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ForgetPasswordRequest;
use App\Http\Requests\Customer\LoginRequest;
use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Requests\Customer\ProcessResetPasswordRequest;
use App\Models\Customer;
use App\Models\ForgetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('homepage.auth.register');
    }

    public function registering(RegisterRequest $request)
    {
        $createCustomer = Customer::query()
            ->create([
                'last_name'  => $request->get('last_name'),
                'first_name' => $request->get('first_name'),
                'phone'      => $request->get('phone'),
                'email'      => $request->get('email'),
                'password'   => Hash::make($request->get('password')),
            ]);

        $customer = session()->get('customer');
        $customer = [
            'id'        => $createCustomer->id,
            'full_name' => $createCustomer->full_name,
            'avatar'    => $createCustomer->avatar,
        ];
        session()->put('customer', $customer);

        return redirect()->route('customer.index')->with('success', 'Chào mừng bạn đã đến với thế giới của chúng tôi');
    }

    public function login()
    {
        return view('homepage.auth.login');
    }

    public function loggingIn(LoginRequest $request)
    {
        $password = $request->get('password');
        $customerFind = Customer::query()
            ->where('email', $request->get('email'))
            ->firstOrFail();
        if ( ! Hash::check($password, $customerFind->password)) {
            return redirect()->route('customer.login')->with('error', 'Sai cái gì đó rồi');
        }

        $customer = session()->get('customer');
        $customer = [
            'id'        => $customerFind->id,
            'full_name' => $customerFind->full_name,
            'avatar'    => $customerFind->avatar,
        ];
        session()->put('customer', $customer);

        return redirect()->route('customer.index')->with('success', 'Chào mừng bạn quay trở lại!');
    }

    public function logout()
    {
        if (session()->has('customer')) {
            session()->forget('customer');
        }

        return redirect()->route('customer.login');
    }

    public function forgetPassword()
    {
        return view('homepage.auth.forget');
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
        Mail::send('homepage.auth.mail', compact('forgetPassword'), function ($email) use ($forgetPassword) {
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
            return view('homepage.auth.reset', [
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
        $customer = Customer::query()
            ->where('email', $email)
            ->update([
            'password' => Hash::make($password),
        ]);

        ForgetPassword::query()->where('token', $token)->delete();

        return $this->logout()->with('success', 'Bạn đã đổi mật khẩu thành công bây giờ hãy đăng nhập lại');
    }
}
