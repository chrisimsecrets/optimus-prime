@extends('layouts.app')
@section('title','Instagram | Following')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- USERS LIST -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Following</h3>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <ul class="users-list clearfix">
                                    @foreach($datas->fullResponse->users as $data)
                                        <li>
                                            <img src="{{$data->profile_pic_url}}" alt="User Image">
                                            <a target="_blank" class="users-list-name" href="https://instagram.com/{{$data->username}}">{{$data->username}}</a>
                                            <span class="users-list-date"><button data-user="{{$data->username}}" data-id="{{$data->pk}}" class="btn btn-default unfollow">Unfollow</button> </span>
                                        </li>

                                    @endforeach


                                </ul>
                                <!-- /.users-list -->
                            </div>

                        </div>
                        <!--/.box -->
                    </div>
                </div>
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')
    <script>
        $('.unfollow').click(function () {
            var id = $(this).attr('data-id');
            var user = $(this).attr('data-user');
            $.toast("Wait .. ");
            $.ajax({
                type:'POST',
                url:'{{url('/instagram/unfollow')}}',
                data:{
                    'userId':id
                },
                success:function (data) {
                    if(data=='success'){
                        $.toast("Done ! Now you are not following "+user);
                    }else{
                        $.toast(data);
                    }
                },
                error:function (data) {
                    swal('Error',"Something went wrong , Please check console message");
                    console.log(data.responseText);
                }

            })
        })
    </script>
@endsection





