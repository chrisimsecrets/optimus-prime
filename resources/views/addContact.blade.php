@extends('layouts.app')
@section('title','Add new Contact | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">


                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title"><i class="fa fa-tumblr"></i> Tumblr Settings</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="tuConKey">Consumer Key</label>
                                        <input class="form-control" id="tuConKey" value="{{ $tuConKey }}"
                                               placeholder="Your tumblr consumer key" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tuConSec">Consumer Secret</label>
                                        <input class="form-control" value="{{ $tuConSec }}" id="tuConSec"
                                               placeholder="Your tumblr consumer secret" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="tuToken">Token</label>
                                        <input class="form-control" value="{{ $tuToken }}" id="tuToken"
                                               placeholder="Your tumblr token"
                                               type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="tuTokenSec">Token Secret</label>
                                        <input class="form-control" value="{{ $tuTokenSec }}" id="tuTokenSec"
                                               placeholder="Your tumblr token secret" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="tuDefBlog">Default Blog Name</label>
                                        <input disabled class="form-control" value="{{ $tuDefBlog }}" id=""
                                               placeholder="Your tumblr default blog name" type="text">

                                    </div>

                                    <div class="form-group">
                                        <label for="tuDefBlog">Tumblr Available Blogs</label>
                                        <select id="tuDefBlog">
                                            @foreach($tuBlogs as $blog)
                                                <option>{{ $blog->blogName }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button id="tuSave" class="btn btn-primary">Save</button>
                                    <a id="tuSync" href="{{ url('/tusync') }}" class="btn btn-warning">Sync Now</a>
                                </div>

                            </div>
                        </div>


                </div>


            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

