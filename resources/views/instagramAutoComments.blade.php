@extends('layouts.app')
@section('title','Instagram | Auto Comments')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Auto Comment</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="form-group">
                            <select id="type">
                                <option value="home">Home Feed</option>
                                <option value="popular">Popular Feed</option>
                                <option value="self">Self Timeline</option>
                                <option value="hashtag">Hashtag Feed</option>
                            </select>
                        </div>
                        <div id="message" class="form-group">

                        </div>
                        <div style="display: none" id="tagDiv" class="form-group">
                            <label for="tag">Tag name</label>
                            <input type="text" class="form-control" id="tag" placeholder="Tag name here ">
                        </div>

                        <div class="form-group">
                            <label for="content">Comment</label>
                            <input type="text" class="form-control" id="comment" placeholder="Type here ...">
                        </div>
                        <div class="form-group">
                            <div id="message"></div>
                        </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="button" id="btnComment" class="btn btn-primary">Submit comment</button>
                    </div>

                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')
<script>
    $('#type').on('change',function () {
        if($(this).val() == "hashtag"){
            $('#tagDiv').show(500);
        }else{
            $('#tagDiv').hide(500);
        }
    });
    $('#btnComment').click(function () {
        $('#message').html("Please wait . trying to make comments . It will take time based on content");
        $.ajax({
           type:'POST',
            url:'{{url('/instagram/auto/comment')}}',
            data:{
                'type':$('#type').val(),
                'comment':$('#comment').val(),
                'tag':$('#tag').val()
            },success:function (data) {
                $('#message').html(data);
                $.toast("Done !");
            },error:function (data) {
                $('#message').html("Something went wrong , Please check console message");
                console.log(data.responseText);
            }
        });
    })
</script>
@endsection





