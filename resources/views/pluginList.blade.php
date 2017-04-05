@extends('layouts.app')
@section('title','Plugin List | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                @foreach($data as $plugin)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box @if($plugin['active'] == 1) box-success @else box-warning @endif box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{$plugin['name']}}</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="display: block;">
                                    @if($plugin['for']=="admin")
                                        <kbd>This plugin made for admin</kbd>
                                    @else
                                        <kbd>This plugin made for all user</kbd>
                                    @endif
                                    <br>
                                    {!! $plugin['description'] !!}
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    Developed by : {{$plugin['author']}}
                                </div>
                                <div class="box-footer">
                                    <div class="btn-group btn-group-xs">
                                        <button data-name="{{$plugin['name']}}" @if($plugin['active'] == 1) disabled
                                                @endif class="btn btn-success">Enable
                                        </button>
                                        <button data-name="{{$plugin['name']}}" @if($plugin['active'] != 1) disabled
                                                @endif class="btn btn-warning">
                                            Disable
                                        </button>
                                        <button data-name="{{$plugin['name']}}" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')
    <script>
        $('.btn-success').click(function () {
            var name = $(this).attr('data-name');

            $.ajax({
                url: '{{url('/plugin/action')}}',
                type: 'POST',
                data: {
                    'action': 'enable',
                    'name': name
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "Successfully Enabled", "success");
                        location.reload();
                    } else {
                        swal("Error", data, 'error');
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong, Please check console message", "error");
                    console.log(data.responseText);
                }
            });
        });

        $('.btn-danger').click(function () {
            var name = $(this).attr('data-name');
            $.ajax({
                url: '{{url('/plugin/action')}}',
                type: 'POST',
                data: {
                    'action': 'delete',
                    'name': name
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "Successfully Deleted", "success");
                        location.reload();
                    } else {
                        swal("Error", data, 'error');
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong, Please check console message", "error");
                    console.log(data.responseText);
                }
            })
        });

        $('.btn-warning').click(function () {
            var name = $(this).attr('data-name');

            $.ajax({
                url: '{{url('/plugin/action')}}',
                type: 'POST',
                data: {
                    'action': 'disable',
                    'name': name
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "Successfully Disabled", "success");
                        location.reload();
                    } else {
                        swal("Error", data, 'error');
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong, Please check console message", "error");
                    console.log(data.responseText);
                }
            })
        });
    </script>
@endsection
