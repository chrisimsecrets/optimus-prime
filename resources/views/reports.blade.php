@extends('layouts.app')
@section('title','Reports')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-facebook"></i> Facebook report</h3>

                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>

                                    <div class="btn-group">
                                        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i
                                                    class="fa fa-wrench"></i></button>

                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>

                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center">
                                            <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                        </p>
                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="salesChart" style="height: 180px;"></canvas>
                                        </div><!-- /.chart-responsive -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- ./box-body -->

                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-twitter"></i> Twitter report</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i
                                                    class="fa fa-wrench"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center">
                                            <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                        </p>
                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="salesChart" style="height: 180px;"></canvas>
                                        </div><!-- /.chart-responsive -->
                                    </div><!-- /.col -->

                                </div><!-- /.row -->
                            </div><!-- ./box-body -->

                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-tumblr"></i> Tumblr report</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i
                                                    class="fa fa-wrench"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center">
                                            <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                        </p>
                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="salesChart" style="height: 180px;"></canvas>
                                        </div><!-- /.chart-responsive -->
                                    </div><!-- /.col -->

                                </div><!-- /.row -->
                            </div><!-- ./box-body -->

                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-wordpress"></i> Wordpress report</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i
                                                    class="fa fa-wrench"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center">
                                            <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                        </p>
                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="salesChart" style="height: 180px;"></canvas>
                                        </div><!-- /.chart-responsive -->
                                    </div><!-- /.col -->

                                </div><!-- /.row -->
                            </div><!-- ./box-body -->

                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>

        @include('components.footer')
    </div>

@endsection