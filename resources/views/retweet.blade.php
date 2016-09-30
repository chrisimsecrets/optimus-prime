@extends('layouts.app')
@section('title','Retweet')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div align="center" class="row">
                    <button id="retweet" class="btn btn-success btn-lg"><i class="fa fa-retweet"></i> Retweet all tweet where you are mentioned</button>

                </div>
                <div style="padding-left:10px" class="row">
                    <div class="panel-body">
                    <div id="result"></div>
                        </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('#retweet').click(function () {
        $(this).html("Please wait .....");
        $.ajax({
           type:'POST',
            url:'{{url('/twitter/autoretweet')}}',
            data:{},
            success:function (data) {
                $('#result').html(data);
                $('#retweet').html('<i class="fa fa-retweet"></i> Retweet all tweet where you are mentioned');
            }
        });
    })
</script>
@endsection