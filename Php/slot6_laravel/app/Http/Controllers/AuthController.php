<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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
            $employee = Employee::where('username', $username)->first();
            if ($employee && $employee->password === $password) {
                Session::put('employee_id', $employee->id);
                return redirect()->to('/attendance');
            } else {
                $title = 'Tên đăng nhập hoặc mật khẩu không đúng';
                return view('login')->with('title', $title);
            }
        }
    }





}
