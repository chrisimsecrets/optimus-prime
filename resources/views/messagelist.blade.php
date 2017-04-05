@extends('layouts.app')
@section('title','Message List')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Message List <br><a class="btn btn-primary btn-xs"
                                                                   href="{{url('/message/create')}}"><i
                                    class="fa fa-plus"></i> Add new Message reply</a></div>

                    <div class="panel-body">

                        <table id="list" class="table">
                            <caption>Available reply message list</caption>
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Question</th>
                                <th>Reply</th>
                                <th>For</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->question}}</td>
                                    <td>{{$data->answer}}<br>
                                        @if($data->image != null)
                                            <image class="comment-img" src="{{$data->image}}">
                                                @endif
                                                @if($data->audio != null)
                                                    <audio controls>

                                                        <source src="{{$data->audio}}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @endif
                                                @if($data->video != null)
                                                    <video width="400" controls>
                                                        <source src="{{$data->video}}" type="video/mp4">

                                                        Your browser does not support HTML5 video.
                                                    </video>
                                        @endif

                                    </td>
                                    <td>{{\App\FacebookPages::where('pageId',$data->pageId)->value('pageName')}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <button data-id="{{$data->id}}" class="btn btn-xs btn-danger"><i
                                                        class="fa fa-trash"></i> Delete
                                            </button>
                                            <button data-id="{{$data->id}}" data-question="{{$data->question}}"
                                                    data-answer="{{$data->answer}}" class="btn edit btn-xs btn-primary">
                                                <i
                                                        class="fa fa-edit"></i> Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Modal--}}
    <div id="editBox" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit message</h4>
                </div>
                <div class="modal-body">
                    {{--Main form --}}
                    <div class="form-horizontal">
                        <input type="hidden" id="messageID">
                        <div class="form-group">
                            <label for="question" class="col-sm-2 control-label">Question</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="question" placeholder="Question">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="answer" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="answer" placeholder="Answer">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                    </button>
                    <button type="button" id="save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('js')
    <script>
        var dataId = "";
        $('#list').DataTable();
        $('.edit').click(function () {
            var q = $(this).attr('data-question');
            var a = $(this).attr('data-answer');
            this.dataId = $(this).attr('data-id');


            $('#question').val(q);
            $('#answer').val(a);
            $('#messageID').val(this.dataId);
            $('#editBox').modal();

        })

        $('.btn-danger').click(function () {

            var id = $(this).attr('data-id');
            $.ajax({
                url: '{{url('/message')}}' + "/" + id,
                type: 'DELETE',

                data: {
                    '_token': '{{csrf_token()}}'
                },
                success: function (data) {
                    if (data == 'success') {
                        swal('Success', 'Deleted', 'success');
                        location.reload();
                    } else {
                        swal('Error', data, 'error');
                    }
                },
                error: function (data) {
                    swal('Error', 'Something went wrong , Check console log', 'error');
                    console.log(data.responseText);
                }
            });
        });

        $('#save').click(function () {

            $.ajax({
                type: 'PUT',
                url: '{{url('/message')}}' + "/" + $('#messageID').val(),
                data: {
                    'question': $('#question').val(),
                    'answer': $('#answer').val(),
                    '_token': '{{csrf_token()}}'
                },
                success: function (data) {
                    if (data == 'success') {
                        swal('Success', 'Updated', 'success');
                        location.reload();
                    } else {
                        swal('Error', data, 'error');
                    }
                },
                error: function (data) {
                    swal('Error', 'Something went wrong , Please check console log');
                    console.log(data.responseText);
                }
            })
        })

    </script>
@endsection

