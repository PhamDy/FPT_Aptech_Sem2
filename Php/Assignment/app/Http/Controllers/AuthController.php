<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function checkLogin(Request $request)
    {
        if ($request->isMethod('post')) {
            $username = $request->input("username");
            $password = $request->input("password");
            $employee = Employees::where('username', $username)->first();
            if ($employee && $employee->password === $password) {
                return redirect()->to('/showBooks');
            } else {
                $title = 'Tên đăng nhập hoặc mật khẩu không đúng';
                return view('login')->with('title', $title);
            }
        }
    }
}
