@extends('layouts.app')
@section('title',"Skype")
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div id="skypechat"></div>
                    <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow">
                                <div class="widget-user-image">
                                    <img class="img-circle"
                                         src="@if(isset($profile[0]['avatarUrl'])){{$profile[0]['avatarUrl']}}@else {{url('/images/optimus/social/logopadding.png ')}}@endif"
                                         alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">{{$profile[0]['firstname']}} {{$profile[0]['lastname']}}</h3>
                                <h5 class="widget-user-desc">{{$profile[0]['mood']}}</h5>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">City <span
                                                    class="pull-right badge bg-blue">{{$profile[0]['city']}}</span></a>
                                    </li>
                                    <li><a href="#">Country <span
                                                    class="pull-right badge bg-aqua">{{$profile[0]['country']}}</span></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <div class="col-md-6">
                        <!-- DIRECT CHAT -->
                        <div class="box box-warning direct-chat direct-chat-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Direct Chat</h3>

                                <div class="box-tools pull-right">

                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- Conversations are loaded here -->
                                <div id="chatbox" class="direct-chat-messages">
                                    <!-- Message. Default to the left -->

                                    {{-- msg will show here --}}
                                    @if(isset($messages['messages']))
                                        @foreach(array_reverse($messages['messages']) as $no => $message)

                                            <div class="direct-chat-msg @if($userId != \App\Http\Controllers\Prappo::getSkypeName($message['from'])) right @endif">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-left">{{\App\Http\Controllers\Prappo::getSkypeName($message['from'])}}</span>
                                                    <span class="direct-chat-timestamp pull-right">{{\App\Http\Controllers\Prappo::date($message['composetime'])}}</span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <img class="direct-chat-img"
                                                     src="{{\App\Http\Controllers\Prappo::getSkypeImg(\App\Http\Controllers\Prappo::getSkypeName($message['from']))}}"
                                                     alt="message user image"><!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    {!!$message['content'] !!}
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>

                                        @endforeach
                                    @else
                                        No conversation
                                @endif

                                <!-- /.direct-chat-msg -->

                                </div>
                                <!--/.direct-chat-messages-->

                                <!-- Contacts are loaded here -->

                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                                <div class="input-group">
                                    <input type="text" id="message" placeholder="Type Message ..."
                                           class="form-control">
                                    <span class="input-group-btn">
                            <button id="send" type="button" class="btn btn-warning btn-flat">Send</button>
                            <button id="loadMsg" type="button" class="btn btn-warning btn-flat">Load messages</button>
                          </span>
                                </div>

                            </div>
                            <!-- /.box-footer-->
                        </div>
                        <!--/.direct-chat -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var chatbox = $('#chatbox');
            chatbox.animate({ scrollTop: chatbox.prop('scrollHeight')}, 1000);
//            enter press
            $('#message').bind("enterKey", function (e) {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/skypechat')}}',
                    data: {
                        'userId': '{{$userId}}',
                        'message': $('#message').val()
                    },
                    success: function (data) {
                        if(data=='success'){
                            notify('{{url('/images/optimus/social/optskype.png')}}',"Success !","Message sent to {{$userId}}",'#');
                        }

                    }
                });
                $('#message').val("");
                loadMesg();
            });
            $('#message').keyup(function (e) {
                if (e.keyCode == 13) {
                    $(this).trigger("enterKey");
                }
            });

            $('#send').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/skypechat')}}',
                    data: {
                        'userId': '{{$userId}}',
                        'message': $('#message').val()
                    },
                    success: function (data) {

                        alert(data);
                    }
                });

                $('#message').val("");
                loadMesg();
            });

            $('#loadMsg').click(function () {

                $('#loadMsg').html("Wait loading ....");
                $('#chatbox').load('{{url('/skype/chatwith/')}}/{{$userId}}',function () {
                    $('#loadMsg').html("Load Messages");
                    chatbox.animate({ scrollTop: chatbox.prop('scrollHeight')}, 1000);
                });

            })

            function loadMesg() {
                $('#loadMsg').html("Wait loading ....");
                $('#chatbox').load('{{url('/skype/chatwith/')}}/{{$userId}}',function () {
                    $('#loadMsg').html("Load Messages");
                    chatbox.animate({ scrollTop: chatbox.prop('scrollHeight')}, 1000);
                });
            }

            setInterval(loadMesg, 4000);



        });
    </script>
@endsection