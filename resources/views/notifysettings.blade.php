@extends('layouts.app')
@section('title','Notifications settings')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="notifysettingspage"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                                <h3 class="box-title"><i class="fa fa-bell-o"></i> Notifications configuration</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="appId">Pusher App ID</label>
                                    <input class="form-control" id="appId" value="{{$appId}}"
                                           placeholder="Pusher app ID" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="appKey">Puser App Key</label>
                                    <input class="form-control" value="{{$appKey}}" id="appKey"
                                           placeholder="Puser App Key" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="appSec">Pusher App Secreate</label>
                                    <input class="form-control" value="{{$appSec}}" id="appSec"
                                           placeholder="Pusher App Secret"
                                           type="text">
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="notifySave" class="btn btn-primary">Save</button>
                            </div>

                        </div>
                    </div>
                </div>
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection