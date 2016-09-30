@extends('layouts.app')
@section('title','Mass post on group')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="fbmassgroup"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add new Group</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="groupName">Group Name</label>
                                        <input type="text" class="form-control" id="groupName" placeholder="Type group Name ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="groupId">Group Id</label>
                                        <input type="text" class="form-control" id="groupId" placeholder="Type group Id ...">
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button id="saveFbGroup" class="btn btn-primary">Submit</button>
                                </div>

                        </div>

                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3>Your Public Groups</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tbody><tr>
                                        <th style="width: 10px">#</th>
                                        <th>Group Name</th>
                                        <th>Group Id</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                    @foreach($groups as $group)
                                    <tr>
                                        <td>{{$group->id}}</td>
                                        <td>{{$group->groupName}}</td>
                                        <td>
                                            {{$group->groupId}}
                                        </td>
                                        <td><a href="#"><span class="badge bg-red"><i class="fa fa-times"></i> Delete</span></a></td>
                                    </tr>
                                        @endforeach

                                    </tbody></table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Your content</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">

                                        <textarea class="form-control" id="status" rows="3"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button id="postMassGroup" class="btn btn-warning">Post to all public group</button>
                                        <div id="msg"></div>
                                    </div>
                                </div>

                        </div>

                    </div>

                </div>

            </section>
        </div>
    </div>

@endsection
@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection