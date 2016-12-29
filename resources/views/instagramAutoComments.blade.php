@extends('layouts.app')
@section('title','Instagram | Auto Comments')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Auto Comment</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="form-group">
                            <select>
                                <option value="timeline">Home Feed</option>
                                <option value="popular">Popular Feed</option>
                                <option value="self">Self Timeline</option>
                                <option value="hashtag">Hashtag Feed</option>
                            </select>
                        </div>
                        <div id="message" class="form-group">

                        </div>

                        <div id="" class="form-group">
                            <label for="content">Find and follow user by hashtag</label>
                            <input type="text" class="form-control" id="tag" placeholder="Type tag name here without '#'">
                        </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="button" id="search" class="btn btn-primary">Start following</button>
                    </div>

                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')

@endsection





