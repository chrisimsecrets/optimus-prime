@extends('layouts.app')
@section('title','Auto follow')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Auto follow</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <button id="followBack" class="btn btn-primary">Follow back ( Those who following you )</button>
                            </div>
                            <div id="message" class="form-group">

                            </div>

                            <div class="form-group">
                                <label for="content">Find and follow user by hashtag</label>
                                <input type="text" class="form-control" id="tag" placeholder="Type tag name here without '#'">
                            </div>


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="button" id="search" class="btn btn-primary">Start following</button>
                        </div>

                </div>
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')
<script>
    $('#followBack').click(function () {
        $('#message').html("Please wait . It will take time depending on how many users are following you . Please keep calm");
        $.ajax({
            type:'POST',
            url:'{{url('/instagram/followback')}}',
            data:{},
            success:function (data) {
                $('#message').html(data);
            },
            error:function (data) {
                $('#message').html("Something went wrong please try again later and check the console message");
                console.log(data.responseText);
            }
        });

    });

    $('#search').click(function () {
        $('#message').html("Please wait . It will take time depending on search results . Keep calm ");
        $.ajax({
            type:'POST',
            url:'{{url('/instagram/followbytag')}}',
            data:{
                'tag':$('#tag').val()
            },
            success:function (data) {
                $('#message').html(data);
            },
            error:function (data) {
                $('#message').html("Something went wrong . Please try again later and check the console message");
                console.log(data.responseText);
            }
        })
    })
</script>
@endsection





