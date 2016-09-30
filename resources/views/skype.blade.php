@extends('layouts.app')
@section('title','Skype')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div id="skype"></div>
                    <div class="col-md-5">
                        <!-- USERS LIST -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-skype"></i> Skype contacts</h3>

                                <div class="box-tools pull-right">


                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <ul class="users-list clearfix">
                                    @foreach($contacts as $contact)
                                        <li>
                                            <img src="@if(isset($contact['avatar_url'])){{$contact['avatar_url']}}@else {{url('/images/optimus/social/logopadding.png')}} @endif"
                                                 alt="User Image">
                                            <a class="users-list-name"
                                               href="{{url('/skype/user/')}}/{{$contact['id']}}">{{$contact['display_name']}}</a>
                                            <span class="users-list-date">{{$contact['id']}}</span>
                                        </li>

                                    @endforeach


                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </div>
                        <!--/.box -->
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-yellow">
                                    <div class="widget-user-image">
                                        <img class="img-circle"
                                             src="@if(!isset($profile['avatarUrl']) || $profile['avatarUrl'] == ""){{url('/images/optimus/social/logopadding.png')}} @else {{$profile['avatarUrl']}}@endif"
                                             alt="User Avatar">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username">{{$profile['firstname']}} {{$profile['lastname']}}</h3>
                                    <h5 class="widget-user-desc">{{$profile['mood']}}</h5>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Language <span
                                                        class="pull-right badge bg-blue">{{$profile['language']}}</span></a>
                                        </li>
                                        <li><a href="#">Country <span
                                                        class="pull-right badge bg-aqua">{{$profile['country']}}</span></a>
                                        </li>
                                        <li><a href="#">Email <span
                                                        class="pull-right badge bg-green">{{$profile['emails'][0]}}</span></a>
                                        </li>
                                        <li><a href="#">User name <span
                                                        class="pull-right badge bg-red">{{$profile['username']}}</span></a>
                                        </li>
                                        <li><div align="center"> <div class="btn-group">
                                                <button type="button" id="savePhone" class="btn btn-success"><i class="fa fa-phone"></i> Collect phone numbers form contacts</button>


                                            </div>
                                            </div>
                                        </li>
                                        <li><div align="center" id="info"></div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-info">
                                    <div class="widget-user-image">
                                        <img class="img-circle"
                                             src="{{url('/images/optimus/social/logopadding.png')}}"
                                             alt="User Avatar">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username">Mass sender</h3>
                                    <h5 class="widget-user-desc">Send message to your all skype contacts</h5>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li>

                                            <div style="padding: 10px" class="form-group">
                                                <textarea class="form-control" id="message" rows="3"></textarea>
                                                <br>

                                                <button class="btn btn-default pull-right" id="sendMsg"><i
                                                            class="fa fa-send"></i>
                                                    Send
                                                    Message
                                                </button>
                                                <br>
                                                <div id="log"></div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- add new contact
                        --}}
                        <div class="row">
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-green">

                                    <!-- /.widget-user-image -->
                                    <h3>Add new Contact</h3>

                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li>
                                            <br>
                                            <div style="padding: 10px" class="form-group">
                                                <input type="text" placeholder="Contact usrname" class="form-control"
                                                       id="contact">
                                                <textarea placeholder="Rquest message ( Optional )" class="form-control" id="reqMessage" rows="3"></textarea>

                                                <br>
                                                <button class="btn btn-default pull-right" id="sendReq"><i
                                                            class="fa fa-send"></i>
                                                    Send
                                                    Request
                                                </button>

                                            </div>
                                            <br>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
<script>
   $(document).ready(function (data) {
       $('#sendReq').click(function () {
           $.ajax({
              type:'POST',
               url:'{{url('/skype/request')}}',
               data:{
                  'userName':$('#contact').val(),
                   'reqMessage':$('#reqMessage').val()
               },
               success: function (data) {
                   if(data=='success'){
                       swal('Success','Request sent ','success');
                   }
                   else{
                       swal('Error',data,'error');
                   }
               }
           });
       });
      $('#sendMsg').click(function () {
          $(this).html('Please wait .....');
          $.ajax({
              type:'POST',
              url:'{{url('/skype/masssend')}}',
              data:{
                  'message':$('#message').val()
              },
              success:function (data) {
                  $('#log').html(data);
                  $('#sendMsg').html('<i class="fa fa-send"></i> Send Message');
              }
          })
      });

       $('#savePhone').click(function () {
           $('#info').html("Wait...");
           $.ajax({
              type:'POST',
               url:'{{url('/skype/save/phones')}}',
               success:function (data) {
                   $('#info').html(data);
               }
           });
       })
   });
</script>
@endsection
@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection