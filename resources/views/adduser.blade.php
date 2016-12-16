@extends('layouts.app')
@section('title','Add new user | Optimus')

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
                                <h3 class="box-title"><i class="fa fa-user-plus"></i> Add User</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email"
                                           placeholder="User's Email" type="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control"  id="name"
                                           placeholder="User's Name" type="text">
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
                                            <input id="fb" type="checkbox">
                                            <i class="fa fa-facebook"></i> Facebook
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input id="tw" type="checkbox">
                                            <i class="fa fa-twitter"></i> Twitter
                                        </label>
                                    </div><div class="checkbox">
                                        <label>
                                            <input id="tu" type="checkbox">
                                            <i class="fa fa-tumblr"></i> Tumblr
                                        </label>
                                    </div><div class="checkbox">
                                        <label>
                                            <input id="wp" type="checkbox">
                                            <i class="fa fa-wordpress"></i> Wordpress
                                        </label>
                                    </div><div class="checkbox">
                                        <label>
                                            <input id="ln" type="checkbox">
                                            <i class="fa fa-linkedin"></i> Linkedin
                                        </label>
                                    </div><div class="checkbox">
                                        <label>
                                            <input id="in" type="checkbox">
                                            <i class="fa fa-instagram"></i> Instagram
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input id="fbBot" type="checkbox">
                                            <i class="fa fa-comment"></i> Facebook Messenger Bot
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input id="slackBot" type="checkbox">
                                            <i class="fa fa-slack"></i> Slack Bot
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input id="contacts" type="checkbox">
                                            <i class="fa fa-list-alt"></i> Contacts
                                        </label>
                                    </div>

                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="save" class="btn btn-primary">Add user</button>
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

        var fb="no",tw="no",tu="no",wp="no",ln="no",ins="no",fbBot="no",slackBot = "no",contacts = "no";
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
        if($('#contacts').is(':checked')){
            contacts = "yes";
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

        $('#contacts').on('chnage',function () {
            if(this.checked){
                contacts = "yes";
            }else{
                contacts = "no";
            }
        });


        $('#save').click(function () {
            $.ajax({
                type:'POST',
                url:'{{url('/user/add')}}',
                data:{
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
                    'slackBot':slackBot,
                    'contacts':contacts

                },
                success:function (data) {
                    if(data=='success'){
                        swal('Success','User added','success');
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