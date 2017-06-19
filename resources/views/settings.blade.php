@extends('layouts.app')
@section('title','Settings | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                {{-- Select theme--}}
                <div id="themSelector" class="row">
                    <div class="box">

                        <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-paint-brush"></i> Themes</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group" id="themes">
                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/purple.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-purple"
                                                   value="skin-purple"
                                                   @if(Auth::user()->theme == "skin-purple") checked @endif >
                                            Purple
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/purple-light.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-purple-light"
                                                   value="skin-purple-light"
                                                   @if(Auth::user()->theme == "skin-purple-light") checked @endif >
                                            Purple Light
                                        </label>
                                    </div>
                                </div>


                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/blue.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-blue" value="skin-blue"
                                                   @if(Auth::user()->theme == "skin-blue") checked @endif >
                                            Blue
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/blue-light.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-blue-light"
                                                   value="skin-blue-light"
                                                   @if(Auth::user()->theme == "skin-blue-light") checked @endif >
                                            Blue Light
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/green.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-green" value="skin-green"
                                                   @if(Auth::user()->theme == "skin-green") checked @endif >
                                            Green
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/green-light.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-green-light"
                                                   value="skin-green-light"
                                                   @if(Auth::user()->theme == "skin-green-light") checked @endif >
                                            Green Light
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/yellow.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-yellow"
                                                   value="skin-yellow"
                                                   @if(Auth::user()->theme == "skin-yellow") checked @endif >
                                            Yellow
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/yellow-light.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-yellow-light"
                                                   value="skin-yellow-light"
                                                   @if(Auth::user()->theme == "skin-yellow-light") checked @endif >
                                            Yellow Light
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/red.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-red" value="skin-red"
                                                   @if(Auth::user()->theme == "skin-red") checked @endif >
                                            Red
                                        </label>
                                    </div>
                                </div>


                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/red-light.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-red-light"
                                                   value="skin-red-light"
                                                   @if(Auth::user()->theme == "skin-red-light") checked @endif >
                                            Red Light
                                        </label>
                                    </div>
                                </div>


                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/black.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-black" value="skin-black"
                                                   @if(Auth::user()->theme == "skin-black") checked @endif >
                                            Black
                                        </label>
                                    </div>
                                </div>




                                <div class="col-md-1">
                                    <div class="radio">
                                        <img src="{{url('/images/optimus/themes/black-light.png')}}">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="skin-black-light"
                                                   value="skin-black-light"
                                                   @if(Auth::user()->theme == "skin-black-light") checked @endif >
                                            Black Light
                                        </label>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{--tumblr settings--}}
                    @if(\App\Http\Controllers\Data::myPackage('tu'))
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title"><i class="fa fa-tumblr"></i> Tumblr Settings</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="tuConKey">Consumer Key</label>
                                        <input class="form-control" id="tuConKey" value="{{ $tuConKey }}"
                                               placeholder="Your tumblr consumer key" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tuConSec">Consumer Secret</label>
                                        <input class="form-control" value="{{ $tuConSec }}" id="tuConSec"
                                               placeholder="Your tumblr consumer secret" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="tuToken">Token</label>
                                        <input class="form-control" value="{{ $tuToken }}" id="tuToken"
                                               placeholder="Your tumblr token"
                                               type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="tuTokenSec">Token Secret</label>
                                        <input class="form-control" value="{{ $tuTokenSec }}" id="tuTokenSec"
                                               placeholder="Your tumblr token secret" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="tuDefBlog">Default Blog Name</label>
                                        <input disabled class="form-control" value="{{ $tuDefBlog }}" id=""
                                               placeholder="Your tumblr default blog name" type="text">

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
                    @endif
                    {{--Twitter settings--}}
                    @if(\App\Http\Controllers\Data::myPackage('tw'))
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title"><i class="fa fa-twitter"></i> Twitter Settings</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="twConKey">Consumer Key</label>
                                        <input class="form-control" value="{{ $twConKey }}" id="twConKey"
                                               placeholder="Your twitter consumer key" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="twConSec">Consumer Secret</label>
                                        <input class="form-control" value="{{ $twConSec }}" id="twConSec"
                                               placeholder="Your twitter consumer secret" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="twToken">Token</label>
                                        <input class="form-control" value="{{ $twToken }}" id="twToken"
                                               placeholder="Your twitter token"
                                               type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="twTokenSec">Token Secret</label>
                                        <input class="form-control" value="{{ $twTokenSec }}" id="twTokenSec"
                                               placeholder="Your twitter token secret" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="twUser">Username</label>
                                        <input class="form-control" value="{{ $twUser }}" id="twUser"
                                               placeholder="Your twitter username"
                                               type="text">
                                    </div>

                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button id="twSave" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row">
                    {{--Facebook settings--}}
                    @if(\App\Http\Controllers\Data::myPackage('fb'))
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title"><i class="fa fa-facebook"></i> Facebook Settings</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="fbAppId">App ID</label>
                                        <input class="form-control" value="{{ $fbAppId }}" id="fbAppId"
                                               placeholder="Your facebook app id"
                                               type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for=fbAppSec">App Secret</label>
                                        <input class="form-control" value="{{ $fbAppSec }}" id="fbAppSec"
                                               placeholder="Your facebook app secret" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for=fbAppSec">Token</label>
                                        <input class="form-control" value="{{ $fbToken }}" id="fbToken"
                                               placeholder="Your facebook token"
                                               type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="fbPages">Default page</label>
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
                    @endif
                    {{--wordpress settings--}}
                    @if(\App\Http\Controllers\Data::myPackage('wp'))
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title"><i class="fa fa-wordpress"></i> Wordpress Settings</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="wpUrl">Site Url</label>
                                        <input class="form-control" value="{{$wpUrl}}" id="wpUrl"
                                               placeholder="Your wordpress site url"
                                               type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="wpUser">Username</label>
                                        <input class="form-control" id="wpUser" value="{{$wpUser}}"
                                               placeholder="Your wordpress username"
                                               type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="wpPassword">Password</label>
                                        <input class="form-control" value="{{$wpPassword}}" id="wpPassword"
                                               placeholder="Your wordpress password" type="password">
                                    </div>

                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button id="wpSave" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    {{--keyboard settings --}}

                    {{-- linkedin settings--}}
                    @if(\App\Http\Controllers\Data::myPackage('ln'))
                        <div class="col-md-6">
                            <form method="post" action="{{url('/lisave')}}" id="linkedinSettings">
                                <div class="box box-primary">
                                    <div class="box-header with-border" align="center">
                                        <h3 class="box-title"><i class="fa fa-linkedin"></i> Linkedin Settings</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="linkedin_client_id">Client ID</label>
                                            <input class="form-control" type="text"
                                                   value="{{ $liClientId }}" placeholder="Your linkedin client id"
                                                   id="linkedin_client_id">
                                        </div>

                                        <div class="form-group">
                                            <label for="linkedin_client_secret">Client Secret</label>
                                            <input class="form-control"
                                                   value="{{ $liClientSecret }}"
                                                   placeholder="Your linkedin client secret"
                                                   type="text" id="linkedin_client_secret">
                                        </div>

                                        <div class="form-group">
                                            <label for="linkedin_access_token">Access Token</label>
                                            <input class="form-control"
                                                   value="{{ $liAccessToken }}" placeholder="Your linkedin access token"
                                                   type="text" id="linkedin_access_token">

                                            <p class="help-block">
                                                Add the following url to your linked app's <strong>Authorized Redirect
                                                    URLs</strong> <br>
                                                <code>{!! url('/linkedin/callback') !!}</code>
                                            </p>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="{!! $liLoginUrl !!}" class="btn btn-linkedin">Connect with linkedin</a>
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                    {{--instagram settings--}}
                    @if(\App\Http\Controllers\Data::myPackage('in'))
                        <div class="col-md-6">

                            <div class="box box-primary">
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title"><i class="fa fa-instagram"></i> Instagram Settings</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inUser">Username</label>
                                        <input class="form-control" type="text"
                                               value="{{ $inUser }}" placeholder="Your Instagram username"
                                               id="inUser">
                                    </div>

                                    <div class="form-group">
                                        <label for="inPass">Password</label>
                                        <input class="form-control"
                                               value="{{ $inPass }}"
                                               placeholder="Your instagram client secret"
                                               type="password" id="inPass">
                                    </div>


                                </div><!-- /.box-body -->

                                <div class="box-footer">

                                    <button id="inSave" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
            <div class="row">
                {{-- linkedin settings--}}
                @if(\App\Http\Controllers\Data::myPackage('pinterest'))
                    <div class="col-md-6">

                            <div class="box box-primary">
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title"><i class="fa fa-pinterest"></i> Pinterest Settings</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="pinUser">Pinterest Username</label>
                                        <input class="form-control" type="text"
                                               value="{{ $pinUser }}" placeholder="Your Pinterest User name"
                                               id="pinUser">
                                    </div>

                                    <div class="form-group">
                                        <label for="pinPass">Pinterest Password</label>
                                        <input class="form-control"
                                               value="{{ $pinPass }}"
                                               placeholder="Your Pinterest password"
                                               type="password" id="pinPass">
                                    </div>


                                <div class="box-footer">

                                    <button id="pinSave" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')
    <script>
        $('input[name=optionsRadios]').click(function () {
            var theme = $('input[name=optionsRadios]:checked').val();
            $.ajax({
                url: '{{url('/settings/update/theme')}}',
                type: 'POST',
                data: {
                    'theme': theme
                },
                success: function (data) {
                    if (data == 'success') {
                        location.reload();
                    } else {
                        console.log(data);
                    }
                }
            });

        });

        //            alert($('input[name=optionsRadios]:checked').val());

        $('#inSave').click(function () {
            $.ajax({
                url: '{{url('/insave')}}',
                type: 'POST',
                data: {
                    'inUser': $('#inUser').val(),
                    'inPass': $('#inPass').val()
                }, success: function (data) {
                    if (data == 'success') {
                        swal('Success', 'Instagram settings saved', 'success');
                        location.reload();

                    } else {
                        swal('Error', data, 'error');
                    }
                }, error: function (data) {
                    swal('Error', 'Something went wrong , Please check console message', 'error');
                    console.log(data.responseText);
                }
            })
        });

        $('#pinSave').click(function () {
            $.ajax({
                url:'{{url('/pinsave')}}',
                type:'POST',
                data:{
                    'pinUser':$('#pinUser').val(),
                    'pinPass':$('#pinPass').val()
                },
                success:function (data) {
                    if(data=="success"){
                        alert("Saved");
                    }else{
                        alert(data);
                    }
                },
                error:function (data) {
                    alert("Something went wrong, Please check console message");
                    console.log(data.responseText);
                }
            });
        });
    </script>
@endsection
@section('css')
    <style>
        .col-md-1 img {
            width: 60px;
            border-radius: 4px;
            -webkit-box-shadow: 0px 0px 31px 0px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0px 0px 31px 0px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 0px 31px 0px rgba(0, 0, 0, 0.15);
        }
        #themSelector{
            margin: 2px;
        }
    </style>
@endsection

