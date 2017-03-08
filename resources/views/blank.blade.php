@extends('layouts.app')
@section('title','Profile | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <div class="row">
                    <div class="sContainer colorFb">
                        <span class="sTime">{{$da->time}}</span>
                        @if($da->image != "")
                            <img src="{{url('/uploads')}}/{{$da->image}}">
                        @else
                            <br>
                        @endif
                        <h4>
                            @if($da->fb == "yes")
                                <i class="fa fa-facebook-official"></i>
                            @elseif($da->fbg == "yes")
                                <i class="fa fa-facebook-official"></i>
                            @elseif($da->tw == "yes")
                                <i class="fa fa-twitter"></i>
                            @elseif($da->tu == "yes")
                                <i class="fa fa-tumblr"></i>
                            @elseif($da->wp == "yes")
                                <i class="fa fa-wordpress"></i>
                            @elseif($da->instagram == "yes")
                                <i class="fa fa-instagram"></i>
                            @else
                                <i class="fa fa-times"></i>
                            @endif

                            {{$da->title}}</h4>
                        <p>
                            {{$da->content}}
                        </p>
                        @if($da->published == "yes")
                            <button type="button" class="btn btn-block btn-xs bg-olive">Published
                            </button>
                        @else
                            <button data-id="{{$da->id}}" type="button"
                                    class="btn btn-block btn-warning btn-xs scheduled">
                                Scheduled
                            </button>
                            <div id="{{$da->id}}" style="display:none;" align="center">
                                <hr>
                                <input type="datetime-local" value="{{\Carbon\Carbon::parse($d)->format("Y-m-d\TH:i:s")}}" class="time_{{$d->id}}" id="time">
                                <hr>
                                <div class="btn-group">
                                    <button data-id="{{$da->id}}" type="button"
                                            class="btn btnSave  btn-primary btn-xs">Save
                                    </button>
                                    <button data-id="{{$da->id}}" type="button"
                                            class="btn  btn-danger btn-xs">Close
                                    </button>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
                {{-- block 1 end--}}

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
