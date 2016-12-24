@extends('layouts.app')
@section('title','Instagram | Popular')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <h2>Popular Feed According to your likes</h2>
                @foreach($datas['items'] as $data)
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Box Comment -->
                            <div class="box box-widget">
                                <div class="box-header with-border">
                                    <div class="user-block">
                                        <img class="img-circle" src="{{$data['user']['profile_pic_url']}}" alt="User Image">
                                        <span class="username"><a href="https://www.instagram.com/{{$data['user']['username']}}">{{$data['user']['full_name']}}</a></span>
                                        {{--<span class="description time">Shared - {{$data->taken_at}}</span>--}}
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="box-tools">
                                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title=""
                                                data-original-title="Instagram Post">
                                            <i class="fa fa-circle-o"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                    class="fa fa-times"></i></button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                    @if($data['media_type'] == 1)
                                        <img class="img-responsive pad"
                                             src="{{$data['image_versions2']['candidates'][0]['url']}}" alt="Photo">
                                    @elseif($data['media_type'] == 2)
                                        <video width="400" controls>
                                            <source src="{{$data['video_versions'][2]['url']}}" type="video/mp4">

                                            Your browser does not support HTML5 video.
                                        </video>
                                    @endif
                                    @if($data['caption'] != "")
                                        <p>{{$data['caption']['text']}}</p>
                                    @endif
                                    <br>


                                    @foreach($data['image_versions2']['candidates'] as $imgs)
                                        <a target="_blank" href="{{$imgs['url']}}" class="label label-default"><i
                                                    class="fa fa-download"></i> {{$imgs['width']." X ".$imgs['height']}} <i
                                                    class="fa fa-image"></i> </a>
                                    @endforeach
                                    <br>
                                    @if($data['media_type'] == 2)


                                        <a target="_blank" href="{{$data['video_versions'][0]['url']}}"
                                           class="label label-primary"><i
                                                    class="fa fa-download"></i> {{$data['video_versions'][0]['width']." X ".$data['video_versions'][0]['height']}}
                                            Download video <i class="fa fa-video-camera"></i>
                                        </a>

                                    @endif

                                    <span class="pull-right text-muted">{{$data['like_count']}}
                                        likes - {{$data['comment_count']}} comments</span>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer box-comments">
                                    @foreach($data['preview_comments'] as $comment)
                                        <div class="box-comment">
                                            <!-- User image -->
                                            <img class="img-circle img-sm" src="{{$comment['user']['profile_pic_url']}}"
                                                 alt="User Image">

                                            <div class="comment-text">
                      <span class="username">
                       <a target="_blank" href="https://www.instagram.com/@if(isset($comment['user']['username'])){{$comment['user']['username']}}@endif">{{$comment['user']['full_name']}}</a>
                          <span class="text-muted pull-right"><div class="time">
                                  {{--{{$comment->created_at}}--}}
                              </div> </span>

                      </span><!-- /.username -->
                                                {{$comment['text']}}
                                            </div>
                                            <!-- /.comment-text -->
                                        </div>
                                @endforeach
                                <!-- /.box-comment -->

                                    <!-- /.box-comment -->
                                </div>
                                <!-- /.box-footer -->
                                <div class="box-footer">


                                        <!-- .img-push is used to add margin to elements next to floating images -->
                                        <div class="img-push">
                                            <input type="text" class="form-control input-sm"
                                                   placeholder="Press enter to post comment">
                                        </div>

                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                @endforeach
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')

@endsection





