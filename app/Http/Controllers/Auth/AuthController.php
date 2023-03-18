<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loggingIn(LoginRequest $request)
    {
        $password = $request->get('password');
        try {
            $admin = Admin::query()
                ->where('email', $request->get('email'))
                ->where('password', Hash::check('password',$password))
                ->firstOrFail();

            session()->put('id', $admin->id);
            session()->put('first_name', $admin->first_name);
            session()->put('last_name', $admin->last_name);
            session()->put('role', $admin->role);

            return redirect()->route('orders.index');
        }catch (\Throwable $e){
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        session()->flush(); //không làm gì nên xoá hết luôn

        return redirect()->route('login');
    }
}
