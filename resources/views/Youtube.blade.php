@extends('layouts.app')
@section('title','YouTube Downloader')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">


                {{--table start--}}
                <div class="box">
                    <div class="box-header">
                        <div align="center" class="row">
                            {{--<form method="post" action="{{url('/youtube/download')}}">--}}
                            <div class="col-md-6">
                                <input name="link" id="link" placeholder="Enter youtube video link" class="form-control">
                            </div>


                            <div class="col-md-2">
                                <button id="download" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
                            </div>
                            {{--</form>--}}
                        </div>
                    </div>

                    <div id="result" class="box-body">
                        {{-- table was here--}}
                    </div>
                    {{--End box--}}

                    {{--table end--}}


                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('#download').click(function () {
        $('#result').html("Please wait...");
        $.ajax({
           type:'POST',
            url:'{{url('/youtube/download')}}',
            data:{
                'link':$('#link').val()
            },
            success:function (data) {
                $('#result').html(data);
            },
            error:function (data) {
                $('#result').html("Something went wrong . Please try again later");
            }
        });
    })
</script>
@endsection
@section('css')


@endsection