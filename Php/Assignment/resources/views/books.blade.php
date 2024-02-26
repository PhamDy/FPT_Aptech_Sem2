@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Welcome List Book </h2>
        <div class="mb-5">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by title..." name="search" id="search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="row mt-5">
            @foreach($books as $book)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{$book->img}}" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">{{$book->title}}</h5>
                            <p class="card-text">Publishing year: {{$book->pub_year}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
