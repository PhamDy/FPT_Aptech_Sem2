@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Welcome</h2>
    <p>This is the employee tracking sheet.</p>
    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    <br>
    <table class="table" style="margin-top: 40px">
        <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Check</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->username }}</td>
                <td>{{ $employee->position }}</td>
                <td>
                    <a href="{{ route('performance.show', ['id' => $employee->id]) }}" class="btn btn-success btn-sm" >Performance test</a>
                </td>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
