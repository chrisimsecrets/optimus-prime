@extends('layouts.app')
@section('title','Profile | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li class=""  ><a href="#history" data-toggle="tab" aria-expanded="false"><i class="fa fa-clock-o"></i> History</a> </li>
                            <li class=""><a href="#add-user-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-user-plus"></i> Add Users</a></li>
                            <li class="active"><a href="#user-list" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> All users</a></li>

                            <li class="pull-left header"><i class="fa fa-users"></i> User management</li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="add-user-tab">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="user-list">

                                {{-- user list--}}




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
                                                            <th>Type</th>
                                                            <th>Status</th>
                                                            <th>Packages</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @foreach($data as $d)
                                                            <tr>
                                                                <td>{{$d->name}} @if(Auth::user()->id == $d->id) <small class="label pull-right bg-green">You</small> @endif </td>
                                                                <td>{{$d->email}}</td>
                                                                <td>{{$d->type}}</td>

                                                                <td>@if($d->status == 'deactive') Deactive @else Active @endif</td>
                                                                <td>
                                                                    @if(\App\Http\Controllers\Data::hasPackage($d->id,'fb'))
                                                                        <i class="fa fa-facebook-official"></i>
                                                                    @endif

                                                                    @if(\App\Http\Controllers\Data::hasPackage($d->id,'tw'))
                                                                        <i class="fa fa-twitter"></i>
                                                                    @endif

                                                                    @if(\App\Http\Controllers\Data::hasPackage($d->id,'tu'))
                                                                        <i class="fa fa-tumblr-square"></i>
                                                                    @endif

                                                                    @if(\App\Http\Controllers\Data::hasPackage($d->id,'fbBot'))
                                                                        <i class="fa fa-comment"></i>
                                                                    @endif

                                                                    @if(\App\Http\Controllers\Data::hasPackage($d->id,'wp'))
                                                                        <i class="fa fa-wordpress"></i>
                                                                    @endif

                                                                    @if(\App\Http\Controllers\Data::hasPackage($d->id,'in'))
                                                                        <i class="fa fa-instagram"></i>
                                                                    @endif

                                                                    @if(\App\Http\Controllers\Data::hasPackage($d->id,'ln'))
                                                                        <i class="fa fa-linkedin"></i>
                                                                    @endif

                                                                    @if(\App\Http\Controllers\Data::hasPackage($d->id,'slackBot'))
                                                                        <i class="fa fa-slack"></i>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <button data-id="{{$d->id}}" class="btn btn-xs btn-danger"><i
                                                                                class="fa fa-trash"></i> Deactive
                                                                    </button>
                                                                    <a href="{{url('/user')}}/{{$d->id}}" class="btn btn-xs btn-default"><i
                                                                                class="fa fa-edit"> Edit</i> </a></td>


                                                            </tr>
                                                        @endforeach
                                                        </tbody>

                                                        <tfoot>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Type</th>
                                                            <th>Packages</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>{{--End box--}}

                                </div>{{--End wrapper--}}
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="history">

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                {{-- block 1 end--}}

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')
    <script>
        $('.btn-danger').click(function () {
            var id = $(this).attr('data-id');
            var action = confirm("Do you want to deactive this user ?");
            if (action) {

                $.ajax({
                    type: 'POST',
                    url: '{{url('/user/delete')}}',
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        if (data == 'success') {
                            swal('Success', 'User deactivated', 'success');
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
            }


        });
    </script>
@endsection
