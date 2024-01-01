@extends('layouts.app')

@section('content')
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="margin-top: -25px; background-image: url('{{asset('assets/img/header.png')}}');">
                <div class="container">
                    <h1 class="pt-5">
                        Right Now you are the best gamer thank you 👌❤
                    </h1>
                    <a class="btn btn-primary" href="{{route('home')}}"> Return to home
                        
                    </a>
                </div>
            </div>
        </div>
@endsection