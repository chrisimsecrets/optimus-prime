@extends('layouts.app')
@section('title','Facebook')
@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                @if($msg == 'success')
                    <h3 class="alert-success">Connected</h3><br>
                    <a class="btn btn-facebook">Now go back to settings page</a>
                    <p>Your access token {{ $accessToken }}</p>
                @else
                    <h3 class="alert-error">Something went wrong</h3><br>
                    <a class="btn btn-danger">Go back to settings page</a>
                @endif
            </div>
        </div>
    </section>



@endsection


