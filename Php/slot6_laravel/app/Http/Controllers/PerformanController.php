<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Performances;

class PerformanController extends Controller
{
    public function showPerformance($id)
    {
        $performances = Performances::where('employee_id', $id)->select('score')->get();
        $name = Employee::where('id', $id)->value('username');

        return view('performan', ['performances' => $performances, 'name' => $name]);
    }
}
