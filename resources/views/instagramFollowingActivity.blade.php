@extends('layouts.app')
@section('title','Instagram | Following activity')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                @foreach($datas->stories as $data)
                    <div class="row">
                        <div class="timeline-item">

                            <h3 class="timeline-header"><a href="#">{{$data->args->text}}</a></h3>

                            <div class="timeline-body">
                                @foreach($data->args->media as $media)
                                    <img src="{{$media->image}}" alt="..." class="margin">
                                @endforeach
                            </div>
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





