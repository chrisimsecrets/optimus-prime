<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url('/images/admin-lte/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            {{--admin menu--}}
            @if(Auth::user()->type == 'admin')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>Admin Panel</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu" style="display: none">
                        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i>
                                <span>Admin Dashboard</span></a></li>
                        <li><a href="{{ url('/user/add') }}"><i class="fa fa-plus-circle"></i> <span>Add User</span></a>
                        </li>
                        <li><a href="{{ url('/user/list') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>

                    </ul>
                </li>

            @endif
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
            <li><a href="{{ url('/write') }}"><i class="fa fa-edit"></i> <span>Write</span></a></li>
            <li><a href="{{ url('/allpost') }}"><i class="fa fa-copy"></i> <span>All posts</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clock-o"></i>
                    <span>Schedule</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: none">

                    <li><a href="{{ url('/schedule/day') }}"><i class="fa fa-list-ul"></i>
                            <span>Posts</span></a></li>



                </ul>
            </li>
            {{--contacts menu--}}
            @if(\App\Http\Controllers\Data::myPackage('contacts'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-list-ul"></i>
                        <span>Contacts</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu" style="display: none">

                        <li><a href="{{ url('/contact/create') }}"><i class="fa fa-user-plus"></i>
                                <span>New Contact</span></a></li>

                        <li><a href="{{ url('/contact') }}"><i class="fa fa-list-alt"></i> <span>Contact List</span></a>
                        </li>

                    </ul>
                </li>
            @endif
            {{-- chat bot menu--}}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comment"></i>
                    <span>Chat Bot</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: none">
                    @if(\App\Http\Controllers\Data::myPackage('fbBot'))
                        <li><a href="{{ url('/fb/bot') }}"><i class="fa fa-facebook"></i> <span>FB</span></a></li>
                    @endif
                    @if(\App\Http\Controllers\Data::myPackage('slackBot'))
                        <li><a href="{{ url('/slack/bot') }}"><i class="fa fa-slack"></i> <span>Slack</span></a></li>
                    @endif
                </ul>
            </li>
            <!-- skype deprecated -->
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-skype"></i>--}}
            {{--<span>Skype</span>--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu" style="display: none">--}}
            {{--<li><a href="{{ url('/skype') }}"><i class="fa fa-home"></i> <span>Skype</span></a></li>--}}
            {{--<li><a href="{{ url('/skype/phone/list') }}"><i class="fa fa-phone"></i> Collected Phone numbers</a>--}}
            {{--</li>--}}
            {{--</ul>--}}

            {{--</li>--}}
            {{-- facebook menu --}}
            @if(\App\Http\Controllers\Data::myPackage('fb'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-facebook"></i>
                        <span>Facebook</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li><a href="{{ url('/facebook') }}"><i class="fa fa-file"></i> Facebook Pages</a></li>
                        <li><a href="{{ url('/fbgroups') }}"><i class="fa fa-users"></i> Facebook Groups</a></li>
                        <li><a href="{{ url('/conversations') }}"><i class="fa fa-comments"></i> Conversations</a></li>
                        <li><a href="{{ url('/fbreport') }}"><i class="fa fa-pie-chart"></i> Facebook Report</a></li>
                        <li><a href="{{ url('/fbmassgrouppost') }}"><i class="fa fa-bolt"></i> Facebook Mass Group Post</a>
                        </li>
                        <li><a href="{{ url('/facebook/masscomment') }}"><i class="fa fa-comment"></i> Facebook Mass
                                Comment</a>
                        </li>
                        <li><a href="{{ url('/masssend') }}"><i class="fa fa-send"></i> Facebook Mass Send</a></li>
                        <li><a href="{{ url('scraper') }}"><i class="fa fa-magnet"></i> Facebook Scraper</a></li>


                    </ul>
                </li>
            @endif
            {{--twitter menu--}}
            @if(\App\Http\Controllers\Data::myPackage('tw'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-twitter"></i>
                        <span>Twitter</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none">
                        <li><a href="{{ url('/twitter') }}"><i class="fa fa-twitter"></i> <span>My account</span></a>
                        </li>
                        <li><a href="{{ url('/twitter/message/send') }}"><i class="fa fa-envelope"></i> <span>Send Direct Message</span></a>
                        </li>
                        <li><a href="{{ url('/twitter/masssend') }}"><i class="fa fa-envelope"></i>
                                <span>Mass Message Send</span></a></li>
                        <li><a href="{{ url('/twitter/autoretweet') }}"><i class="fa fa-retweet"></i>
                                <span>Mass Retweet</span></a></li>
                        <li><a href="{{ url('/twitter/autoreply') }}"><i class="fa fa-reply"></i>
                                <span>Mass Reply</span></a></li>
                        <li><a href="{{ url('/tw/scraper') }}"><i class="fa fa-magnet"></i> Twitter Scraper</a></li>
                    </ul>

                </li>
            @endif

            {{--instagram menu--}}
            @if(\App\Http\Controllers\Data::myPackage('in'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-instagram"></i>
                        <span>Instagram</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none">
                        <li><a href="{{ url('/instagram/me') }}"><i class="fa fa-user"></i> <span>My account</span></a>
                        <li><a href="{{ url('/instagram/home') }}"><i class="fa fa-home"></i> <span>Home</span></a>
                        <li><a href="{{ url('/instagram/popular') }}"><i class="fa fa-heart"></i><span> Popular Feed</span></a>
                        <li><a href="{{ url('/instagram/followers') }}"><i class="fa fa-star"></i><span> Followers</span></a>
                        <li><a href="{{ url('/instagram/following') }}"><i class="fa fa-star"></i><span> Following</span></a>
                        <li><a href="{{ url('/instagram/following/activity') }}"><i class="fa fa-users"></i><span> Following Activity</span></a>
                        <li><a href="{{ url('/instagram/auto/follow') }}"><i class="fa fa-user-plus"></i><span> Auto follow</span></a>
                        <li><a href="{{ url('/instagram/auto/unfollow') }}"><i class="fa fa-user-times"></i><span> Auto unfollow</span></a>
                        <li><a href="{{ url('/instagram/auto/comments') }}"><i class="fa fa-comment"></i><span> Auto comment</span></a>
{{--                        <li><a href="{{ url('/instagram/auto/message') }}"><i class="fa fa-envelope"></i><span> Auto Message</span></a>--}}
                        <li><a href="{{ url('/instagram/scraper') }}"><i class="fa fa-search"></i> <span>Scraper</span></a>
                        </li>

                    </ul>

                </li>
            @endif

            {{--linkedin menu--}}
            @if(\App\Http\Controllers\Data::myPackage('ln'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-linkedin"></i>
                        <span>Linkedin</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none">
                        <li><a href="{{ url('/linkedin/updates') }}"><i class="fa fa-refresh"></i>
                                <span>All updates</span></a>
                        </li>
                        <li><a href="{{ url('/linkedin/mass_comment') }}"><i class="fa fa-comment"></i>
                                <span>Mass Comment</span></a></li>
                    </ul>

                </li>
            @endif
            {{--tumblr menu--}}
            @if(\App\Http\Controllers\Data::myPackage('tu'))
                <li><a href="{{ url('/tumblr') }}"><i class="fa fa-tumblr"></i> <span>Tumblr</span></a></li>
            @endif
            {{--wordpress menu--}}
            @if(\App\Http\Controllers\Data::myPackage('wp'))
                <li><a href="{{ url('/wordpress') }}"><i class="fa fa-wordpress"></i> <span>Wordpress</span></a></li>
            @endif
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-calendar-check-o"></i>--}}
            {{--<span>Schedule</span>--}}
            {{--<small class="badge pull-right bg-aqua">Special <i class="fa fa-angle-left pull-right"></i></small>--}}

            {{--</a>--}}
            {{--<ul class="treeview-menu" style="display: none;">--}}
            {{--<li><a href="{{ url('/schedules') }}"><i class="fa fa-list"></i> Schedules List</a></li>--}}
            {{--<li><a href="{{ url('/scheduleslog') }}"><i class="fa fa-sticky-note"></i> Schedules Log</a></li>--}}

            {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-pie-chart"></i>--}}
            {{--<span>Reports</span><i class="fa fa-angle-left pull-right"></i>--}}

            {{--</a>--}}
            {{--<ul class="treeview-menu" style="display: none;">--}}
            {{--<li><a href="{{ url('/fbreport') }}"><i class="fa fa-files-o"></i> <span>Facebook reports</span></a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}


            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-youtube"></i>--}}
                    {{--<span>YouTube</span><i class="fa fa-angle-left pull-right"></i>--}}

                {{--</a>--}}
                {{--<ul class="treeview-menu" style="display: none;">--}}
                    {{--<li><a href="{{ url('/youtube/download') }}"><i class="fa fa-download"></i> <span>Download Video</span></a>--}}
                    {{--</li>--}}

                {{--</ul>--}}
            {{--</li>--}}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span>Notifications</span><i class="fa fa-angle-left pull-right"></i>

                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ url('/notify') }}"><i class="fa fa-bell-o"></i> <span>All Notifications</span></a>
                    </li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Settings</span><i class="fa fa-angle-left pull-right"></i>

                </a>
                <ul class="treeview-menu" style="display: none;">

                    <li><a href="{{ url('/settings') }}"><i class="fa fa-gear"></i> <span>Social</span></a></li>
                    <li><a href="{{ url('/settings/notifications') }}"><i class="fa fa-bell"></i>
                            <span>Notifications</span></a></li>
                    {{--<li><a href="{{ url('/settings/config') }}"><i class="fa fa-gears"></i>--}}
                    {{--<span>Configurations</span></a>--}}
                    {{--</li>--}}

                    <li><a href="{{ url('/profile') }}"><i class="fa fa-user"></i> <span>Profile</span></a></li>


                </ul>
            </li>
            {{--@if(Auth::user()->type == 'admin')--}}
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-users"></i>--}}
            {{--<span>Users</span><i class="fa fa-angle-left pull-right"></i>--}}

            {{--</a>--}}
            {{--<ul class="treeview-menu" style="display: none;">--}}
            {{--<li><a href="{{ url('/user/add') }}"><i class="fa fa-user-plus"></i> <span>Add user</span></a>--}}
            {{--</li>--}}
            {{--<li><a href="{{ url('/user/list') }}"><i class="fa fa-user"></i><span>User List</span></a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}

            {{--@endif--}}
            <li><a href="{{ url('/profile') }}"><i class="fa fa-user"></i> <span>Profile</span></a></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
