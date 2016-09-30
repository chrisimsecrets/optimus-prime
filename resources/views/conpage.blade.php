@extends('layouts.app')
@section('title','Facebook')
@section('content')
    <div class="wrapper" xmlns="http://www.w3.org/1999/html">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black">
                            <div class="widget-user-image">
                                <img class="img-circle" src="{{$data['picture']['data']['url']}}" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{$data['name']}}</h3>
                            <h5 class="widget-user-desc">Page Id : {{$data['id']}}</h5>
                        </div>
                        <div class="box-footer no-padding">
                            {{-- start--}}
                            @if(isset($data['conversations']))
                                @foreach($data['conversations']['data'] as $con)
                                    <div class="col-md-6">
                                        <!-- USERS LIST -->

                                        <div class="box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Participants</h3>

                                                <div class="box-tools pull-right">
                                                    <span class="label label-success">{{$con['message_count']}}
                                                        Messages</span>
                                                    <button type="button" class="btn btn-box-tool"
                                                            data-widget="collapse"><i
                                                                class="fa fa-minus"></i>
                                                    </button>

                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body no-padding" style="display: block;">
                                                <ul class="users-list clearfix">
                                                    @foreach($con['participants']['data'] as $par)
                                                        <li>
                                                            <img src="@if(isset($par['picture']['data']['url'])) {{($par['picture']['data']['url'])}}@else {{url('/images/optimus/social/fb.png')}} @endif"
                                                                 alt="User Image">
                                                            <a class="users-list-name" href="http://facebook.com/{{$par['id']}}">{{$par['name']}}</a>

                                                        </li>


                                                    @endforeach


                                                </ul>
                                                <!-- /.users-list -->
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center" style="display: block;">
                                                <a href="{{url('/conversations/')}}/{{$data['id']}}/{{$con['id']}}" class="uppercase"><i class="fa fa-comments"></i> Start conversation</a>
                                            </div>
                                            <!-- /.box-footer -->
                                        </div>

                                        <!--/.box -->
                                    </div>
                                @endforeach
                            @else
                            <h1 align="center">No conversation found</h1>
                            @endif
                            {{--end--}}
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>

            </section>
        </div>
    </div>
@endsection