@extends('layouts.app')
@section('title','Skype Collected Phone numbers')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="skypephone"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Collected phone numbers <label
                                    class="badge">{{\App\Phones::all()->count()}}</label></h3>
                        <button id="delall" class="btn btn-warning btn-xs"><i class="fa fa-database"></i> Delete all
                            numbers
                        </button>
                    </div>
                    <div class="box-body">
                        <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Phone number</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($data as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->username}}</td>
                                    <td>{{$post->phone}}</td>
                                    <td align="center">
                                        <button data-id="{{$post->id}}" class="btn btn-danger btn-xs"><i
                                                    class="fa fa-trash"></i> Delete
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Phone number</th>

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

</script>
@endsection