@extends('layouts.app')
@section('title','Instagram | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-aqua-active">
                                <h3 class="widget-user-username">{{$datas->data->full_name}}</h3>
                                <h5 class="widget-user-desc">{{$datas->data->bio}}</h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="{{$datas->data->profile_picture}}" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{$datas->data->counts->followed_by}}</h5>
                                            <span class="description-text">Followed by </span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{$datas->data->counts->follows}}</h5>
                                            <span class="description-text">Follows</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">{{$datas->data->username}}</h5>
                                            <span class="description-text">Username</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                </div>
                <div class="row">
                    @foreach($medias->data as $media)
                        <div class="col-md-6">
                            <div class="panel panel-default bootcards-media">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$media->user->username}}</h3>
                                </div>
                                <div class="panel-body">
                                    @if($media->type == "image")
                                        <small class="label pull-right bg-green"><i class="fa fa-image"></i> Image
                                        </small><br>
                                    @endif
                                    @if($media->type == "video")
                                        <small class="label pull-right bg-red"><i class="fa fa-video-camera"></i> Video
                                        </small><br>
                                    @endif
                                    @if(isset($media->caption->text))
                                        <p><h4>{{$media->caption->text}}</h4></p>
                                    @endif
                                </div>
                                @if($media->type == "video")
                                    <video width="100%" controls>
                                        <source src="{{$media->videos->standard_resolution->url}}" type="video/mp4">

                                        Your browser does not support HTML5 video.
                                    </video>
                                @endif
                                @if($media->type == "image")
                                    @if(isset($media->images->standard_resolution))
                                        <img width="100%" src="{{$media->images->standard_resolution->url}}"
                                             class="img-responsive"/>
                                    @endif
                                @endif
                                <div class="panel-footer">
                                    <div class="btn-group btn-group-justified">
                                        <div class="btn-group">
                                            <a href="{{$media->link}}" class="btn btn-default">
                                                <i class="fa fa-link"></i>
                                                Link
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="{{url('/instagram/media')."/".$media->id}}" class="btn btn-default">
                                                <i class="fa fa-heart"></i>
                                                {{$media->likes->count}}
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="{{url('/instagram/media')."/".$media->id}}" class="btn btn-default">
                                                <i class="fa fa-comment"></i>
                                                {{$media->comments->count}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection





