<div id="lang"></div>
@extends('layouts.app')
@section('title','Write')

@section('css')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="{{ elixir('js/custom.js') }}"></script>
    <script src="opt/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="opt/sweetalert.css">

@endsection

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Write post <i class="fa fa-edit"></i></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6"
                             data-step="1"
                             data-intro="Facebook post preview"
                        >
                            <div style="padding: 0 20px 20px;" class="row">
                                {{--<h4>Facebook post preview</h4>--}}
                                {{--<hr>--}}
                                <div class="postPreview">
                                    <div class="postPreview">
                                        <div class="wpost">
                                            <div class="PreviewPoster">
                                                <img src="{{url('/images/optimus/social/logo.png')}}"
                                                     style="vertical-align:top;">
                                                <span class="userFullName">Optimus Prime</span>
                                                <span class="postPreviewDetails">Published by Optimsu Prime</span>

                                                <div class="clear"></div>
                                            </div>
                                            <p class="message"><span class="defaultMessage"></span></p>

                                            <div class="previewPostLink">
                                                <div class="previewLink">
                                                    <img id="imgPreview"
                                                         src="{{url('/images/optimus/placeholder.png')}}">
                                                </div>
                                                <div class="postDetails">
                                                    <p class="name">
                                                        <span class="defaultName"></span>
                                                    </p>
                                                    <p class="description">
                                                        <span class="defaultDescription"></span>
                                                        <span class="defaultDescription"></span>
                                                        <span class="defaultDescription"></span>
                                                        <span class="defaultDescription"></span>
                                                        <span class="defaultDescription"></span>
                                                    </p>
                                                    <p class="caption"><span class="defaultCaption"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-body">
                                {{--@if($l=='yes')--}}

                                {{--<div data-step="1" data-intro="Write your own language by change from dropdown"--}}
                                {{--class="form-group">--}}
                                {{--<input class="iCheck-helper" type="checkbox" id="checkboxId"--}}
                                {{--onclick="javascript:checkboxClickHandler()">--}}
                                {{--Type in <select id="languageDropDown"--}}
                                {{--onchange="javascript:languageChangeHandler()"></select>--}}
                                {{--Press Ctrl+g to change <br><br>--}}
                                {{--</div>--}}
                                {{--@endif--}}
                                <div data-step="2"
                                     data-intro="Title for your post, Title is not available for linkedin, twitter and skype"
                                     class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input id="dataTitle" class="form-control"
                                                   placeholder="Title"
                                                   type="text">
                                        </div>

                                    </div>
                                </div>
                                <div data-step="3"
                                     data-intro="Caption for image, This is available only for image and link post"
                                     class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input id="caption" class="form-control"
                                                   placeholder="Title for image"
                                                   type="text">
                                        </div>

                                    </div>
                                </div>
                                <div id="linkoption" data-step="4"
                                     data-intro="Link that you want to share, This is only available for facebook & linkedin"
                                     class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input id="link" type="text" class="form-control"
                                                   placeholder="Link of content">
                                        </div>

                                    </div>
                                </div>
                                <div id="imgoption" data-step="5"
                                     data-intro="Select your image file that you want to post. Image posting is not available for wordpress and skype"
                                     class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="uploadimage" method="post" enctype="multipart/form-data">
                                                <label>Select Your Image</label><br/>
                                                <input class="" type="file" name="file"
                                                       id="file"/><br>
                                                <input class="btn btn-xs btn-success" type="submit" value="Upload"
                                                       id="imgUploadBtn"/>
                                                <input value="" type="hidden" id="image">
                                                <div id="imgMsg"></div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <div id="desOption" data-step="6"
                                     data-intro="Description of content. Only for link post"
                                     class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input id="description" type="text" class="form-control"
                                                   placeholder="Description of link">
                                        </div>

                                    </div>
                                    <br>
                                </div>


                                <div data-step="7"
                                     data-intro="Select your post type. Image post is not available for wordpress, skype, linkedin. And link post is available only for facebook & linkedin. Maybe later we can add link post feature for others"
                                     class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="r" id="imagetype" value="imagetype">
                                            Image Post
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="r" id="sharetype" value="sharetype">
                                            Link Post ( facebook & linkedin )
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="r" id="texttype" value="texttype"
                                                   checked="checked">
                                            Text Only
                                        </label>
                                    </div>

                                </div>
                                <div data-step="8"
                                     data-intro="Write whatever you want to post. You can use emoji by simply clicking emoji button on top right or pressing tab key"
                                     class="form-group">
                                    <input type="hidden" id="postId">
                                    <textarea class="form-control" rows="4"
                                              id="status"
                                              placeholder="Type your content here"></textarea>
                                </div>


                            </div>
                            <div data-step="9" data-intro="Options available according to your settings"
                                 style="padding-left: 10px" class="form-group">
                                <div class="btn-group btn-group-xs" data-toggle="buttons">

                                    @if(!empty(\App\Http\Controllers\Data::get('fbAppToken')))
                                        <label class="btn btn-primary bg-blue">
                                            <input id="fbCheck" type="checkbox" autocomplete="off"><i
                                                    class="fa fa-facebook"></i>
                                            Facebook page
                                        </label>

                                        <label class="btn btn-primary bg-blue">
                                            <input id="fbgCheck" type="checkbox" autocomplete="off"><i
                                                    class="fa fa-users"></i>
                                            Facebook group
                                        </label>
                                    @endif


                                    @if(!empty(\App\Http\Controllers\Data::get('twTokenSec')))
                                        <label class="btn btn-primary bg-light-blue">
                                            <input id="twCheck" type="checkbox" autocomplete="off"><i
                                                    class="fa fa-twitter"></i>
                                            Twitter
                                        </label>
                                    @endif

                                    @if(!empty(\App\Http\Controllers\Data::get('inPass')))
                                        <label class="btn btn-primary bg-light-blue">
                                            <input id="iCheck" type="checkbox" autocomplete="off"><i
                                                    class="fa fa-instagram"></i>
                                            Instagram
                                        </label>
                                    @endif


                                    @if(!empty(\App\Http\Controllers\Data::get('wpPassword')))
                                        <label class="btn btn-primary bg-blue-gradient">
                                            <input id="wpCheck" type="checkbox" autocomplete="off"><i
                                                    class="fa fa-wordpress"></i>
                                            Wordpress
                                        </label>
                                    @endif

                                    @if(!empty(\App\Http\Controllers\Data::get('tuTokenSec')))
                                        <label class="btn btn-primary bg-gray">
                                            <input id="tuCheck" type="checkbox" autocomplete="off"><i
                                                    class="fa fa-tumblr"></i>
                                            Tumblr
                                        </label>
                                    @endif

                                    @if(!empty(\App\Http\Controllers\Data::get('skypePass')))
                                        <label class="btn btn-primary bg-light-blue">
                                            <input id="skypeCheck" type="checkbox" autocomplete="off"><i
                                                    class="fa fa-skype"></i>
                                            Skype
                                        </label>
                                    @endif

                                    @if(!empty(\App\Http\Controllers\Data::get('liAccessToken')))
                                        <label class="btn btn-primary bg-light-blue-active">
                                            <input id="linkedinCheck" type="checkbox" autocomplete="off"><i
                                                    class="fa fa-linkedin"></i>
                                            Linkedin
                                        </label>
                                    @endif

                                </div>

                            </div>

                            <div style="padding-left: 10px" class="form-group">
                            <span style="display: none" id="fbl" class="label label-default"><i
                                        class="fa fa-facebook"></i> Facebook page selected</span>

                                <span style="display: none" id="fblg" class="label label-default"><i
                                            class="fa fa-users"></i> Facebook group selected</span>
                                <span style="display: none" id="fblpg" class="label label-default"><i
                                            class="fa fa-users"></i> FB all public group selected</span>

                                <span style="display: none" id="twl" class="label label-default"><i
                                            class="fa fa-twitter"></i> Twitter selected</span>

                                <span style="display: none" id="inl" class="label label-default"><i
                                            class="fa fa-instagram"></i> Instagram selected</span>

                                <span style="display: none" id="wpl" class="label label-default"><i
                                            class="fa fa-wordpress"></i> Wordpress selected</span>

                                <span style="display: none" id="tul" class="label label-default"><i
                                            class="fa fa-tumblr"></i> Tumblr selected</span>
                                <span style="display: none" id="skypel" class="label label-default"><i
                                            class="fa fa-skype"></i> Skype selected</span>
                                <span style="display: none" id="linkedinl" class="label label-default"><i
                                            class="fa fa-linkedin"></i> Linkedin selected</span>
                            </div>
                            <div class="form-group" style="padding-left:10px">

                                <div id="tuBlog" style="display: none">
                                    <fieldset class="scheduler-border">
                                        Select Tumblr Blog

                                        @if($tuMsg == "error")
                                            Can't load your Tublr Blogs
                                        @else
                                            <select id="tuBlogName">
                                                @foreach($tuBlogName as $blog)
                                                    <option id="">{{$blog->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-group" style="padding-left:10px">


                                <div id="fbPages" style="display: none;" class="form-group">
                                    <fieldset class="scheduler-border">
                                        Select facebook your page{{ count($fbPages) > 1 ? 's' : null }} list

                                        <select id="fbPages">
                                            @foreach($fbPages as $fb)
                                                <option id="{{$fb->pageId}}"
                                                        value="{{$fb->pageToken}}">{{$fb->pageName}}</option>
                                            @endforeach
                                        </select>


                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-group" style="padding-left:10px">
                                <div id="fbGroupsSection" style="display: none">
                                    <fieldset class="scheduler-border">
                                        Your facebook group{{ count($fbGroups) > 1 ? 's' : null }} list

                                        <select id="fbgroups">
                                            @foreach($fbGroups as $fbg)
                                                <option value="{{$fbg->pageId}}">{{$fbg->pageName}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="form-group" style="padding-left:10px">
                                <div id="liCompanySelection" style="display: none">
                                    <fieldset class="scheduler-border">
                                        Your linkedin {{ count($liCompanies) > 1 ? 'companies' : 'company' }} list

                                        <select id="liCompanies" multiple>
                                            <option value="all" selected>All Companies</option>
                                            @if($liCompanies != "")
                                                @foreach($liCompanies as $liCompany)
                                                    <option value="{{ $liCompany['id'] }}">{{ $liCompany['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            {{--scheduling start--}}


                            {{--scheduling end--}}

                            <div style="padding-left: 10px" class="form-group">
                                <br>
                                <button data-step="10" data-intro="Hit me to give me permission for posting" id="write"
                                        class="btn btn-success"><i class="fa fa-send"></i>
                                    Post
                                </button>

                                <button data-step="11" data-intro="Click here to schedule your post" id="addschedule"
                                class="btn btn-default"><i class="fa fa-calendar"></i> Add
                                to
                                schedule
                                </button>
                            </div>
                            <div id="ss" style="display: none;" class="form-group">
                                <div style="padding-left: 10px">
                                    {{--<select class="form-control" id="type">--}}
                                        {{--<option value="everyMinute">Every Minute</option>--}}
                                        {{--<option value="everyFiveMinutes">Every Five Minutes</option>--}}
                                        {{--<option value="everyTenMinutes">Every Ten Minutes</option>--}}
                                        {{--<option value="everyThirtyMinutes">Every Thirty Minutes</option>--}}
                                        {{--<option value="hourly">Hourly</option>--}}
                                        {{--<option value="daily">Daily</option>--}}
                                        {{--<option value="weekly">Weekly</option>--}}
                                        {{--<option value="monthly">Monthly</option>--}}
                                        {{--<option value="quarterly">Quarterly</option>--}}
                                        {{--<option value="yearly">Yearly</option>--}}
                                        {{--<option value="fridays">Fridays</option>--}}
                                        {{--<option value="saturdays">Saturdays</option>--}}
                                        {{--<option value="sundays">Sundays</option>--}}
                                        {{--<option value="mondays">Mondays</option>--}}
                                        {{--<option value="tuesdays">Tuesdays</option>--}}
                                        {{--<option value="wednesdays">Wednesdays</option>--}}
                                        {{--<option value="thursdays">Thursdays</option>--}}

                                    {{--</select>--}}
                                    <input type="text" id="time">
                                </div>
                                <br>
                                <div style="padding-left: 10px" class="form-group">
                                    <button id="saveschedule" class="btn btn-warning"><i class="fa fa-plus"></i> Add
                                        now
                                    </button>
                                    <button id="sclose" class="btn btn-danger"><i class="fa fa-times"></i> Close
                                    </button>
                                </div>

                            </div>
                            <div style="padding-left: 10px">
                                <div style="display: none;" id="msgBox" class="form-group">
                                    <div class="box box-info">
                                        <div id="returnMsg" class="box-body">
                                            <br>

                                            <span id="fbMsgSu" style="display: none"
                                                  class="label label-success"><i
                                                        class="fa fa-facebook"></i> Successfully wrote on facebook Page</span>

                                            <span id="fbgMsgSu" style="display: none"
                                                  class="label label-success"><i
                                                        class="fa fa-facebook"></i> Successfully wrote on facebook Group</span>

                                            <span id="twMsgSu" style="display: none"
                                                  class="label label-success"><i
                                                        class="fa fa-twitter"></i> Successfully wrote on twitter</span>

                                            <span id="iMsgSu" style="display: none"
                                                  class="label label-success"><i
                                                        class="fa fa-instagram"></i> Successfully Posted on Instagram</span>

                                            <span id="wpMsgSu" style="display: none"
                                                  class="label label-success"><i
                                                        class="fa fa-wordpress"></i> Successfully wrote on wordpress</span>
                                            <span id="skypeMsgSu" style="display: none"
                                                  class="label label-success"><i
                                                        class="fa fa-skype"></i> Successfully sent to skype</span>

                                            <span id="tuMsgSu" style="display: none"
                                                  class="label label-success"><i
                                                        class="fa fa-tumblr"></i> Successfully wrote on tumblr</span>

                                            <span id="liMsgSu" style="display: none"
                                                  class="label label-success"><i
                                                        class="fa fa-linkedin"></i> Successfully wrote on linkedin</span>

                                            <span id="fbMsgEr" style="display: none"
                                                  class="label label-danger"><i
                                                        class="fa fa-facebook"></i> Error occurred while trying to write on facebook page</span>
                                            <span id="fbgMsgEr" style="display: none"
                                                  class="label label-danger"><i
                                                        class="fa fa-facebook"></i> Error occurred while trying to write on facebook group</span>

                                            <span id="twMsgEr" style="display: none"
                                                  class="label label-danger"><i
                                                        class="fa fa-twitter"></i> Error occurred while trying to write on twitter</span>

                                            <span id="iMsgEr" style="display: none"
                                                  class="label label-danger"><i
                                                        class="fa fa-instagram"></i> Error occurred while trying to write on instagram</span>

                                            <span id="wpMsgEr" style="display: none"
                                                  class="label label-danger"><i
                                                        class="fa fa-wordpress"></i> Error occurred while trying to write on wordpress</span>

                                            <span id="skypeMsgEr" style="display: none"
                                                  class="label label-danger"><i
                                                        class="fa fa-skype"></i> Error occurred while trying to send messsage on skype</span>

                                            <span id="tuMsgEr" style="display: none"
                                                  class="label label-danger"><i
                                                        class="fa fa-tumblr"></i> Error occurred while trying to write on tumblr</span>

                                            <span id="liMsgEr" style="display: none"
                                                  class="label label-danger"><i
                                                        class="fa fa-linkedin"></i> Error occurred while trying to write on linkedin</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </section>
        </div>

        @include('components.footer')
    </div>
@endsection
@section('css')

    {{--<style>--}}
    {{--fieldset.scheduler-border {--}}
    {{--border: 1px groove #ddd !important;--}}
    {{--padding: 0 1.4em 1.4em 1.4em !important;--}}
    {{--margin: 0 0 1.5em 0 !important;--}}
    {{---webkit-box-shadow: 0px 0px 0px 0px #000;--}}
    {{--box-shadow: 0px 0px 0px 0px #000;--}}
    {{--}--}}

    {{--legend.scheduler-border {--}}
    {{--font-size: 1.2em !important;--}}
    {{--font-weight: bold !important;--}}
    {{--text-align: left !important;--}}
    {{--width: auto;--}}
    {{--padding: 0 10px;--}}
    {{--border-bottom: none;--}}
    {{--}--}}

    {{--</style>--}}
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            flatpickr("#time", {
                minDate: new Date(), // "today" / "2016-12-20" / 1477673788975
                maxDate: "2017-12-20",
                enableTime: true,

                // create an extra input solely for display purposes
                altInput: true,
                altFormat: "F j, Y h:i K"
            });

            $('#caption').hide(200);
            $('#imgoption').hide(200);
            $('#desOption').hide(200);
            $('#linkoption').hide(200);

            $('#texttype').click(function () {

                $('#caption').hide(200);
                $('#imgoption').hide(200);
                $('#desOption').hide(200);
                $('#linkoption').hide(200);
            })

            $('#imagetype').click(function () {
                $('#imgoption').show(200);

                $('#desOption').hide(200);
                $('#linkoption').hide(200);
                $('#caption').hide(200);
            });

            $('#sharetype').click(function () {

                $('#caption').show(200);
                $('#imgoption').show(200);
                $('#desOption').show(200);
                $('#linkoption').show(200);
            });

            $('#dataTitle').on('input', function (e) {
                if ($('#sharetype').is(':checked')) {
                    if ($('#dataTitle').val().length == 0) {
                        $('.name').html('<span class="defaultName"></span>');
                    }
                    else {
                        $('.name').text($('#dataTitle').val());
                    }
                }


            });


            $('#description').on('input', function (e) {
                if ($('#description').val().length == 0) {
                    $('.description').html('<span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span>');
                }
                else {
                    $('.description').html($('#description').val());
                }

            });


            $('#caption').on('input', function (e) {
                if ($('#caption').val().length == 0) {
                    $('.caption').html('<span class="defaultCaption"></span>');
                }
                else {
                    $('.caption').html($('#caption').val());
                }

            });

            var count = 0;
            setTimeout(
                function () {
                    if (count <= 3) {
                        $('.emojionearea-editor').bind("DOMSubtreeModified", function () {
                            if ($(this).text().length == 0) {
                                $('.message').html('<span class="defaultMessage"></span>');
                            }
                            else {
                                $('.message').html($(this).html());
                            }


                        });
                    }
                    count++;

                }, 1000);


        });
    </script>
@endsection

