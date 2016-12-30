@foreach($datas->users as $data)
    <div class="row">
        <div class="col-md-6">
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{$data->profile_pic_url}}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{$data->full_name}}</h3>
                    <h5 class="widget-user-desc">{{$data->username}}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Follower Count <span
                                        class="pull-right badge bg-blue">{{$data->follower_count}}</span></a></li>
                        <li><a href="#">Mutual Followers Count <span
                                        class="pull-right badge bg-aqua">{{$data->mutual_followers_count}}</span></a>
                        </li>
                        <li><a style="color: white" target="_blank" class="btn btn-primary btn-block btn-xs" href="https://instagram.com/{{$data->username}}">View Profile</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach