@extends('layouts.app')
@section('title','Settings | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                                <h3 class="box-title"><i class="fa fa-tumblr"></i> Tumblr configuration</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="tuConKey">Tumblr Consumer Key</label>
                                    <input class="form-control" id="tuConKey" value="{{ $tuConKey }}"
                                           placeholder="Tumblr Consumer Key" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="tuConSec">Tumblr Consumer Secret</label>
                                    <input class="form-control" value="{{ $tuConSec }}" id="tuConSec"
                                           placeholder="Tumblr Consumer Secret" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="tuToken">Tumblr Token</label>
                                    <input class="form-control" value="{{ $tuToken }}" id="tuToken"
                                           placeholder="Tumblr Token"
                                           type="text">
                                </div>

                                <div class="form-group">
                                    <label for="tuTokenSec">Tumblr Token Secret</label>
                                    <input class="form-control" value="{{ $tuTokenSec }}" id="tuTokenSec"
                                           placeholder="Tumblr Token Secret" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="tuDefBlog">Tumblr Defautl Blog name</label>
                                    <input disabled class="form-control" value="{{ $tuDefBlog }}" id=""
                                           placeholder="Tumblr Defautl blog name" type="text">

                                </div>

                                <div class="form-group">
                                    <label for="tuDefBlog">Tumblr Available Blogs</label>
                                    <select id="tuDefBlog">
                                        @foreach($tuBlogs as $blog)
                                            <option>{{ $blog->blogName }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="tuSave" class="btn btn-primary">Save</button>
                                <a id="tuSync" href="{{ url('/tusync') }}" class="btn btn-warning">Sync Now</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                                <h3 class="box-title"><i class="fa fa-twitter"></i> Twitter configuration</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="twConKey">Twitter Consumer Key</label>
                                    <input class="form-control" value="{{ $twConKey }}" id="twConKey"
                                           placeholder="Twitter Consumer Key" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="twConSec">Twitter Consumer Secret</label>
                                    <input class="form-control" value="{{ $twConSec }}" id="twConSec"
                                           placeholder="Twitter Consumer Secret" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="twToken">Twitter Token</label>
                                    <input class="form-control" value="{{ $twToken }}" id="twToken"
                                           placeholder="Twitter Token"
                                           type="text">
                                </div>

                                <div class="form-group">
                                    <label for="twTokenSec">Twitter Token Secret</label>
                                    <input class="form-control" value="{{ $twTokenSec }}" id="twTokenSec"
                                           placeholder="Twitter Token Secret" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="twUser">Twitter User Name</label>
                                    <input class="form-control" value="{{ $twUser }}" id="twUser"
                                           placeholder="Twitter User name"
                                           type="text">
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="twSave" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                                <h3 class="box-title"><i class="fa fa-facebook"></i> Facebook configuration</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="fbAppId">Facebook App ID</label>
                                    <input class="form-control" value="{{ $fbAppId }}" id="fbAppId"
                                           placeholder="Facebook App ID"
                                           type="text">
                                </div>
                                <div class="form-group">
                                    <label for=fbAppSec">Facebook App Secret</label>
                                    <input class="form-control" value="{{ $fbAppSec }}" id="fbAppSec"
                                           placeholder="Facebook App Secret" type="text">
                                </div>

                                <div class="form-group">
                                    <label for=fbAppSec">Facebook Token</label>
                                    <input class="form-control" value="{{ $fbToken }}" id="fbToken"
                                           placeholder="Facebook Token"
                                           type="text">
                                </div>

                                <div class="form-group">
                                    <label for="fbPages">Facebook Default page</label>
                                    <select id="fbPages">
                                        @foreach($fbPages as $pages)
                                            <option value="{{ $pages->pageId }}">{{ $pages->pageName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <a href="{{ $loginUrl }}" class="btn btn-facebook">Connect with facebook</a>
                                <button id="fbSettingSave" class="btn btn-primary">Save</button>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                                <h3 class="box-title"><i class="fa fa-wordpress"></i> Wordpress configuration</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="wpUrl">Wordpress Site Url</label>
                                    <input class="form-control" value="{{$wpUrl}}" id="wpUrl"
                                           placeholder="Wordpress Site Url"
                                           type="text">
                                </div>
                                <div class="form-group">
                                    <label for="wpUser">Wordpress Username</label>
                                    <input class="form-control" id="wpUser" value="{{$wpUser}}"
                                           placeholder="Wordpress Username"
                                           type="text">
                                </div>

                                <div class="form-group">
                                    <label for="wpPassword">Wordpress Password</label>
                                    <input class="form-control" value="{{$wpPassword}}" id="wpPassword"
                                           placeholder="Wordpress Password" type="password">
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="wpSave" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{--keyboard settings --}}

                    {{-- skype settings--}}

                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                                <h3 class="box-title"><i class="fa fa-skype"></i> Skype Settings</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="skypeUser">Skype username</label>
                                    <input class="form-control" type="text"
                                           value="{{ \App\Http\Controllers\Data::get('skypeUser') }}" id="skypeUser">
                                </div>
                                <div class="form-group">
                                    <label for="skypePass">Skype password</label>
                                    <input class="form-control"
                                           value="{{ \App\Http\Controllers\Data::get('skypePass') }}"
                                           type="password" id="skypePass">
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="skypeSave" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection