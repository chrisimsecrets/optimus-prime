@extends('layouts.app')
@section('title','Reply')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Reply all tweet / who mentioned you in their tweet</h3>
                        <div class="form-group">
                    <textarea class="form-control" rows="4"
                              id="status"
                              data-step="1"
                              data-intro="Type message whatever you want to send"
                              placeholder="Type your content here ..."></textarea>
                        </div>
                        <div class="form-group">
                            <button id="reply" class="btn btn-success"><i class="fa fa-reply"></i> Reply who mentioned you</button>
                            <button id="replyall" class="btn btn-primary"><i class="fa fa-reply"></i> Reply to all</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="md-col-6">
                        <div id="result">

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#reply').click(function () {
            $(this).html('Please wait .....');
            $.ajax({
                type: 'POST',
                url: '{{url('/twitter/autoreply')}}',
                data: {
                    'text': $('#status').val()
                },
                success: function (data) {
                    $('#result').html(data);
                    $('#reply').html('<i class="fa fa-reply"></i> Mass Reply');
                }

            });
        });

        $('#replyall').click(function () {
            $(this).html('Please wait......');
            $.ajax({
               type:'POST',
                url:'{{url('/twitter/autoreplyall')}}',
                data:{
                    'text':$('#status').val()
                },
                success:function (data) {
                    $('#result').html(data);
                    $('#replyall').html('<i class="fa fa-reply"></i> Reply to all');
                }
            });
        })
    </script>
@endsection