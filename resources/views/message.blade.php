@extends('layouts.app')
@section('title','Message')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">From : <a target="_blank" href="https://facebook.com/{{$data['from']['id']}}">{{$data['from']['name']}}</a>
                        <br>
                        To : <a target="_blank" href="https://facebook.com/{{$data['to']['data'][0]['id']}}">{{$data['to']['data'][0]['name']}}</a>  </h3>

                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <h2>{{$data['message']}}</h2>
                    </div>
                    <!-- /.box-body -->
                </div>



            </section>
        </div>
    </div>
@endsection