@extends('layouts.app')
@section('title','Mass Message Send')
@section('content')
    <div class="wrapper" xmlns="http://www.w3.org/1999/html">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="col-md-6">

<div id="masssend"></div>
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <div class="widget-user-image">
                                <img class="img-circle"
                                     src="{{$picture}}"
                                     alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{$name}}</h3>
                            <h5 class="widget-user-desc">{{$category}}</h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li>

                                    <div style="padding: 10px" class="form-group">
                                        <textarea class="form-control" id="message" rows="3"></textarea>
                                        <input type="hidden" id="pageId" value="{{$pageId}}"><br>

                                        <button class="btn btn-default" id="sendMsg"><i class="fa fa-send"></i> Send
                                            Message
                                        </button>
                                        <br><br>
                                        <p>
                                            *You can send only who already made conversation with this page
                                        </p>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div id="box">

                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#sendMsg').click(function () {
            $('#box').html("Please wait . Optimus sending message to all available conversations");
           $.ajax({
               type:'POST',
               url:'{{url('/massreplay')}}',
               data:{
                   'pageId':$('#pageId').val(),
                   'message':$('#message').val()
               },
               success:function (data) {
                   $('#box').html(data);
               }
           }) ;
        });
    </script>
@endsection