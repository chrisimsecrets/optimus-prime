@extends('layouts.app')
@section('title','Report | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                @foreach($data['data'] as $d)

                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header @if(strpos($d['title'],'Paid') !== false) bg-green-active @else bg-aqua-active @endif">
                            <h3 class="widget-user-username">{{$d['title']}}</h3>
                            <h5 class="widget-user-desc">{{$d['description']}}</h5>
                        </div>

                        <div class="box-footer">
                            <div class="row">

                                @foreach($d['values'] as $values)
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{$values['value']}}</h5>
                                            <span class="description-text">{{\Carbon\Carbon::parse($values['end_time'])->diffForHumans()}}</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                            @endforeach
                            <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                @endforeach
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
