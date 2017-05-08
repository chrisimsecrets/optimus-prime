@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{trans('dashboard.Dashboard')}}</h1>
            </section>

            <section data-step="1" data-intro="You will see summary of your sites and posts" class="content">
                <div class="row">
                    {{--Facebook --}}
                    @if(\App\Http\Controllers\Data::myPackage('fb'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-facebook"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{trans('dashboard.page likes')}}</span>
                                    <span id="dFbLikes" class="info-box-number">Loading ..</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    @endif

                    {{-- Tumblr --}}
                    @if(\App\Http\Controllers\Data::myPackage('tu'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-purple"><i class="fa fa-tumblr"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">followers</span>
                                    <span id="dTuFollowers" class="info-box-number">Loading ..</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    @endif
                    {{-- Twitter --}}

                    @if(\App\Http\Controllers\Data::myPackage('tw'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-light-blue"><i class="fa fa-twitter"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">followers</span>
                                    <span id="dTwFollowers" class="info-box-number">Loading ..</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    @endif
                    {{-- Linked --}}
                    @if(\App\Http\Controllers\Data::myPackage('ln'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-light-blue-active"><i class="fa fa-linkedin"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">company followers</span>
                                    <span id="companyFollowers" class="info-box-number">Loading ..</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    @endif
                </div>

                {{-- show how many page or groups exists--}}

                <div class="row">

                    <!-- ./col -->

                {{--<div class="col-lg-3 col-xs-6">--}}
                {{--<!-- small box -->--}}
                {{--<div class="small-box bg-aqua">--}}
                {{--<div class="inner">--}}
                {{--<h3>{{$schedules}}</h3>--}}

                {{--<p>Total Schedules</p>--}}
                {{--</div>--}}
                {{--<div class="icon">--}}
                {{--<i class="fa fa-list"></i>--}}
                {{--</div>--}}

                {{--</div>--}}
                {{--</div>--}}
                <!-- ./col -->


                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-fuchsia">
                            <div class="inner">
                                <h3>{{$logs}}</h3>

                                <p>Total Logs</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bell"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3>{{$tuBlogs}}</h3>

                                <p>Tumblr Blogs</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tumblr"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{$fbPages}}</h3>

                                <p>Facebook Pages</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3>{{$fbGroups}}</h3>

                                <p>Facebook Groups</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    {{-- Linkedin--}}
                    @if(\App\Http\Controllers\Data::myPackage('ln'))
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-light-blue-active">
                                <div class="inner">
                                    <h3 id="liPostedJobs">0</h3>

                                    <p>Posted Jobs</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-linkedin"></i>
                                </div>

                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3 id="liCompanyUpdates">0</h3>

                                    <p>Company Updates</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-linkedin"></i>
                                </div>

                            </div>
                        </div>
                        <!-- ./col -->
                    @endif
                    {{--instagram followers--}}
                    @if(\App\Http\Controllers\Data::myPackage('in'))

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray-active">
                                <div class="inner">
                                    <h3 id="inFollowers">Loading ..</h3>

                                    <p>Instagram Followers</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-instagram"></i>
                                </div>

                            </div>
                        </div>
                        <!-- ./col -->
                        {{-- instagram following --}}
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray-light">
                                <div class="inner">
                                    <h3 id="inFollosing">Loading..</h3>

                                    <p>Instagram Fllowing</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-instagram"></i>
                                </div>

                            </div>
                        </div>
                @endif
                <!-- ./col -->

                </div>

                {{-- show how many posts you have--}}

                <div class="row">
                    <div class="col-sm-2 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-blue"><i class="fa fa-facebook"></i></span>
                            <h2 class="description-header">{{$fbPostCount}}</h2>
                            <span class="description-text">Facebook page Post</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-2 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-black"><i class="fa fa-tumblr"></i></span>
                            <h2 class="description-header">{{$tuPostCount}}</h2>
                            <span class="description-text">Tumblr Posts</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-2 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-black"><i class="fa fa-wordpress"></i></span>
                            <h2 class="description-header">{{$wpPostCount}}</h2>
                            <span class="description-text">Wordpress Count</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-2 col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-red"><i class="fa fa-twitter"></i></span>
                            <h2 class="description-header">{{$twPostCount}}</h2>
                            <span class="description-text">Twitter Posts</span>
                        </div>
                        <!-- /.description-block -->
                    </div>

                    <div class="col-sm-2 col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-yellow"><i class="fa fa-facebook"></i></span>
                            <h2 class="description-header">{{$fbgCount}}</h2>
                            <span class="description-text">Facebook Group Post</span>
                        </div>
                        <!-- /.description-block -->
                    </div>

                    <div class="col-sm-2 col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-green"><i class="fa fa-file"></i></span>
                            <h2 class="description-header">{{$allPost}}</h2>
                            <span class="description-text">All Posts</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
            </section>
        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')
    <script>
        @if(\App\Http\Controllers\Data::myPackage('fb'))
        fbLikes();
        @endif
        @if(\App\Http\Controllers\Data::myPackage('tw'))
        twFollowers();
        @endif
        @if(\App\Http\Controllers\Data::myPackage('tu'))
        tuFollowers();
        @endif
        @if(\App\Http\Controllers\Data::myPackage('ln'))
        liPostedJobs();

        companyFollowers();

        liCompanyUpdates();
        @endif
@if(\App\Http\Controllers\Data::myPackage('in'))
        $.ajax({
            type: 'GET',
            url: '{{url('/instagram/followers/get')}}',
            data: {},
            success: function (data) {
                $('#inFollowers').html(data);
            },
            error: function (data) {
                console.log(data.responseText);
                $('#inFollowers').html('X');
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{url('/instagram/following/get')}}',
            data: {},
            success: function (data) {
                $('#inFollosing').html(data);
            },
            error: function (data) {
                console.log(data.responseText);
                $('#inFollosing').html('X');
            }
        });
        @endif
    </script>
@endsection