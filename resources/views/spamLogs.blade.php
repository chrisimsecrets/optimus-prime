@extends('layouts.app')
@section('title','Spam Logs')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Spam Logs<br>
                        <button id="delAll" class="btn btn-danger btn-xs">Delete all logs</button>
                    </div>

                    <div class="panel-body">

                        <table id="list" class="table">
                            <caption>Spam detected by Spam defender</caption>
                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $log)
                                <tr>

                                    <td>{{$log->id}}</td>
                                    <td>{{$log->content}}</td>
                                    <td><button data-id="{{$log->id}}" class="btn btn-danger btn-xs del"><i class="fa fa-trash"></i> Delete</button> </td>
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
        $('.del').click(function () {

            var id = $(this).attr('data-id');
            $.ajax({
                url: '{{url('/spam')}}' + "/" + id,
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

        $('#delAll').click(function () {
            $.ajax({
                url:'{{url('/spam/deleteall')}}',
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}'
                },
                success:function (data) {
                    if(data=='success'){
                        swal('Success','Deleted !','success');
                        location.reload();
                    }else {
                        swal('Error',data,'error');
                    }
                },
                error:function (data) {
                    swal('Error','Something went wrong, Please check console message','error');
                    console.log(data.responseText);
                }
            })
        })

    </script>
@endsection

