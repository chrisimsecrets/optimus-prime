@extends('layouts.app')
@section('title','Select page | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Your facebook pages</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            @foreach(\App\FacebookPages::where('userId',Auth::user()->id)->get() as $data)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{url('/images/optimus/social/fb.png')}}" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="{{url('/fbreport')."/".$data->pageId}}"
                                           class="product-title">{{$data->pageName}}
                                            <span class="label label-success pull-right">Select</span></a>
                                        <span class="product-description">
                          {{$data->pageId}}
                        </span>
                                    </div>
                                </li>
                        @endforeach

                        <!-- /.item -->
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('css')
    <style>
        .products-list {
            padding: 20px;
        }

        .item {
            padding: 20px;
        }
    </style>
@endsection