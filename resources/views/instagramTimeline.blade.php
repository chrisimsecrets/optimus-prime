@extends('layouts.app')
@section('title','Instagram | My Account')

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
                                            <span class="username"><a href="#">{{$data->media_or_ad->user->full_name}}</a></span>
                                            {{--<span class="description time">Shared - {{$data->taken_at}}</span>--}}
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="box-tools">
                                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip"
                                                    title=""
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
                                        @if($data->media_or_ad->media_type == 1)
                                            <img class="img-responsive pad"
                                                 src="{{$data->media_or_ad->image_versions2->candidates[0]->url}}" alt="Photo">
                                        @elseif($data->media_or_ad->media_type == 2)
                                            Video will be here
                                        @endif
                                        @if($data->media_or_ad->caption != "")
                                            <p>{{$data->media_or_ad->caption->text}}</p>
                                        @endif
                                        <br>

                                        <div class="pull-left"> Top Likers</div>
                                        <br>
                                        @foreach($data->media_or_ad->top_likers as $liker)
                                            <span class="pull-left badge bg-blue">{{$liker}}</span>
                                        @endforeach

                                        <br>
                                        {{--<button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i>--}}
                                        {{--Share--}}
                                        {{--</button>--}}
                                        {{--<button type="button" class="btn btn-default btn-xs"><i--}}
                                        {{--class="fa fa-thumbs-o-up"></i>--}}
                                        {{--Like--}}
                                        {{--</button>--}}
                                        <span class="pull-right text-muted">{{$data->media_or_ad->like_count}}
                                            likes - {{$data->media_or_ad->comment_count}} comments</span>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer box-comments">
                                        @foreach($data->media_or_ad->preview_comments as $comment)
                                            <div class="box-comment">
                                                <!-- User image -->
                                                <img class="img-circle img-sm" src="{{$comment->user->profile_pic_url}}"
                                                     alt="User Image">

                                                <div class="comment-text">
                      <span class="username">
                        {{$comment->user->full_name}}
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

                                        <img class="img-responsive img-circle img-sm"
                                             src="{{$data->media_or_ad->user->profile_pic_url}}"
                                             alt="Alt Text">
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
                    @endif
                @endforeach
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')

@endsection





