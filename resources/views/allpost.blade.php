@extends('layouts.app')
@section('title','Posts')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="allpost"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All articles and availability <label
                                    class="badge">{{\App\Allpost::all()->count()}}</label></h3>
                        <button id="delall" class="btn btn-warning btn-xs"><i class="fa fa-database"></i> Delete all
                            from database
                        </button>
                    </div>
                    <div class="box-body">
                        <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Post ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>
                                    <div align="center">Available on</div>
                                </th>
                                <th>
                                    <div align="center">Action</div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->postId}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{\App\Http\Controllers\Data::shortText($post->content)}}</td>

                                    <td align="center">
                                        @if(\App\Fb::where('postId',$post->postId)->exists())
                                            <i class="fa fa-facebook"></i> &nbsp;
                                        @endif
                                        @if(\App\Tw::where('postId',$post->postId)->exists())
                                            <i class="fa fa-twitter"></i> &nbsp;
                                        @endif
                                        @if(\App\Wp::where('postId',$post->postId)->exists())
                                            <i class="fa fa-wordpress"></i> &nbsp;
                                        @endif
                                        @if(\App\Tu::where('postId',$post->postId)->exists())
                                            <i class="fa fa-tumblr"></i>
                                        @endif
                                        @if(\App\Fbgr::where('postId',$post->postId)->exists())
                                            <i class="fa fa-users"></i>
                                        @endif

                                    </td>

                                    <td align="center">
                                        <button data-id="{{$post->id}}" class="btn btn-danger btn-xs"><i
                                                    class="fa fa-trash"></i> Delete
                                        </button>
                                        <button data-id="{{$post->id}}" data-value="{{$post->postId}}"
                                                class="btn btn-primary optdelall btn-xs"><i class="fa fa-times"> Delete
                                                from
                                                all</i></button>

                                    </td>
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
        $('.optdelall').click(function () {

            var postId = $(this).attr('data-value');

            $(this).html("Please wait..");
            $.ajax({
                type: 'POST',
                url: '{{url('/delfromall')}}',
                data: {
                    'postId': postId
                },
                success: function (data) {
                    swal("Status", data);
                    notify('{{url('/images/optimus/social/logopadding.png')}}', 'Message', data, '#');
                    $('.optdelall').html("<i class='fa fa-times'> Delete from all</i>");
                    location.reload();

                }
            });


        })
    </script>
@endsection