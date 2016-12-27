@extends('layouts.app')
@section('title','Instagram | Followers')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                <div class="col-md-12">
                    <!-- USERS LIST -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Followers</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                @foreach($datas->users as $data)
                                    <li>
                                        <img src="{{$data->profile_pic_url}}" alt="User Image">
                                        <a target="_blank" class="users-list-name" href="https://instagram.com/{{$data->username}}">{{$data->username}}</a>
                                        <span class="users-list-date"><button data-id="{{$data->username}}" class="btn btn-default follow">Follow</button> </span>
                                    </li>

                                @endforeach


                            </ul>
                            <!-- /.users-list -->
                        </div>

                    </div>
                    <!--/.box -->
                </div>
                </div>
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')

@endsection





