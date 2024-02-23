@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Welcome, </h2>
    <p>This is the main page after a successful login.</p>

    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Attendance</h2>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="d-flex justify-content-between">
                    <form method="post" action="">
                        <!-- Nút điểm danh buổi sáng -->
                        <input type="hidden" name="employee_id" value="">
                        <input type="hidden" name="session" value="morning">
                        <button type="submit" class="btn btn-primary mr-3">Attendance morning</button>
                    </form>

                    <form method="post" action="">
                        <!-- Nút điểm danh buổi chiều -->
                        <input type="hidden" name="employee_id" value="">
                        <input type="hidden" name="session" value="afternoon">
                        <button type="submit" class="btn btn-success">Attendance afternoon</button>
                    </form>

                    <a href="{{ route('dashboard') }}" class="btn btn-info btn-sm">Dashboard</a>

                </div>
            </div>
        </div>
    </div>
