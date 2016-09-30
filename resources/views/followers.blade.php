@extends('layouts.app')
@section('title','Likes and Followers')

@section('content')
    <div class="wrapper" id="followers">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
            Facebook likes : {{$fbLikes}} <br>
                Twitter followers : {{ $twFollowers }} <br>
                Tumblr Followers : {{ $tuFollowers }}

            </section>
        </div>
        @include('components.footer')
    </div>
@endsection