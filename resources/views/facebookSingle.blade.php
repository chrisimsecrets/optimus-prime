@extends('layouts.app')
@section('title','Facebook pages')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Facebook pages<br>

                    </div>

                    <div class="panel-body">

                        <div class="list-group">
                            @foreach($pages as $page)
                                <a href="{{url('/facebook')}}/{{$page->pageId}}"
                                   class="list-group-item @if($id==$page->pageId) active @endif">
                                    {{$page->pageName}}
                                </a>

                            @endforeach


                        </div>

                        @foreach($datas['data'] as $data)
                            <div class="panel panel-default">
                                <div class="panel-heading">Post ID : {{$data['id']}}</div>
                                <div class="panel-body">
                                    @if(isset($data['story']))<b>{{$data['story']}}</b><br>@endif
                                    @if(isset($data['message'])){{$data['message']}}@endif

                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


