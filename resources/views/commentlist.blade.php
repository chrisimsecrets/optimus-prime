@extends('layouts.app')
@section('title','Comments List')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Comment List<br>
                        <a class="btn btn-xs btn-primary" href="{{url('/comment/create')}}"><i class="fa fa-plus"></i>
                            Add new Comment reply</a>
                    </div>

                    <div class="panel-body">

                        <table id="list" class="table">
                            <caption>Available reply list</caption>
                            <thead>
                            <tr>

                                <th>Question</th>
                                <th>Reply</th>
                                <th>Media</th>
                                <th>Specified</th>
                                <th>Specified Post</th>
                                <th>Type</th>
                                <th>For</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>

                                    <td>{{$data->question}}</td>
                                    <td>{{$data->answer}}</td>
                                    <td>
                                        @if($data->link == 'no')
                                            No Media
                                        @else
                                            Yes
                                        @endif
                                    </td>
                                    <td>{{$data->specified}}</td>
                                    <td>{{$data->postId}}</td>
                                    <td>{{$data->type}}</td>
                                    <td>{{\App\FacebookPages::where('pageId',$data->pageId)->value('pageName')}}</td>
                                    <td>
                                        <button data-id="{{$data->id}}" class="btn btn-xs btn-danger"><i
                                                    class="fa fa-trash"></i> Delete
                                        </button>
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
@endsection
@section('js')
    <script>

        $('#list').DataTable();
        $('.btn-danger').click(function () {

            var id = $(this).attr('data-id');
            $.ajax({
                url: '{{url('/comment')}}' + "/" + id,
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

    </script>
@endsection

