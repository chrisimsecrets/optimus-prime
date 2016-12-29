@extends('layouts.app')
@section('title','Instagram | Home')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                @foreach($datas->feed_items as $data)
                    @if(isset($data->media_or_ad))
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Box Comment -->
                                <div class="box box-widget">
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <img class="img-circle" src="{{$data->media_or_ad->user->profile_pic_url}}"
                                                 alt="User Image">
                                            <span class="username"><a
                                                        href="https://www.instagram.com/{{$data->media_or_ad->user->username}}">{{$data->media_or_ad->user->full_name}}</a></span>
                                            {{--<span class="description time">Shared - {{$data->taken_at}}</span>--}}
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="box-tools">
                                            {{--<button class="btn btn-xs btn-danger">Delete</button>--}}
                                            <a target="_blank" href="{{url('/instagram/info')."/".$data->media_or_ad->id}}" class="btn btn-xs btn-default">View Details</a>
                                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip"
                                                    title=""
                                                    data-original-title="Instagram Post">
                                                <i class="fa fa-circle-o"></i></button>
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>

                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">

                                        @if($data->media_or_ad->media_type == 1)
                                            <img class="img-responsive pad"
                                                 src="{{$data->media_or_ad->image_versions2->candidates[0]->url}}" alt="Photo">
                                        @elseif($data->media_or_ad->media_type == 2)
                                            <video width="400" controls>
                                                <source src="{{$data->media_or_ad->video_versions[2]->url}}" type="video/mp4">

                                                Your browser does not support HTML5 video.
                                            </video>
                                        @endif
                                        @if($data->media_or_ad->caption != "")
                                            <p>{{$data->media_or_ad->caption->text}}</p>
                                        @endif
                                        <br>


                                        @foreach($data->media_or_ad->image_versions2->candidates as $imgs)
                                            <a target="_blank" href="{{$imgs->url}}" class="label label-default"><i
                                                        class="fa fa-download"></i> {{$imgs->width." X ".$imgs->height}} <i
                                                        class="fa fa-image"></i> </a>
                                        @endforeach
                                        <br>
                                        @if($data->media_or_ad->media_type == 2)


                                            <a target="_blank" href="{{$data->media_or_ad->video_versions[0]->url}}"
                                               class="label label-primary"><i
                                                        class="fa fa-download"></i> {{$data->media_or_ad->video_versions[0]->width." X ".$data->media_or_ad->video_versions[0]->height}}
                                                Download video <i class="fa fa-video-camera"></i>
                                            </a>

                                        @endif

                                        <span class="pull-right text-muted">{{$data->media_or_ad->like_count}}
                                            likes - {{$data->media_or_ad->comment_count}} comments</span>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer box-comments">
                                        @foreach($data->media_or_ad->preview_comments as $comment)
                                            <div class="box-comment">
                                                <!-- User image -->


                                                <div class="comment-text">
                      <span class="username">
                          <a href="https://www.instagram.com/{{$comment->user->username}}">{{$comment->user->full_name}}</a>
                          <span class="text-muted pull-right"><div class="time">
                                  {{--{{$comment->created_at}}--}}
                              </div> </span>

                      </span><!-- /.username -->
                                                    {{$comment->text}}
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
                                            <input data-id="{{$data->media_or_ad->id}}" type="text" class="form-control input-sm comment"
                                                   placeholder="Press enter to post comment">
                                        </div>

                                    </div>
                                    <!-- /.box-footer -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    @endif
                @endforeach
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')
<script>
    $(".comment").on( "keydown", function(event) {
        if(event.which == 13){

            var id = $(this).attr('data-id');
            var text = $(this).val();
            $.toast('Wait trying to post comment');
            $.ajax({
                type:'POST',
                url:'{{url('/instagram/comment')}}',
                data:{
                    'id':id,
                    'text':text
                },
                success:function (data) {
                    if(data=="success"){
                        $.toast('Success ! Comment posted');
                    }else{
                        $.toast(data);
                    }
                },
                error:function (data) {
                    swal('Error','Something went wrong please check console message','error');
                    console.log(data.responseText);
                }
            })

        }

    });
</script>
@endsection





