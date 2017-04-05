@extends('layouts.app')
@section('title','Short code List')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Shortcode List</div>

                    <div class="panel-body">

                        <table id="list" class="table">
                            <caption>Available Shortcodes</caption>
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Code</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span class="label label-default">System</span></td>
                                <td><kbd>&#123;&#123;sender&#125;&#125;</kbd></td>
                                <td>Sender name who belongs to the messages or comments</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><span class="label label-default">System</span></td>
                                <td><kbd>&#123;&#123;page_name&#125;&#125;</kbd></td>
                                <td>Page name belongs to the messages or comments</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><span class="label label-default">System</span></td>
                                <td><kbd>&#123;&#123;message&#125;&#125;</kbd></td>
                                <td>Message or Comment of sender</td>
                                <td></td>
                            </tr>
                            @foreach($datas as $data)

                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td><kbd>{{$data->code}}</kbd></td>
                                    <td>{{$data->value}}</td>
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
               type:'DELETE',
                url:'{{url('/code')}}'+"/"+id,
                data:{
                    '_token':'{{csrf_token()}}'
                },
                success:function (data) {
                    if(data=='success'){
                        swal('Success','Deleted','success');
                        location.reload();
                    }else{
                        swal('Error',data,'error');
                    }
                },
                error:function (data) {
                    swal('Error','Something went wrong check console log','error');
                    console.log(data.responseText);
                }
            });
        })

    </script>
@endsection

