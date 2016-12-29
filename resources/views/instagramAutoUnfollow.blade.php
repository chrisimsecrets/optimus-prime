@extends('layouts.app')
@section('title','Auto Unfollow')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Auto Unfollow</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="form-group">
                            <button id="unfollow" class="btn btn-primary">Unfollow self following</button>
                        </div>
                        <div id="message" class="form-group">

                        </div>




                    </div>


                </div>


            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')
<script>
    $('#unfollow').click(function () {
        $('#message').html("Please wait It will take time , It depends on following numbers .....");
        $.ajax({
           type:'POST',
            url:'{{url('/instagram/unfollowall')}}',
            data:{},
            success:function (data) {
                $('#message').html(data);
            },
            error:function (data) {
                $('#message').html("Something went wrong , Please check console message");
                console.log(data.responseText);
            }
        });
    })
</script>
@endsection





