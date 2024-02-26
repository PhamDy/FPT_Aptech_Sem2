@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Login</h2>


        @if (isset($title))
            <div class="alert alert-danger">{{ $title }}</div>
        @endif


        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

    </div>
