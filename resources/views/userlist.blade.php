@extends('layouts.app')
@section('title','User List')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="allpost"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All User <label
                                    class="badge">{{\App\Allpost::all()->count()}}</label></h3>
                    </div>
                    <div class="box-body">
                        <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->email}}</td>
                                    <td>
                                        <button data-id="{{$d->id}}" class="btn btn-xs btn-danger"><i
                                                    class="fa fa-trash"></i> Delete
                                        </button>
                                        <a href="{{url('/user')}}/{{$d->id}}" class="btn btn-xs btn-default"><i
                                                    class="fa fa-edit"> Edit</i> </a></td>

                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <th>Post ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Available on</th>
                                <th>Action</th>
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
    <script>
        $('.btn-danger').click(function () {
            var id = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                text: "Do you wan't to delete this user ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/user/delete')}}',
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        if (data == 'success') {
                            swal('Success', 'Deleted', 'success');
                            location.reload();
                        }
                        else {
                            swal('Error', data, 'error');
                            console.log(data.responseText);
                        }
                    },
                    error: function (data) {
                        swal('Error', data, 'error');
                        console.log(data.responseText);
                    }

                });
            });

        });
    </script>
@endsection