@extends('layouts.app')
@section('title','Pinterest | Search')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{--table start--}}
                <div class="box">
                    <div class="box-header">
                        <div align="center" class="row">
                            <div class="col-md-6">
                                <input id="query" placeholder="Type here what you are looking for" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <select id="type" class="form-control">

                                    <option value="pins">Pins</option>
                                    <option value="peoples">People</option>
                                    <option value="boards">Boards</option>
                                    <option value="inMyPin">In my Pin</option>


                                </select>
                            </div>

                            <div class="col-md-2">
                                <button id="search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" align="center" id="wait">
                        <img src="{{url('/images/optimus/social/loader.gif')}}"><br>
                        <h3>Please wait ....</h3>
                    </div>
                    <div id="scraper" class="box-body">

                        {{-- table was here--}}
                    </div>
                    {{--End box--}}

                    {{--table end--}}


                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
