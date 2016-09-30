@extends('layouts.app')
@section('title','Twitter')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{$me[0]->user->profile_image_url}}" alt="User profile picture">
                                <h3 class="profile-username text-center">{{$me[0]->user->name}}</h3>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="pull-right">{{ $me[0]->user->followers_count }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="pull-right">{{ $me[0]->user->friends_count }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Favourites</b> <a class="pull-right">{{ $me[0]->user->favourites_count }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Statuses</b> <a class="pull-right">{{ $me[0]->user->statuses_count }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Listed</b> <a class="pull-right">{{ $me[0]->user->listed_count }}</a>
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
                                <strong><i class="fa fa-book margin-r-5"></i>{{$me[0]->user->description}}</strong>

                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#activity" data-toggle="tab">Home</a></li>
                                <li><a href="#replies" data-toggle="tab">Tweets & replies</a></li>
                                <li><a href="#me" data-toggle="tab">Tweets</a></li>


                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    @foreach($tw as $t=>$fields)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                     src="{{$fields->user->profile_image_url}}" alt="user image">
                                                <span class='username'>
                          <a target="_blank" href="http://twitter.com/{{$fields->user->screen_name}}">{{$fields->user->name}}</a>

                                                    <div class="btn-group pull-right" role="group" aria-label="...">
                                                    <a data-user="{{$fields->user->screen_name}}"
                                                       class='optmsg btn-xs btn btn-success'><i
                                                                class='fa fa-envelope'></i> Send Message</a>
                            <a data-id="{{$fields->id}}" class='optretweet btn-xs btn btn-primary'><i
                                        class='fa fa-retweet'></i> Retweet</a>
                                                        <a data-id="{{$fields->id}}" data-user="{{$fields->user->screen_name}}" class='optreply btn-xs btn btn-warning'><i
                                                                    class='fa fa-reply'></i> Reply</a>
                                                        </div>
                                                    <a target="_top" onclick="window.open('https://plus.google.com/share?url=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}', 'newwindow', 'width=500, height=300'); return false;"   href="https://plus.google.com/share?url=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}" class='pull-right btn-box-tool'><i class='fa fa-google-plus'></i></a>
                                                <a target="_top" onclick="window.open('https://www.linkedin.com/cws/share?url=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.linkedin.com/cws/share?url=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}" class='pull-right btn-box-tool'><i class='fa fa-linkedin'></i></a>
                                                <a target="_top" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.facebook.com/sharer/sharer.php?u=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}" class='pull-right btn-box-tool'><i class='fa fa-facebook'></i></a>
                                                <a target="_top" onclick="window.open('http://www.reddit.com/submit?url=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://www.reddit.com/submit?url=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}" class='pull-right btn-box-tool'><i class='fa fa-reddit'></i></a>
                                                <a target="_top" onclick="window.open('http://pinterest.com/pin/create/link/?url=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://pinterest.com/pin/create/link/?url=https://twitter.com/{{$fields->user->screen_name}}/status/{{$fields->id}}" class='pull-right btn-box-tool'><i class='fa fa-pinterest-p'></i></a>
                        </span>

                                                <span class='description'>{{$fields->user->created_at}}</span>
                                            </div><!-- /.user-block -->
                                            <p>
                                                {{$fields->text}}
                                                <br>

                                            </p>
                                            <div class="row" style="padding-left: 10px"><img
                                                        src="{{url('/images/optimus/social/twlove.gif')}}"> {{ $fields->favorite_count }}
                                                <img
                                                        style="margin-left: 10px" height="20" width="20"
                                                        src="{{url('/images/optimus/social/retweet.png')}}"> {{ $fields->retweet_count }}
                                            </div>

                                            &nbsp;Mentions :
                                            @foreach($fields->entities->user_mentions as $mNo => $mentions)

                                                <a href="http://twitter.com/{{$mentions->screen_name}}" target="_blank"><span
                                                            class="badge bg-aqua">{{$mentions->name}}</span></a>
                                            @endforeach
                                        </div><!-- /.post -->



                                @endforeach
                                <!-- Post -->


                                </div><!-- /.tab-pane -->
                                {{-- my activities start --}}


                                {{--replies start--}}

                                <div class="tab-pane" id="replies">
                                    @foreach($twRep as $no => $obj)
                                        <div class="box box-widget widget-user-2">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header bg-aqua-active">
                                                <div class="widget-user-image">
                                                    <img class="img-circle" src="{{ $obj->user->profile_image_url }}"
                                                         alt="User Avatar">
                                                </div>
                                                <!-- /.widget-user-image -->
                                                <h3 class="widget-user-username">{{ $obj->user->name }}</h3>
                                                <h5 class="widget-user-desc"> {{$obj->user->description}}</h5>
                                            </div>
                                            <div class="box-footer no-padding">
                                                <ul class="nav nav-stacked">
                                                    <li>

                                                        <div class="row">
                                                            <div class="col-sm-3 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">{{ $obj->user->followers_count }}</h5>
                                                                    <span class="description-text">FOLLOWERS</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-2 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">{{ $obj->user->friends_count }}</h5>
                                                                    <span class="description-text">FRIENDS</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->

                                                            <div class="row">
                                                                <div class="col-sm-2 border-right">
                                                                    <div class="description-block">
                                                                        <h5 class="description-header">{{ $obj->user->favourites_count }}</h5>
                                                                        <span class="description-text">FAVOURITES</span>
                                                                    </div>
                                                                    <!-- /.description-block -->
                                                                </div>
                                                                <!-- /.col -->
                                                                <div class="col-sm-2 border-right">
                                                                    <div class="description-block">
                                                                        <h5 class="description-header">{{ $obj->user->statuses_count }}</h5>
                                                                        <span class="description-text">STATUSES</span>
                                                                    </div>
                                                                    <!-- /.description-block -->
                                                                </div>


                                                                <div class="col-sm-2 border-right">
                                                                    <div class="description-block">
                                                                        <h5 class="description-header">{{ $obj->user->listed_count }}</h5>
                                                                        <span class="description-text">LISTED</span>
                                                                    </div>
                                                                    <!-- /.description-block -->
                                                                </div>


                                                            </div>
                                                        </div>

                                                    </li>
                                                    <li>
                                                        <h3><p>{{$obj->text}}</p></h3>
                                                    </li>

                                                    <li>
                                                        <div class="row">
                                                            <img style="padding-left: 10px"
                                                                 src="{{url('/images/optimus/social/twlove.gif')}}"> {{$obj->favorite_count}}
                                                            <img
                                                                    style="margin-left: 10px" height="20" width="20"
                                                                    src="{{url('/images/optimus/social/retweet.png')}}"> {{ $obj->retweet_count }}

                                                            &nbsp; Mentions :
                                                            @foreach($obj->entities->user_mentions as $mNo => $mentions)

                                                                <a href="http://twitter.com/{{$mentions->screen_name}}"
                                                                   target="_blank"><span
                                                                            class="badge bg-aqua">{{$mentions->name}}</span></a>
                                                            @endforeach

                                                        </div>
                                                        <div class="row" style="padding-left: 10px">
                                                            <button data-user="{{$obj->user->screen_name}}" class="btn btn-xs optmsg btn-success"><i class="fa fa-envelope"></i> Send message to {{$obj->user->name}}</button>
                                                            <button data-id="{{$obj->id}}" class="btn btn-xs optretweet btn-primary"><i class="fa fa-retweet"></i> Retweet</button>
                                                            <button data-id="{{$obj->id}}" data-user="{{$obj->user->screen_name}}" class="btn btn-xs optreply btn-warning"><i class="fa fa-reply"></i> Reply</button>
                                                        </div>
                                                        <a target="_top" onclick="window.open('https://plus.google.com/share?url=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"   href="https://plus.google.com/share?url=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}" class='pull-right btn-box-tool'><i class='fa fa-google-plus'></i></a>
                                                        <a target="_top" onclick="window.open('https://www.linkedin.com/cws/share?url=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.linkedin.com/cws/share?url=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}" class='pull-right btn-box-tool'><i class='fa fa-linkedin'></i></a>
                                                        <a target="_top" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.facebook.com/sharer/sharer.php?u=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}" class='pull-right btn-box-tool'><i class='fa fa-facebook'></i></a>
                                                        <a target="_top" onclick="window.open('http://www.reddit.com/submit?url=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://www.reddit.com/submit?url=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}" class='pull-right btn-box-tool'><i class='fa fa-reddit-alien'></i></a>
                                                        <a target="_top" onclick="window.open('http://pinterest.com/pin/create/link/?url=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://pinterest.com/pin/create/link/?url=https://twitter.com/{{$obj->user->screen_name}}/status/{{$obj->id}}" class='pull-right btn-box-tool'><i class='fa fa-pinterest-p'></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{--replies end--}}

                                <div class="tab-pane" id="me">
                                    @foreach($me as $t=>$f)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                     src="{{$f->user->profile_image_url}}" alt="user image">
                                                <span class='username'>
                          <a href="#">{{$f->user->name}}</a>
                          <div data-id="{{$f->id}}" class="optimustwdel"><a class='pull-right btn-box-tool'><i
                                          class='fa fa-times'></i></a></div>
                                                    <a target="_top" onclick="window.open('https://plus.google.com/share?url=https://twitter.com/{{$f->user->screen_name}}/status/{{$f->id}}', 'newwindow', 'width=500, height=300'); return false;"   href="https://plus.google.com/share?url=https://twitter.com/{{$f->user->screen_name}}/status/{{$f->id}}" class='pull-right btn-box-tool'><i class='fa fa-google-plus'></i></a>
                                                        <a target="_top" onclick="window.open('https://www.linkedin.com/cws/share?url=https://twitter.com/{{$f->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.linkedin.com/cws/share?url=https://twitter.com/{{$f->user->screen_name}}/status/{{$f->id}}" class='pull-right btn-box-tool'><i class='fa fa-linkedin'></i></a>
                                                        <a target="_top" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=https://twitter.com/{{$f->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="https://www.facebook.com/sharer/sharer.php?u=https://twitter.com/{{$f->user->screen_name}}/status/{{$f->id}}" class='pull-right btn-box-tool'><i class='fa fa-facebook'></i></a>
                                                        <a target="_top" onclick="window.open('http://www.reddit.com/submit?url=https://twitter.com/{{$f->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://www.reddit.com/submit?url=https://twitter.com/{{$f->user->screen_name}}/status/{{$f->id}}" class='pull-right btn-box-tool'><i class='fa fa-reddit-square'></i></a>
                                                        <a target="_top" onclick="window.open('http://pinterest.com/pin/create/link/?url=https://twitter.com/{{$f->user->screen_name}}/status/{{$obj->id}}', 'newwindow', 'width=500, height=300'); return false;"  href="http://pinterest.com/pin/create/link/?url=https://twitter.com/{{$f->user->screen_name}}/status/{{$f->id}}" class='pull-right btn-box-tool'><i class='fa fa-pinterest-p'></i></a>
                        </span>
                                                <span class='description'>{{$f->user->created_at}}</span>
                                            </div><!-- /.user-block -->
                                            <p>
                                                {{$f->text}}
                                                <br>

                                            </p>
                                            <div class="row" style="padding-left: 10px"><img
                                                        src="{{url('/images/optimus/social/twlove.gif')}}"> {{ $f->favorite_count }}
                                                <img
                                                        style="margin-left: 10px" height="20" width="20"
                                                        src="{{url('/images/optimus/social/retweet.png')}}"> {{ $f->retweet_count }}
                                            </div>

                                            &nbsp; Mentions :
                                            @foreach($f->entities->user_mentions as $mNo => $mentions)

                                                <a href="http://twitter.com/{{$mentions->screen_name}}" target="_blank"><span
                                                            class="badge bg-aqua">{{$mentions->name}}</span></a>
                                            @endforeach
                                        </div><!-- /.post -->
                                    @endforeach
                                </div>

                            {{--my activities end--}}
                            <!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
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
@section('js')
    <script>
        $('.optretweet').click(function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '{{url('/twitter/retweet')}}',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data == 'success') {
                        swal('Success', 'Retweeted ', 'success');
                    }
                    else {
                        swal('Error', data, 'error');
                    }
                }
            });
        });
        $('.optmsg').click(function () {
            var user = $(this).attr('data-user');

            swal({
                title: "Message",
                text: "Write Your message here:",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Write something",
                showLoaderOnConfirm: true,
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                $.ajax({
                    type: 'POST',
                    url: '{{url('/twitter/message')}}',
                    data: {
                        'username':user,
                        'text':inputValue
                    },
                    success:function (data) {
                        if(data=='success'){
                            swal('Success','Message sent','success');
                        }
                        else{
                            swal('Error',data,'error');
                        }
                    }
                });
            });

        });
        $('.optreply').click(function () {
            var user = $(this).attr('data-user');
            var id = $(this).attr('data-id');

            swal({
                title: "Reply",
                text: "Write Your reply here:",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Write something",
                showLoaderOnConfirm: true,
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                $.ajax({
                    type: 'POST',
                    url: '{{url('/twitter/reply')}}',
                    data: {
                        'username':user,
                        'text':inputValue,
                        'id':id
                    },
                    success:function (data) {
                        if(data=='success'){
                            swal('Success','Message sent','success');
                        }
                        else{
                            swal('Error',data,'error');
                        }
                    }
                });
            });
        })
    </script>
@endsection