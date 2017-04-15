@extends('layouts.app')
@section('title','Facebook')
@section('content')
    <div class="wrapper" xmlns="http://www.w3.org/1999/html">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Conversations of {{$data['name']}} </h3>
                    </div>
                    <div class="box-body">
                        <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Participants</th>
                                <th>Message Counts</th>
                                <th>Action</th>

                            </tr>
                            </thead>

                            <tbody>
                            @if(isset($data['conversations']))
                                @foreach($data['conversations']['data'] as $con)
                                    <tr>
                                        <td>@foreach($con['participants']['data'] as $par)
                                                <a target="_blank"
                                                   href="http://facebook.com/{{$par['id']}}">{{$par['name']}} </a> ,
                                            @endforeach </td>
                                        <td>{{$con['message_count']}}</td>
                                        <td><a target="_blank"
                                               href="{{url('/conversations/')}}/{{$data['id']}}/{{$con['id']}}">Start
                                                Conversation</a></td>


                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                            <tfoot>
                            <tr>
                                <th>Participants</th>
                                <th>Message Counts</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {--End box--}}

                {{--<div class="box box-widget widget-user-2">--}}
                    {{--<!-- Add the bg color to the header using any of the bg-* classes -->--}}
                    {{--<div class="widget-user-header bg-yellow">--}}
                        {{--<div class="widget-user-image">--}}
                            {{--<img class="img-circle" src="{{$data['picture']['data']['url']}}" alt="User Avatar">--}}
                        {{--</div>--}}
                        {{--<!-- /.widget-user-image -->--}}
                        {{--<h3 class="widget-user-username">{{$data['name']}}</h3>--}}
                        {{--<h5 class="widget-user-desc">Page Id : {{$data['id']}}</h5>--}}
                    {{--</div>--}}
                    {{--<div class="box-footer no-padding">--}}
                        {{--<ul class="nav nav-stacked">--}}
                            {{--@if(isset($data['conversations']))--}}
                                {{--@foreach($data['conversations']['data'] as $con)--}}
                                    {{--<li><a href="{{url('/conversations/')}}/{{$data['id']}}/{{$con['id']}}">--}}
                                            {{--Participants--}}
                                            {{--<div class="pull-left">--}}
                                                {{--@foreach($con['participants']['data'] as $par)--}}
                                                    {{--<a class="badge"--}}
                                                       {{--href="http://facebook.com/{{$par['id']}}">{{$par['name']}}</a>--}}
                                                {{--@endforeach--}}
                                            {{--</div>--}}
                                            {{--<span class="pull-right badge bg-blue">{{$con['message_count']}}</span></a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}

                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}


            </section>
        </div>
    </div>
@endsection