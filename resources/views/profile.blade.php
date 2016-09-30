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
                                <h3 class="box-title"><i class="fa fa-user"></i> Profile Settings</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" value="{{ $email }}"
                                           placeholder="Your Email" type="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" value="{{ $name }}" id="name"
                                           placeholder="Your Name" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="oldPass">Old Password</label>
                                    <input class="form-control" value="" id="oldPass"
                                           placeholder="Old Password"
                                           type="password">
                                </div>

                                <div class="form-group">
                                    <label for="newPass">New Password</label>
                                    <input class="form-control" value="" id="newPass"
                                           placeholder="New Password" type="password">
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
    $('#save').click(function () {
        $.ajax({
           type:'POST',
            url:'{{url('/profile')}}',
            data:{
                'name':$('#name').val(),
                'email':$('#email').val(),
                'oldPass':$('#oldPass').val(),
                'newPass':$('#newPass').val()
            },
            success:function (data) {
                if(data=='success'){
                    swal('Success','Profile updated','success');
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