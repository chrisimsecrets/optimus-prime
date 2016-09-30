@extends('layouts.app')
@section('title','Config')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <p>Here is the only Cron entry you need to add to your server:</p>
                <p>Copy this line and add it to your corntab for schedule posting . Otherwise scheduling posing would not work</p>

                <code><pre>
                    {{$path}}
                    </pre></code>

            </section>
        </div>
    </div>
@endsection