@extends('layouts.app')
@section('title','Add Message Conversation')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                {{--message preview section --}}
                <div class="panel panel-default">
                    <div class="panel-heading">Preview</div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <section class="message">
                                <div class="center">
                                    <div class="grid-message">
                                        <div class="col-message-received">

                                            <div class="message-received">
                                                <p id="msg">What are you dong ?</p>
                                            </div>
                                        </div>
                                        <div class="col-message-sent">
                                            <div class="message-sent">
                                                <p id="ans">Providing customer services</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>


                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Private Message Conversation</div>
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
                                <label for="question" class="col-md-4 control-label">Question </label>
                                <div class="col-md-6">
                                    <input type="text" id="question" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Reply </label>
                                <div class="col-md-6">
                                    <textarea id="answer" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Image Link </label>
                                <div class="col-md-6">
                                    <input type="text" id="image" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="video" class="col-md-4 control-label">Video Link </label>
                                <div class="col-md-6">
                                    <input type="text" id="video" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="audio" class="col-md-4 control-label">Audio Link </label>
                                <div class="col-md-6">
                                    <input type="text" id="audio" class="form-control">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file" class="col-md-4 control-label">File Link </label>
                                <div class="col-md-6">
                                    <input type="text" id="file" class="form-control">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="add" class="btn btn-primary">
                                        <i class="fa fa-btn fa-envelope"></i> Add Conversation
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
        $('#question').on('keyup', function () {
            $('#msg').html($(this).val());
        });

        $('#reply').on('keyup', function () {
            $('#ans').html($(this).val());
        });

        $('#add').click(function () {
            if ($('#question').val().length <= 0) {
                return swal("Attention !", "Please enter comment");
            }
            if ($('#answer').val().length <= 0) {
                return swal("Attention !", "Please enter reply against comment");
            }
            $.ajax({
                type: 'POST',
                url: '{{url('/message')}}',
                data: {
                    'pageId': $('#pageId').val(),
                    'question': $('#question').val(),
                    'answer': $('#answer').val(),
                    'image': $('#image').val(),
                    'video': $('#video').val(),
                    'fileLink': $('#file').val(),
                    'audio': $('#audio').val(),
                    '_token': '{{csrf_token()}}'
                },
                success: function (data) {
                    if (data == 'success') {
                        swal('Success', 'Messag added !', 'success');
                        location.reload();
                    } else {
                        swal('Error', data, 'error');
                        console.log(data);

                    }
                },
                error: function (data) {
                    swal('Error', 'Something went wrong , please check the console message', 'error');
                    console.log(data.responseText);
                }
            });
        })

    </script>
@endsection
