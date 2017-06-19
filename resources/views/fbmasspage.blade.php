@extends('layouts.app')
@section('title','Mass comment on Facebook Page')
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
                                <h3 class="box-title">Add new Page for Comment</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="groupName">Page Url</label>
                                    <input type="text" class="form-control" id="url"
                                           placeholder="Type Page url">
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button id="saveFbPage" class="btn btn-primary">Add</button>
                            </div>

                        </div>

                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3>Your Public Pages</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>Page Name</th>
                                        <th>Page Id</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                    @foreach($pages as $page)
                                        <tr>
                                            <td><a target="_blank"
                                                   href="https://facebook.com/{{$page->pageId}}">{{$page->pageName}}</a>
                                            </td>
                                            <td>
                                                {{$page->pageId}}
                                            </td>
                                            <td>
                                                <button data-name="{{$page->pageName}}" data-id="{{$page->pageId}}"
                                                        class="btn badge bg-green"><i
                                                            class="fa fa-comment"></i> Mass Comment
                                                </button>
                                                <button data-id="{{$page->id}}" class="btn badge bg-red"><i
                                                            class="fa fa-times"></i> Delete
                                                </button>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
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
                                    <button id="massComment" class="btn btn-warning">Comment to all public Pages
                                    </button>
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
{{--@section('css')--}}
    {{--<script src="{{url('/opt/sweetalert.min.js')}}"></script>--}}
    {{--<link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">--}}
{{--@endsection--}}

@section('js')
    <script>
        $('#saveFbPage').click(function () {
            $(this).html("Please wait ..");
            $.ajax({
                type: 'POST',
                url: '{{url('/facebook/addpublicpage')}}',
                data: {
                    'url': $('#url').val(),
                },
                success: function (data) {
                    if (data == 'success') {
                        $('#saveFbPage').html('Add');
                        swal('Success', 'Facebook Page Added', 'success');
                        location.reload();
                    }
                    else {
                        swal('Error', data, 'error');
                    }
                },
                error: function (data) {
                    swal('Error', "Something went wrong can't perform this action", 'error');
                    console.log(data);
                }
            });
        });
        $('#massComment').click(function () {
            var txt = $('#status').val();
            $('#msg').html("Please wait .........");
            $.ajax({
                type: 'POST',
                url: '{{url('/facebook/masscomment')}}',
                data: {
                    'text': txt
                },
                success: function (data) {
                    $('#msg').html(data);
                }
            })
        });
        $('.bg-red').click(function () {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '{{url('/delete/fbpublicpage')}}',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data == 'success') {
                        alert('Page deleted');
                        location.reload();
                    }
                    else {
                        alert(data);
                    }
                },
                error: function (data) {
                    alert("Something went wrong, Please check console message");
                    console.log(data.responseText);
                }
            });

        });

        $('.bg-green').click(function () {
            var id = $(this).attr('data-id');
            var pageName = $(this).attr('data-name');
            swal({
                title: "Comment",
                text: "Write comment on " + pageName + "'s last 10 post",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Write comment here",
                showLoaderOnConfirm: true,
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                $.ajax({
                    type: 'POST',
                    url: '{{url('/facebook/page/masscomment')}}',
                    data: {
                        'id': id,
                        'text': inputValue
                    },
                    success: function (data) {
                        swal(data);
                    },
                    erro: function (data) {
                        swal(data);
                    }
                });
            });
        })
    </script>
@endsection