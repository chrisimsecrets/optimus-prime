@extends('layouts.app')
@section('title','Logs')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="slog"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">All scheduled data  <label class="badge">{{\App\OptLog::all()->count()}}</label> </h3>
                        <p><button class="btn btn-danger btn-xs" id="delall">Delete all logs</button></p>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Post ID</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Posted on</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>


                                        <td><a>{{$data->postId}}</a></td>
                                        <td>@if($data->status=='success')<label class="label label-success">Success</label>@else <label class="label label-danger">Failed</label>@endif</td>
                                        <td>{{$data->type}}</td>
                                        <td>{{$data->from}}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td><div data-id="{{$data->id}}" class="logdel"><a class="label label-danger" ><i class="fa fa-times"></i> Delete</a> </div> </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box-footer -->
                </div>

            </section>
        </div>
    </div>
@endsection

@section('js')
    <script>

    </script>
@endsection
@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection
