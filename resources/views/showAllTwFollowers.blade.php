@extends('layouts.app')
@section('title','Likes and Followers')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- USERS LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Twitter Followers</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-primary">Twitter followers</span>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix" id="twFolList">

                        <div id="loading" class="overlay">
                            Please wait ......
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </ul><!-- /.users-list -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="#" class="uppercase">View All Users</a>
                </div><!-- /.box-footer -->
            </div><!--/.box -->
        </div><!-- /.col -->


    </div>





@endsection

@section('js')
    <script>
        $.ajax({
            type: 'GET',
            url: 'showalltwfollowers',
            success:function(data){
                if(data =='error'){
                    $('#twFolList').html("Something went wrong");
                    $('#loading').hide(200);
                }
                else{
                    $('#twFolList').html(data);
                    $('#loading').hide(200);
                }
            }
        });

    </script>

@endsection
