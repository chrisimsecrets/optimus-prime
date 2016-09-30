<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>
    @yield('headjs')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">

    {{--Bootstrap and Sass--}}
    <link rel="stylesheet" href="{{ url(elixir('css/app.css')) }}">

    {{--AdminLTE and Less--}}
    <link rel="stylesheet" href="{{ url(elixir('css/admin.css')) }}">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.bootstrap.min.css">
    {{--Plugins CSS--}}

    <link rel="stylesheet" href="{{ url(elixir('css/plugins.css')) }}">
    {{--custom css--}}
    <link rel="stylesheet" href="{{url('/opt/css/custom.css')}}">
    <link rel="stylesheet" href="{{url('/opt/intro/introjs.css')}}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--emoji --}}
    <link rel="stylesheet" href="{{url('/opt/emoji/emojionearea.min.css')}}">

    @yield('css')
</head>
<body class="hold-transition sidebar-mini skin-red-light">

@yield('content')

</body>
</html>