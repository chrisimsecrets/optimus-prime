@extends('layouts.app')
@section('title','Tumblr')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="tumbrl"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="{{$avatar}}"
                                     alt="User profile picture">
                                <h3 class="profile-username text-center">{{$blog}}</h3>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="pull-right">{{ $followers }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Total Posts</b> <a class="pull-right">{{ $totalPosts }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Admin</b> <a class="pull-right">{{ $admin }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Message</b> <a class="pull-right">{{ $message }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Type</b> <a class="pull-right">{{ $type }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Subscribed</b> <a class="pull-right">{{ $subscribed }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Ask</b> <a class="pull-right">{{ $ask }}</a>
                                    </li>


                                </ul>

                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <!-- About Me Box -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Description</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <strong><i class="fa fa-book margin-r-5"></i>{{$description}}</strong>

                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#dashboard" data-toggle="tab">Dashboard</a></li>
                                <li><a href="#activity" data-toggle="tab">My Activity</a></li>

                            </ul>
                            {{--My content start--}}
                            <div class="tab-content">
                                <div class="active tab-pane" id="dashboard">
                                    <!-- Post -->
                                    @foreach($dashboard->posts as $fieldNo => $field)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="{{url('/images/optimus/social/tumblr.png')}}"
                                                     alt="user image">
                                                <span class='username'>
                                                  <a href="{{ $field->post_url }}"
                                                     target="_blank">{{$field->blog_name}}</a>
                                                  <div data-id="{{$field->id}}" data-value="{{$field->blog_name}}"
                                                       data-key="{{$field->reblog_key}}" class="optimustudel"><a
                                                              class='pull-right btn-box-tool'><i
                                                                  class='fa fa-times'></i></a></div>

                                                    <a target="_top" onclick="window.open('https://plus.google.com/share?url={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"   href="https://plus.google.com/share?url={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-google-plus'></i></a>
                                                        <a target="_top" onclick="window.open('https://www.linkedin.com/cws/share?url={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.linkedin.com/cws/share?url={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-linkedin'></i></a>
                                                        <a target="_top" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.facebook.com/sharer/sharer.php?u={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-facebook'></i></a>
                                                        <a target="_top" onclick="window.open('http://www.reddit.com/submit?url={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://www.reddit.com/submit?url={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-reddit'></i></a>
                                                        <a target="_top" onclick="window.open('http://pinterest.com/pin/create/link/?url={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://pinterest.com/pin/create/link/?url={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-pinterest-p'></i></a>
                                                </span>
                                                <span class='description'>{{$field->date}} &nbsp; <a target="_blank" class="label label-default " href="{{$field->post_url}}">Link</a> &nbsp; <a data-name="{{$field->blog_name}}" data-id="{{$field->id}}" data-key="{{$field->reblog_key}}"  class="label label-info reblog"><i class="fa fa-retweet"></i> Reblog</a> &nbsp;<a class="label label-warning tufollow"> Follow</a>  </span>

                                            </div><!-- /.user-block -->
                                            <p>@if(isset($field->body)){!! $field->body !!}@endif @if(isset($field->caption)){!! $field->caption !!}@endif
                                                @if(isset($field->photos))
                                                    @foreach($field->photos as $photoNo => $photoSrc)
                                                        <img class="img-responsive"
                                                             src="{{$photoSrc->alt_sizes[2]->url}}">
                                                    @endforeach
                                                @endif
                                            </p>

                                            {{--post bottom start--}}

                                            <div class="row">
                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">

                                                        <h5 class="description-header"><span class="text-green"><i class="fa fa-file"></i></span> Type</h5>
                                                        <span class="description-text">{{$field->type}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-blue"><i class="fa fa-save"></i></span> State</h5>
                                                        <span class="description-text">{{$field->state}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-yellow"><i class="fa fa-cubes"></i></span> Format</h5>
                                                        <span class="description-text">{{$field->format}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-lime"><i class="fa fa-user"></i></span> Post author</h5>
                                                        <span class="description-text">{{$field->blog_name}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-red"><i class="fa fa-thumbs-up"></i></span> Liked</h5>
                                                        <span class="description-text">{{$field->liked}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-green"><i class="fa fa-files-o"></i></span> Note count</h5>
                                                        <span class="description-text">{{$field->note_count}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                            </div>

                                            {{--post bottom end--}}

                                        </div><!-- /.post -->
                                        <!-- /.post -->
                                    @endforeach
                                </div><!-- /.tab-pane -->
                                <div class="tab-pane" id="activity">
                                    <!-- Post -->
                                    @foreach($post->posts as $no => $field)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="{{$avatar}}"
                                                     alt="user image">
                                                <span class='username'>
                                                  <a href="{{ $field->post_url }}"
                                                     target="_blank">{{$field->blog_name}}</a>
                                                  <div data-id="{{$field->id}}" data-value="{{$field->blog_name}}"
                                                       data-key="{{$field->reblog_key}}" class="optimustudel"><a
                                                              class='pull-right btn-box-tool'><i
                                                                  class='fa fa-times'></i></a></div>

                                                    <a target="_top" onclick="window.open('https://plus.google.com/share?url={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"   href="https://plus.google.com/share?url={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-google-plus'></i></a>
                                                        <a target="_top" onclick="window.open('https://www.linkedin.com/cws/share?url={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.linkedin.com/cws/share?url={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-linkedin'></i></a>
                                                        <a target="_top" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.facebook.com/sharer/sharer.php?u={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-facebook'></i></a>
                                                        <a target="_top" onclick="window.open('http://www.reddit.com/submit?url={{$field->post_url}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://www.reddit.com/submit?url={{$field->post_url}}" class='pull-right btn-box-tool'><i class='fa fa-reddit'></i></a>
                                                </span>
                                                <span class='description'>{{$field->date}} &nbsp; <a target="_blank" class="label label-default" href="{{$field->post_url}}">Link</a></span>

                                            </div><!-- /.user-block -->
                                            <p>@if(isset($field->body)){!! $field->body !!}@endif @if(isset($field->caption)){!! $field->caption !!}@endif
                                                @if(isset($field->photos))
                                                    @foreach($field->photos as $photoNo => $photoSrc)
                                                        <img class="img-responsive"
                                                             src="{{$photoSrc->alt_sizes[2]->url}}">
                                                    @endforeach
                                                @endif
                                            </p>

                                            {{--post bottom start--}}

                                            <div class="row">
                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">

                                                        <h5 class="description-header"><span class="text-green"><i class="fa fa-file"></i></span> Type</h5>
                                                        <span class="description-text">{{$field->type}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-blue"><i class="fa fa-save"></i></span> State</h5>
                                                        <span class="description-text">{{$field->state}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-yellow"><i class="fa fa-cubes"></i></span> Format</h5>
                                                        <span class="description-text">{{$field->format}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-lime"><i class="fa fa-user"></i></span> Post author</h5>
                                                        <span class="description-text">@if(isset($field->post_author)){{$field->post_author}}@else Me @endif</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-red"><i class="fa fa-thumbs-up"></i></span> Liked</h5>
                                                        <span class="description-text">{{$field->liked}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-2 col-xs-6">
                                                    <div class="description-block border-right">
                                                        <h5 class="description-header"><span class="text-green"><i class="fa fa-files-o"></i></span> Note count</h5>
                                                        <span class="description-text">{{$field->note_count}}</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                            </div>

                                            {{--post bottom end--}}

                                        </div><!-- /.post -->
                                    @endforeach
                                </div><!-- /.tab-pane -->
                                <!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                            {{--My content End--}}
                            {{-- Dashboard start--}}

                            {{-- Dashboard end--}}
                        </div><!-- /.nav-tabs-custom -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>

        @include('components.footer')
    </div>
@endsection

@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection

