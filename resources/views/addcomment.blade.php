@extends('layouts.app')
@section('title','Add comment')
@section('content')
    <div class="container">
        <div class="row">

            {{--Preview--}}
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Preview</div>
                    <div class="panel-body">
                        <div class="comment-content">
                            <div class="cmt-top">

                                <div class="cmt-sec">
                                    <img class="comment-img" src="{{url('/images/fb_user.jpg')}}"/>
                                    <div class="comment"><i id="clsbtn">&nbsp</i>
                                        <div class="namecomment"><a href="#" id="namecomment">Jhon Doe</a> <c id="userComment"> Some comment</c>

                                        </div>
                                        <div class="likereply"><a href="#">Like</a><a href="#">Reply</a><a href="#">Message</a> <a href="#"
                                                                                                           id="thumb"><i
                                                        class="thumbs"><span></span></i> 1</a></div>
                                    </div>
                                    <div class="replycomment"><img class="reply-img"
                                                                   src="{{url('/images/fb_page.png')}}"/>
                                        <div class="comment"><a id="clsbtn"></a><a id="yourPage" href="#" >Your Page</a>
                                           <c id="pageComment"> Some reply</c>
                                            <div class="likereply"><a href="#">Like</a><a href="#">Reply</a><a href="#"
                                                                                                               id="thumb"><i
                                                            class="thumbs"><span></span></i> 2</a></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new reply for comment</div>
                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="pageId" class="col-md-4 control-label">For </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="pageId">
                                        @foreach($pages as $page)
                                            <option value="{{$page->pageId}}">{{$page->pageName}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <label class="control-label"><input type="checkbox" id="specific"> Reply for specific post</label>

                                </div>
                            </div>

                            <div id="postIdDiv" class="form-group">
                                <label for="postId" class="col-md-4 control-label">Post ID </label>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Example : 925072217615350_1036772243112013" id="postId" class="form-control">
                                    <a href="{{url('/facebook')}}" target="_blank">Click here to find your post ID</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="question" class="col-md-4 control-label">Comment </label>
                                <div class="col-md-6">
                                    <input required type="text" id="question" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Reply </label>
                                <div class="col-md-6">
                                    <textarea required id="answer" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div id="linkDiv" class="form-group">
                                <label for="link" class="col-md-4 control-label">Media Link </label>
                                <div class="col-md-6">
                                    <input type="text" id="link" placeholder="Image or Video link" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="link" class="col-md-4 control-label">Reply type </label>
                                <div class="col-md-6">
                                    <select id="type" class="form-control">
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    </select>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="add" class="btn btn-primary">
                                        <i class="fa fa-btn fa-comment"></i> Add comment
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#yourPage').html($('#pageId :selected').text());
        $('#pageId').on('change',function () {
            $('#yourPage').html($('#pageId :selected').text());
        });

        $('#postIdDiv').hide();
        var specified = "no";

        $("#uploadimage").on('submit', (function (e) {
            e.preventDefault();
            $('#imgMsg').html("Please wait ...");
            $.ajax({
                url: "{{url('/iup')}}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data['status'] == 'success') {
                        $('#image').val(data['fileName']);
                        $('#imgMsg').html("Your file uploaded and it's name : " + data['fileName']);
                        swal('Success!', 'Image File succefully uploaded', 'success');
                        $('#imagePreview').attr('src', 'uploads/' + data['fileName']);

                    }
                    else {
                        swal('Error!', data, 'error');
                        $('#imgMsg').html("Something went wrong can't upload image");

                    }
                }
            });
        }));
        $('#add').click(function () {
            if(specified == "yes"){
                if($('#postId').val().length <= 0){
                    return swal("Attention !","Please enter post ID");
                }
            }

            if($('#question').val().length <=0){
                return swal("Attention !","Please enter comment");
            }
            if($('#answer').val().length <= 0){
                return swal("Attention !","Please enter reply against comment");
            }
            $.ajax({
                type: 'POST',
                url: '{{url('/comment')}}',
                data: {
                    '_token':'{{csrf_token()}}',
                    'pageId': $('#pageId').val(),
                    'question': $('#question').val(),
                    'answer': $('#answer').val(),
                    'link': $('#link').val(),
                    'specified':specified,
                    'postId':$('#postId').val(),
                    'type': $('#type').val()
                },
                success: function (data) {
                    if (data == 'success') {
                        swal('Success', 'Reply adeed', 'success');
                    }
                    else {
                        swal('Error', data, 'error');
                    }
                },
                error: function (data) {
                    swal('Error', "Something went wrong please check console message", 'error');
                    console.log(data);
                }
            })
        });
        $('#question').on('keyup',function () {
            $('#userComment').html($(this).val());
        });

        $('#answer').on('keyup',function () {
            $('#pageComment').html($(this).val());
        });

        $("#specific").change(function() {
            if(this.checked) {
                $('#postIdDiv').show(200);
                specified = "yes";
            }else{
                $('#postIdDiv').hide(200);
                specified = "no";
            }
        });

        $('#type').on('change',function () {
           if($(this).val() == 'private'){
               $('#linkDiv').hide(200);
               toastr.info("Remember you can't send image in private reply");
           }else{
               $('#linkDiv').show(200);

           }
        });

    </script>
@endsection
