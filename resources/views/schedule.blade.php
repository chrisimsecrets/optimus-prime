@extends('layouts.app')
@section('title','Schedule List')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="slist"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">All scheduled data</h3> <label class="badge">{{\App\OptSchedul::all()->count()}}</label>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Post ID</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Type</th>
                                    <th><i class="fa fa-facebook"></i></th>
                                    <th><i class="fa fa-users"></i></th>
                                    <th><i class="fa fa-twitter"></i></th>
                                    <th><i class="fa fa-tumblr"></i></th>
                                    <th><i class="fa fa-wordpress"></i></th>
                                    <th><i class="fa fa-skype"></i></th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $d)
                                <tr>


                                        <td><a>{{$d->postId}}</a></td>
                                        <td>{{$d->title}}</td>
                                        <td>{{\App\Http\Controllers\Data::shortText($d->content)}}</td>
                                        <td>{{$d->type}}</td>
                                        <td>@if($d->fb=='yes')<span class="label label-success">Yes</span>@else<span
                                                    class="label label-danger">No</span>@endif</td>
                                        <td>@if($d->fbg=='yes')<span class="label label-success">Yes</span>@else<span
                                                    class="label label-danger">No</span>@endif</td>
                                        <td>@if($d->tw=='yes')<span class="label label-success">Yes</span>@else<span
                                                    class="label label-danger">No</span>@endif</td>
                                        <td>@if($d->tu=='yes')<span class="label label-success">Yes</span>@else<span
                                                    class="label label-danger">No</span>@endif</td>
                                        <td>@if($d->wp=='yes')<span class="label label-success">Yes</span>@else<span
                                                    class="label label-danger">No</span>@endif</td>
                                        <td>@if($d->skype=='yes')<span class="label label-success">Yes</span>@else<span
                                                    class="label label-danger">No</span>@endif</td>
                                        <td><div data-id="{{$d->id}}" class="optsdel"><a  class="label label-danger"><i
                                                        class="fa fa-times"></i> Delete</a></div><div data-type="{{$d->type}}" data-id="{{$d->id}}" data-title="{{$d->title}}" data-content="{{$d->content}}" class="optsedit"><a  class="label label-warning"><i
                                                            class="fa fa-edit"></i> Edit</a></div></td>


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

    {{--modal--}}

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit schedule</h4>
                </div>
                <div class="modal-body">


                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Title</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-sm-2 control-label">Content</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="content" rows="3"></textarea>
                                    </div>
                                </div>

                                <input type="hidden" id="id">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                            <select id="type">
                                                <option value="everyMinute">Every Minute</option>
                                                <option value="everyFiveMinutes">Every Five Minutes</option>
                                                <option value="everyTenMinutes">Every Ten Minutes</option>
                                                <option value="everyThirtyMinutes">Every Thirty Minutes</option>
                                                <option value="hourly">Hourly</option>
                                                <option value="daily">Daily</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="quarterly">Quarterly</option>
                                                <option value="yearly">Yearly</option>
                                                <option value="none">Stop</option>
                                            </select>

                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="sedit" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
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
