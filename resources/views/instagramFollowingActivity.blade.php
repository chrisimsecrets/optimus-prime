@extends('layouts.app')
@section('title','Instagram | Following activity')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">
                <ul class="timeline">
                    @foreach($datas as $data)



                        <li>
                            <i class="fa fa-feed bg-aqua"></i>
                            <div class="timeline-item">

                                <h3 class="timeline-header">{{$data->args->text}}</h3>

                                <div class="timeline-body">
                                    @if(isset($data->args->media))
                                        @foreach($data->args->media as $media)
                                            <img src="{{$media->image}}" alt="..." class="margin">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </li>


                    @endforeach
                </ul>
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')

@endsection





