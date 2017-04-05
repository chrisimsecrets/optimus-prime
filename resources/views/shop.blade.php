@extends('layouts.app')
@section('title','Shop | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <h1 align="center"><i class="fa fa-shopping-bag"></i></h1>
                <h4 align="center">Add new <kbd>plugin</kbd> add new <kbd>feature</kbd></h4>
                <p align="center"><kbd>Unlimited features for Optimus Prime</kbd></p>
                {{-- block 1 end--}}
                <div class="shopCase">
                    <h1 align="center">Coming soon....</h1>
                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
