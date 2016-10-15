@extends('layouts.app')

@section('title','Linkedin Mass Comment')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper" id="linkedin">
            <section class="content">

                <form method="POST" action="{{ url('/linkedin/mass_comment') }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert hidden"></div>

                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="4"
                                          placeholder="Type your comment here ..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="toCompany">To</label>
                            <select name="to[]" id="toCompany" multiple>
                                <option value="all" selected>All Companies</option>

                                @foreach($companies as $company)
                                    <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                                @endforeach
                            </select>

                            <div class="in_all">
                                <label for="in_all">In all updates</label>
                                <input type="checkbox" name="in_all" id="in_all" checked>
                            </div>

                            <div class="in_last hidden">
                                <label for="in_last">In Last</label>
                                <input type="number" name="in_last" id="in_last" placeholder="0"
                                style="width: 15%"> <strong>Update(s)</strong>

                                <p class="help-block visible-lg">Press ESC in last update(s) input field to go back</p>

                                <div class="hidden-lg">
                                    <a href="#" id="go_back"><< go back</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button id="send" class="btn btn-success"
                                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..."
                            ><i class="fa fa-rocket"></i> Send</button>
                        </div>
                    </div>
                </form>


            </section>
        </div>
    </div>
@endsection
