<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUserRequest;
use App\Http\Requests\SignupUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{


    public function loginview()
    {
        return view('login');
    }

    public function signupview()
    {
        return view('signup');
    }
    public function signup(SignupUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = md5($request->password);
        $user->save();
        $request->session()->flash('message', 'Đăng ký tài khoản thành công');

        return redirect()->route('loginview');
    }
    public function updateAccountview(Request $request)
    {
        if ($request->session()->get('user')!=null) {
            $user = $request->session()->get('user');
        } else {
            $email = $request->cookie('email');
            $password = $request->cookie('password');
            $user = User::where('email', $email)->where('password', $password)->first();
        }

        return view('updateAccount', compact('user'));
    }

    public function updateAccount(UpdateUserRequest $request)
    {
        if ($request->session()->get('user') != null) {
            $user = $request->session()->get('user');
        } else {
            $email = $request->cookie('email');
            $password = $request->cookie('password');
            $user = User::where('email', $email)->where('password', $password)->first();
        }
        $user->name = $request->name;
        $user->password = md5($request->password);
        $user->save();
        $request->session()->put('user', $user);
        $request->session()->flash('message', 'Cập nhật tài khoản thành công');

        return redirect()->route('index');
    }

    public function login(FormUserRequest $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($request->email == $user->email && md5($request->password) == $user->password) {
                $request->session()->put('user', $user);
                $remember = $request->remember;
                if ($remember == 1) {
                    Cookie::queue('email', $user->email, 24 * 60 * 30);
                    Cookie::queue('password', $user->password, 24 * 60 * 30);
                }
                return redirect()->route('index');
            }
        }
        $request->session()->flash('message', 'Sai email hoặc mật khẩu');

        return redirect()->route('loginview');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        Cookie::queue(Cookie::forget('email'));
        Cookie::queue(Cookie::forget('password'));

        return redirect()->route('loginview');
    }
}
