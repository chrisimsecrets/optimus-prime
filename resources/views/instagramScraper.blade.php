@extends('layouts.app')
@section('title','Instagram Scraper')
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
                            <div class="col-md-6">
                                <input id="query" placeholder="Type here what you are looking for" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <select id="type" class="form-control">

                                    <option value="tag">Feed by HashTag</option>
                                    <option value="user">User</option>
                                    <option value="location">Location</option>

                                </select>
                            </div>

                            <div class="col-md-2">
                                <button id="search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" align="center" id="wait">
                        <img src="{{url('/images/optimus/social/loader.gif')}}"><br>
                        <h3>Please wait ....</h3>
                    </div>
                    <div id="scraper" class="box-body">

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
$('#search').click(function () {
    $('#wait').show(500);
    $('#scraper').html(" ");
    $.ajax({
       type:'POST',
        url:'{{url('/instagram/scraper')}}',
        data:{
            'type':$('#type').val(),
            'data':$('#query').val()
        },success:function (data) {
            $('#wait').hide(300);
            $('#scraper').html(data);

        },error:function (data) {
            $('#wait').hide(300);
            $('#scraper').html("Something went wrong . Please check the console message");
            console.log(data.responseText);
        }
    });
});
</script>
@endsection
