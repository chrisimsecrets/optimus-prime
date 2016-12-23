@extends('layouts.app')

@section('title','Linkedin Updates')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div id="liUpdates"></div>
                {{--linked in updates start from here--}}
                @foreach($datas as $data)
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Box Comment -->
                            <div class="box box-widget">
                                <div class="box-header with-border">
                                    <div class="user-block">
                                        <img class="img-circle" src="{{url('/images/optimus/social/me.png')}}"
                                             alt="User Image">
                                        <span class="username"><a
                                                    href="#">{{$data['updateContent']['company']['name']}}</a></span>
                                        <span class="description"><script>document.write(new Date({{$data['timestamp']}}));</script></span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="box-tools">
                                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title=""
                                                >
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
                                    <!-- post text -->

                                    <p>{{$data['updateContent']['companyStatusUpdate']['share']['comment']}}</p>


                                    <span class="pull-right text-muted">{{$data['numLikes']}}
                                        likes - @if($data['updateComments']['_total'] == 0)No
                                        comments @else {{$data['updateComments']['_total']}} comments @endif</span>
                                </div>
                                <!-- /.box-body -->
                                @if($data['updateComments']['_total'] != 0)

                                    <div class="box-footer box-comments">
                                        @foreach($data['updateComments']['values'] as $comment)
                                            <div class="box-comment">
                                                <!-- User image -->
                                                @if(isset($comment['person']))
                                                    <img class="img-circle img-sm"
                                                         src="{{url('/images/optimus/social/linkedin.png')}}"
                                                         alt="User Image">
                                                @else
                                                    <img class="img-circle img-sm"
                                                         src="{{url('/images/optimus/social/me.png')}}"
                                                         alt="User Image">
                                                @endif


                                                <div class="comment-text">
                      <span class="username">
                        @if(isset($comment['person']))
                              {{$comment['person']['firstName'] ." ".$comment['person']['lastName']}}
                          @else
                              {{$comment['company']['name']}}
                          @endif
                          <span class="text-muted pull-right"><script>document.write(new Date({{$comment['timestamp']}}));</script></span>
                      </span><!-- /.username -->
                                                    {{$comment['comment']}}
                                                </div>
                                                <!-- /.comment-text -->
                                            </div>
                                    @endforeach

                                    <!-- /.box-comment -->
                                    </div>
                            @endif
                            <!-- /.box-footer -->
                                <div class="box-footer">
                                    <form action="#" method="post">
                                        <img class="img-responsive img-circle img-sm"
                                             src="{{url('/images/optimus/social/me.png')}}"
                                             alt="Alt Text">
                                        <!-- .img-push is used to add margin to elements next to floating images -->
                                        <div class="img-push">
                                            <input type="text" class="form-control input-sm"
                                                   placeholder="Press enter to post comment">
                                        </div>
                                    </form>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                @endforeach

                {{--linked in updates end--}}


            </section><!-- /.content -->

        </div>
        @include('components.footer')
    </div>

@endsection
@section('js')
<script>

</script>
@endsection

