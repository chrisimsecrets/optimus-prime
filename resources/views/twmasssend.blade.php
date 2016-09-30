@extends('layouts.app')
@section('title','Twitter Mass Message Send')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div data-step="1"
                             data-intro="Write whatever you want to post . You can use emoji by simply clicking emoji button on top right"
                             class="form-group">
                            <input type="hidden" id="postId">
                            <textarea class="form-control" rows="4"
                                      id="status"
                                      placeholder="Type your content here ..."></textarea>
                        </div>
                        <button id="send" class="btn btn-success"><i class="fa fa-rocket"></i> Send Message to All
                            followers
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div id="result" class="col-md-6"></div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('#send').click(function () {
        $('#result').html('<h3 align="center">Please wait .........</h3>');
        $.ajax({
           type:'POST',
            url:'{{url('/twitter/masssend/action')}}',
            data:{
                'text':$('#status').val()
            },
            success:function (data) {
                $('#result').html(data);
            }
        });
    })
</script>
@endsection

