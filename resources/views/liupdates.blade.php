@extends('layouts.app')

@section('title','Linkedin Updates')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div id="liUpdates"></div>



            </section><!-- /.content -->

        </div>
        @include('components.footer')
    </div>

@endsection

@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection
