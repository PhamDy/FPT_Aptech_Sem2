<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ProductsController;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $message = '';

        if (Gate::allows('permission', $user)) {
            $message = 'Permission granted for Admin or Manager';
            return redirect()->to('/productsView');
        } elseif (Gate::allows('staff-permission', $user)) {
            $message = 'Permission granted for Staff';
            return redirect()->to('/productsCreate');
        } elseif (Gate::allows('user-permission', $user)) {
            $message = 'Permission granted for User';
        } else {
            $message = 'Permission denied';
        }

        return view('user.index', compact('message'));
    }
}
