@extends('layouts.app')
@section('title','Facebook Scraper')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">


                {{--table start--}}
                <div class="box">
                    <div class="box-header">
                        <div align="center" class="row">
                            <div class="col-md-6">
                                <input id="query" placeholder="Type here what you are looking for" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <select id="type" class="form-control">
                                    <option value="page">Page</option>
                                    <option value="place">Place</option>
                                    <option value="event">Event</option>
                                    <option value="group">Group</option>
                                    <option value="user">User</option>

                                </select>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" placeholder="Limit" value="10" type="text" id="limit">
                            </div>
                            <div class="col-md-2">
                                <button id="search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>

                    <div id="scraper" class="box-body">
                        {{-- table was here--}}
                    </div>
                    {{--End box--}}

                    {{--table end--}}


                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script>

        $('#search').click(function () {

            if ($('#query').val() == '') {
                return swal('Please enter keyword');
            }
            else {
                $('#scraper').html(
                        '<div align="center"><h3>Searching ......</h3><br><img src="{{url('/images/optimus/social/loader.gif')}}">'
                );
                $.ajax({
                    type: 'POST',
                    url: '{{url('/scraper')}}',
                    data: {
                        'data': $('#query').val(),
                        'type': $('#type').val(),
                        'limit': $('#limit').val(),
                    },
                    success: function (data) {
                        $('#scraper').html(data);
//                            console.log(data);
                        var table = $('#mytable').DataTable({

                            dom: '<""flB>tip',
                            buttons: [
                                {
                                    extend: 'excel',
                                    text: '<button class="btn btn-success btn-xs fak"><i class="fa fa-file-excel-o"></i> Export all to excel</button>'
                                },
                                {
                                    extend: 'csv',
                                    text: '<button class="btn btn-warning btn-xs fak"><i class="fa fa-file-o"></i> Export all to csv</button>'
                                },
                                {
                                    extend: 'pdf',
                                    text: '<button class="btn btn-danger btn-xs fak"><i class="fa fa-file-pdf-o"></i> Print all in pdf</button>'
                                },
                                {
                                    extend: 'print',
                                    text: '<button class="btn btn-default btn-xs fak"><i class="fa fa-print"></i> Print all</button>'
                                },
                            ]
                        });
                    }
                });
            }
        });

    </script>
@endsection
@section('css')
    <script src="{{url('opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('opt/sweetalert.css')}}">

@endsection