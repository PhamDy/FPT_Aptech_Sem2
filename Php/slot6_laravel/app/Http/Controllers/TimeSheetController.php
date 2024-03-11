<?php

namespace App\Http\Controllers;

use App\Models\TimeSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TimeSheetController extends Controller
{
    public function attdendanceMorning(Request $request)
    {
        $employee_id = Session::get('employee_id');
        $timeSheet = new TimeSheet();
        $timeSheet->employee_id = $employee_id;
    }



}
