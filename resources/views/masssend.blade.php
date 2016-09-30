@extends('layouts.app')
@section('title','Mass Message Send')
@section('content')
    <div class="wrapper" xmlns="http://www.w3.org/1999/html">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    @foreach($data['data'] as $pageNo=>$page)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-black" style="background: url('@if(isset($page['cover'])){{$page['cover']['source']}}@endif') center center;">
                                    <h3 class="widget-user-username">{{$page['name']}}</h3>
                                    <h5 class="widget-user-desc">{{$page['category']}}</h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle" src="{{$page['picture']['data']['url']}}" alt="User Avatar">
                                </div>
                                <div class="box-footer">
                                    <div class="row">

                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">{{$page['fan_count']}}</h5>
                                                <span class="description-text">FANS</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-8 border-right">
                                            <div class="description-block">
                                                <a href="{{url('/masssend/')}}/{{$page['id']}}" class="btn btn-default"><i class="fa fa-send"> Send mass message</i> </a>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>

@endsection