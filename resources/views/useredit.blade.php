@extends('layouts.app')
@section('title','Profile | Optimus')

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
                                <h3 class="box-title"><i class="fa fa-refresh"></i> Update User</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email"
                                           placeholder="Your Email" value="{{$email}}" type="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control"  id="name"
                                           placeholder="Your Name" value="{{$name}}" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input class="form-control" value="" id="pass"
                                           placeholder="Password" type="password">
                                </div>

                                <hr>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Packages</label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input id="fb" type="checkbox" @if(\App\Http\Controllers\Data::hasPackage($id,'fb')) checked @endif>
                                            <i class="fa fa-facebook"></i> Facebook
                                        </label>
                                    </div>


                                    <div class="checkbox">
                                        <label>
                                            <input id="tw" type="checkbox" @if(\App\Http\Controllers\Data::hasPackage($id,'tw')) checked @endif>
                                            <i class="fa fa-twitter"></i> Twitter
                                        </label>
                                    </div><div class="checkbox">
                                        <label>
                                            <input id="tu" type="checkbox" @if(\App\Http\Controllers\Data::hasPackage($id,'tu')) checked @endif>
                                            <i class="fa fa-tumblr"></i> Tumblr
                                        </label>
                                    </div><div class="checkbox">
                                        <label>
                                            <input id="wp" type="checkbox" @if(\App\Http\Controllers\Data::hasPackage($id,'wp')) checked @endif>
                                            <i class="fa fa-wordpress"></i> Wordpress
                                        </label>
                                    </div><div class="checkbox">
                                        <label>
                                            <input id="ln" type="checkbox" @if(\App\Http\Controllers\Data::hasPackage($id,'ln')) checked @endif>
                                            <i class="fa fa-linkedin"></i> Linkedin
                                        </label>
                                    </div><div class="checkbox">
                                        <label>
                                            <input id="in" type="checkbox" @if(\App\Http\Controllers\Data::hasPackage($id,'in')) checked @endif>
                                            <i class="fa fa-instagram"></i> Instagram
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input id="fbBot" type="checkbox" @if(\App\Http\Controllers\Data::hasPackage($id,'fbBot')) checked @endif>
                                            <i class="fa fa-comment"></i> Facebook Messenger Bot
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input id="slackBot" type="checkbox" @if(\App\Http\Controllers\Data::hasPackage($id,'slackBot')) checked @endif>
                                            <i class="fa fa-slack"></i> Slack Bot
                                        </label>
                                    </div>

                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="save" class="btn btn-primary">Save</button>
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
@section('js')
    <script>
        var fb="no",tw="no",tu="no",wp="no",ln="no",ins="no",fbBot="no",slackBot = "no";
        if($('#fb').is(':checked')){
            fb = 'yes';
        }
        if($('#tw').is(':checked')){
            tw = 'yes';
        }
        if($('#tu').is(':checked')){
            tu = 'yes';
        }
        if($('#wp').is(':checked')){
            wp = 'yes';
        }
        if($('#in').is(':checked')){
            ins = 'yes';
        }
        if($('#ln').is(':checked')){
            ln = 'yes';
        }
        if($('#fbBot').is(':checked')){
            fbBot = 'yes';
        }
        if($('#slackBot').is(':checked')){
            slackBot = 'yes';
        }

//        changing stuff
        $('#fb').on('change',function () {
           if(this.checked){
               fb = 'yes';
           }else{
               fb='no';
           }
        });

        $('#tw').on('change',function () {
            if(this.checked){
                tw = 'yes';
            }else{
                tw='no';
            }
        });

        $('#tu').on('change',function () {
            if(this.checked){
                tu = 'yes';
            }else{
                tu='no';
            }
        });

        $('#ln').on('change',function () {
            if(this.checked){
                ln = 'yes';
            }else{
                ln = 'no';
            }
        });

        $('#in').on('change',function () {
            if(this.checked){
                ins = 'yes';
            }else{
                ins = 'no';
            }
        });

        $('#wp').on('change',function () {
            if(this.checked){
                wp = 'yes';
            }else{
                wp='no';
            }
        });

        $('#fbBot').on('change',function () {
            if(this.checked){
                fbBot = 'yes';
            }else{
                fbBot = 'no';
            }
        });

        $('#slackBot').on('change',function () {
            if(this.checked){
                slackBot = 'yes';
            }else{
                slackBot = 'no';
            }
        });

        $('#save').click(function () {
            $.ajax({
                type:'POST',
                url:'{{url('/user/update')}}',
                data:{
                    'id':'{{$id}}',
                    'name':$('#name').val(),
                    'email':$('#email').val(),
                    'password':$('#pass').val(),
                    'fb':fb,
                    'tw':tw,
                    'tu':tu,
                    'wp':wp,
                    'in':ins,
                    'ln':ln,
                    'fbBot':fbBot,
                    'slackBot':slackBot

                },
                success:function (data) {
                    if(data=='success'){
                        swal('Success','User information updated','success');
                        location.reload();
                    }
                    else{
                        swal('Error',data,'error');
                    }
                },
                error:function (data) {
                    swal('Error',data,'error');
                }
            });
        })
    </script>
@endsection