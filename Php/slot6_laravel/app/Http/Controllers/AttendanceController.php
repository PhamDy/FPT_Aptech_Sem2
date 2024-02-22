<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class AttendanceController extends Controller
{
    public function showAttendance()
    {
        return view('attendance');
    }

    public function showDashboard()
    {
        $employees = Employee::all();
        return view('dashboard', ['employees' => $employees]);
    }

}
