<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->

        <span class="logo-mini"><img
                    src="@if(Auth::user()->theme == 'skin-black' || Auth::user()->theme == 'skin-black-light') {{ url('/images/optimus/logo-login.png')}} @else {{ url('/images/optimus/logo-mini.png') }} @endif"
                    alt="Optimus"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img
                    src="@if(Auth::user()->theme == 'skin-black' || Auth::user()->theme == 'skin-black-light') {{ url('/images/optimus/logo-login.png')}} @else {{ url('/images/optimus/logo-mini.png') }} @endif"
                    alt="Optimus"><b>Optimus</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                {{-- Language settings--}}

                <li class="dropdown messages-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-language"></i>

                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Select your language</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                                <li>
                                    <a target="_blank" href="#">
                                        <div class="pull-left">
                                            <span class="flag-icon flag-icon-gb"></span>

                                        </div>
                                        <h4>
                                            English

                                        </h4>

                                    </a>
                                </li>

                                <li>
                                    <a target="_blank" href="#">
                                        <div class="pull-left">
                                            <span class="flag-icon flag-icon-bd"></span>

                                        </div>
                                        <h4>
                                            Bangla

                                        </h4>

                                    </a>
                                </li>


                            </ul>
                        </li>
                        @if(Auth::user()->type == 'admin')
                            <li class="footer"><a href="{{ url('/language/add') }}">Add new language</a></li>
                        @endif
                    </ul>
                </li>
            {{--<li class="dropdown messages-menu">--}}

            {{--<a id="intro" href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
            {{--<i class="fa fa-question"></i>--}}
            {{--Help--}}
            {{--</a>--}}

            {{--</li>--}}
            <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">{{ \App\Notify::where('type','message')->where('userId',Auth::user()->id)->count() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You
                            have {{ \App\Notify::where('type','message')->where('userId',Auth::user()->id)->count() }}
                            messages
                        </li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach(\App\Notify::where('type','message')->where('userId',Auth::user()->id)->get() as $msg)
                                    <li><!-- start message -->
                                        <a target="_blank" href="{{$msg->url}}">
                                            <div class="pull-left">
                                                <img src="{{ url($msg->img) }}"
                                                     class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                {{$msg->title}}
                                                <small><i class="fa fa-clock-o"></i></small>
                                            </h4>
                                            <p>{{$msg->body}}</p>
                                        </a>
                                    </li>

                            @endforeach  <!-- end message -->
                                <li>
                            </ul>
                        </li>
                        <li class="footer"><a href="{{ url('/notify') }}">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{ \App\Notify::where('type','fbnotify')->where('userId',Auth::user()->id)->count() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You
                            have {{ \App\Notify::where('type','fbnotify')->where('userId',Auth::user()->id)->count() }}
                            messages
                        </li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach(\App\Notify::where('type','fbnotify')->where('userId',Auth::user()->id)->get() as $msg)
                                    <li><!-- start message -->
                                        <a target="_blank" href="{{$msg->url}}">
                                            <div class="pull-left">
                                                <img src="{{ url($msg->img) }}"
                                                     class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                {{ $msg->title }}
                                                <small><i class="fa fa-clock-o"></i></small>
                                            </h4>
                                            <p>{{ $msg->body }}</p>
                                        </a>
                                    </li>

                            @endforeach  <!-- end message -->
                                <li>
                            </ul>
                        </li>
                        <li class="footer"><a href="{{ url('/notify') }}">See All Notifications</a></li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ url('/images/admin-lte/avatar.png') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ \Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ url('/images/admin-lte/avatar.png') }}" class="img-circle"
                                 alt="User Image">
                            <p>
                                {{ \Auth::user()->name }}
                                <small>{{ \Auth::user()->email }}</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('/profile')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>