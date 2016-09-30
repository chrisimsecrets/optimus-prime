@extends('layouts.app')
@section('title','Wordpress')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="wppage"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{url('/images/optimus/social/wp.png')}}"
                                     alt="User profile picture">
                                <h3 class="profile-username text-center">{{\App\Http\Controllers\Data::get('wpUrl')}}</h3>


                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <!-- About Me Box -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Total Posts</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <strong> {{\App\Wp::all()->count()}}</strong>

                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#activity" data-toggle="tab">Posts</a></li>
                                {{--<li><a href="#write" data-toggle="tab">Write</a></li>--}}

                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    @foreach($data as $d)
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">{{$d->title}}</h3>

                                            <div class="timeline-body">
                                                {!! $d->content !!}
                                            </div>
                                            <div class="box-footer">
                                                <button class="btn btn-danger btn-xs" data-id="{{$d->postId}}" id="del">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                @endforeach
                                <!-- /.post -->

                                    <!-- Post -->


                                </div><!-- /.tab-pane -->


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
        $('.btn-danger').click(function () {
            var id = $(this).attr('data-id');

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this post!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/wpdel')}}',
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        if (data == 'success') {
                            swal('Success', 'Post deleted', 'success');
                        }
                        else {
                            swal('Error', data, 'error');
                        }
                    }
                })
            });


        })
    </script>
@endsection
