@extends('layouts.app')
@section('title','Notifications')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="allnotify"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Notifications <label
                                    class="badge">{{\App\Notify::all()->count()}}</label></h3>
                        <button id="delall" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Delete all Notifications
                        </button>

                    </div>
                    <div class="box-body">
                        <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Url</th>
                                <th>Time</th>
                                <th>Type</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td><img height="50" width="50" src="{{$d->img}}"></td>
                                    <td>{{$d->title}}</td>
                                    <td>{{$d->body}}</td>
                                    <td><a target="_blank" href="{{$d->url}}">Click here</a></td>
                                    <td>{{$d->time}}</td>
                                    <td>{{$d->type}}</td>
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Url</th>
                                <th>Time</th>
                                <th>Type</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>{{--End box--}}
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection

@section('js')

@endsection