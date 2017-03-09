@extends('layouts.app')
@section('title','Schedule days | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="box box-primary" style="padding:20px">
                        <form action="{{url('/schedule/filter')}}" method="post">
                            From
                            <input @if(isset($_POST['from'])) value="{{$_POST['from']}}" @endif type="date" name="from">
                            To
                            <input @if(isset($_POST['to'])) value="{{$_POST['to']}}" @endif type="date" name="to">


                            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                            <div class="btn-group">
                                <a href="{{url('/schedule/filter/week')}}" class="btn btn-success"><i
                                            class="fa fa-filter"></i> This week</a>
                                <a href="{{url('/schedule/filter/month')}}" class="btn btn-warning"><i
                                            class="fa fa-filter"></i> This month</a>
                                {{--<a href="{{url('/schedule/filter/all')}}" class="btn btn-default"><i--}}
                                {{--class="fa fa-list"></i> All</a>--}}
                            </div>
                        </form>


                    </div>

                </div>
                @foreach(array_chunk($data,7) as $d)
                    <?php $count = count($d) ;?>
                    <div class="row @if($count < 7) daysboxExtra @else daysbox @endif">
                        @foreach($d as $a)

                            <div class="@if($count < 7) dayBoxExtra @else dayBox @endif">
                                <div class="dayHead">
                                    {{--Monday--}}
                                    {{\Carbon\Carbon::parse($a)->format('l')}}
                                    <a style="color:red">{{\Carbon\Carbon::parse($a)->format('jS F')}}</a>

                                    {{--@if(\Carbon\Carbon::parse($a)->format('l') == "Monday")--}}
                                    {{--{{\Carbon\Carbon::parse($a)->format('jS F ')}}--}}
                                    {{--@endif--}}
                                </div>

                                @foreach(\App\OptSchedul::where('userId',Auth::user()->id)->where('date',$a)->get() as $da)
                                    <div class="row">
                                        <div class="sContainer colorFb">
                                            <span class="sTime">{{\Carbon\Carbon::parse($da->time)->toTimeString()}}</span>
                                            @if($da->image != "")
                                                <img src="{{url('/uploads')}}/{{$da->image}}">
                                            @else
                                                <br>
                                            @endif
                                            <h4>
                                                @if($da->fb == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @elseif($da->fbg == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @elseif($da->tw == "yes")
                                                    <i class="fa fa-twitter"></i>
                                                @elseif($da->tu == "yes")
                                                    <i class="fa fa-tumblr"></i>
                                                @elseif($da->wp == "yes")
                                                    <i class="fa fa-wordpress"></i>
                                                @elseif($da->instagram == "yes")
                                                    <i class="fa fa-instagram"></i>
                                                @else
                                                    <i class="fa fa-times"></i>
                                                @endif

                                                {{$da->title}}</h4>
                                            <p>
                                                {{$da->content}}
                                            </p>
                                            @if($da->published == "yes")
                                                <button type="button" class="btn btn-block btn-xs bg-olive">Published
                                                </button>
                                            @else
                                                <button data-id="{{$da->id}}" type="button"
                                                        class="btn btn-block btn-warning btn-xs scheduled">
                                                    Scheduled
                                                </button>
                                                <div id="{{$da->id}}" style="display:none;" align="center">
                                                    <hr>
                                                    <input type="datetime-local" value="{{\Carbon\Carbon::parse($da->time)->format("Y-m-d\TH:i:s")}}" class="time_{{$da->id}}" id="time">
                                                    <hr>
                                                    <div class="btn-group">
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn btnSave  btn-primary btn-xs">Save
                                                        </button>
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn  btn-danger btn-xs">Close
                                                        </button>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{--<div class="dayBox">--}}
                            {{--<div class="dayHead">--}}
                            {{--Tuesday--}}

                            {{--@if(\Carbon\Carbon::parse($d)->format('l') == "Tuesday")--}}
                            {{--{{\Carbon\Carbon::parse($d)->format('jS F ')}}--}}
                            {{--@endif--}}
                            {{--</div>--}}

                            {{--</div>--}}
                            {{--<div class="dayBox">--}}
                            {{--<div class="dayHead">--}}
                            {{--Wednesday--}}

                            {{--@if(\Carbon\Carbon::parse($d)->format('l') == "Wednesday")--}}
                            {{--{{\Carbon\Carbon::parse($d)->format('jS F ')}}--}}
                            {{--@endif--}}
                            {{--</div>--}}




                            {{--</div>--}}
                            {{--<div class="dayBox">--}}
                            {{--<div class="dayHead">--}}
                            {{--Thursday--}}

                            {{--@if(\Carbon\Carbon::parse($d)->format('l') == "Thursday")--}}
                            {{--{{\Carbon\Carbon::parse($d)->format('jS F ')}}--}}
                            {{--@endif--}}
                            {{--</div>--}}


                            {{--</div>--}}
                            {{--<div class="dayBox">--}}
                            {{--<div class="dayHead">--}}
                            {{--Friday--}}

                            {{--@if(\Carbon\Carbon::parse($d)->format('l') == "Friday")--}}
                            {{--{{\Carbon\Carbon::parse($d)->format('jS F ')}}--}}
                            {{--@endif--}}
                            {{--</div>--}}



                            {{--</div>--}}
                            {{--<div class="dayBox">--}}
                            {{--<div class="dayHead">--}}
                            {{--Saturday--}}

                            {{--@if(\Carbon\Carbon::parse($d)->format('l') == "Saturday")--}}
                            {{--{{\Carbon\Carbon::parse($d)->format('jS F ')}}--}}
                            {{--@endif--}}
                            {{--</div>--}}


                            {{--</div>--}}
                            {{--<div class="dayBoxLast">--}}
                            {{--<div class="dayHead">--}}
                            {{--Sunday--}}

                            {{--@if(\Carbon\Carbon::parse($d)->format('l') == "Sunday")--}}
                            {{--{{\Carbon\Carbon::parse($d)->format('jS F ')}}--}}
                            {{--@endif--}}

                            {{--</div>--}}

                            {{----}}


                            {{--</div>--}}


                        @endforeach
                    </div>
                    <br>
                @endforeach
            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('css')
    <style>
        .row {
            margin: 0px !important;
            padding: 0px !important;
        }

        .dayBox {
            position: relative;
            width: 100%;

            padding: 5px;
            min-height: 150px;
            border-right: 2px dashed darkgray;
            border-left: 2px dashed darkgray;
        }

        .dayBoxExtra{
            position: relative;
            width: 14.3% !important;
            padding: 5px;
            min-height: 150px;
            border-right: 2px dashed darkgray;
            border-left: 2px dashed darkgray;
        }

        .dayBoxLast {
            position: relative;
            width: 100%;

            padding: 5px;

            min-height: 150px;

        }

        .daysbox {
            display: flex;
            margin: 5px;
            justify-content: space-between;
            background-color: gainsboro;
            border-radius: 3px;

        }

        .daysboxExtra {
            display: flex;
            margin: 5px;
            justify-content: flex-start;
            background-color: gainsboro;
            border-radius: 3px;

        }



        .dayHead {
            /*position: absolute;*/
            /*top:0px;*/
            border-bottom: 2px dashed darkgray;
            text-align: center;
            font-weight: bolder;
        }

        .sContainer {
            position: relative;
            background-color: white;
            padding: 5px;
            margin: 5px;
            border-radius: 5px;
            box-shadow: 0px 14px 18px 0px rgba(75, 77, 81, 0.14);
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .sContainer img {
            width: 100%;
        }

        .sTime {
            background-image: -moz-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            background-image: -webkit-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            background-image: -ms-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            box-shadow: 0px 14px 18px 0px rgba(234, 54, 104, 0.14);
            border-radius: 5px;
            padding: 2px 5px;
            font-weight: bolder;
            color: white;
            position: absolute;
            z-index: 14;

        }

        .Rounded_Rectangle_3 {
            background-image: -moz-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            background-image: -webkit-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            background-image: -ms-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            box-shadow: 0px 14px 18px 0px rgba(234, 54, 104, 0.14);
            position: absolute;
            left: 612px;
            top: 215px;
            width: 166px;
            height: 51px;
            z-index: 10;
        }

        .colorFb {
            border-bottom: 3px solid #4267B2;
        }

        .colorTw {
            border-bottom: 3px solid #1DA1F2;
        }

    </style>
@endsection

@section('js')
    <script>
        var s = $("#time").val();
        var startDate = new Date(s.replace(/-/g,'/').replace('T',' '));


        flatpickr(".tt", {
            minDate: new Date(), // "today" / "2016-12-20" / 1477673788975
            maxDate: "2017-12-20",
            enableTime: true,
            wrap: true,
            // create an extra input solely for display purposes
            altInput: true,
            altFormat: "F j, Y h:i K",
            time_24hr: false
        });
        $('.scheduled').click(function () {
            var id = $(this).attr('data-id');
            $('#' + id).toggle(200);
        });

        $('.btn-danger').click(function () {
            var id = $(this).attr('data-id');
            $('#' + id).toggle(200);
        });

        $('.btnSave').click(function () {
            var id = $(this).attr('data-id');
            var sTime = $('.time_'+id).val();
//            return alert("ID" + id + " and time " +sTime);
            $.ajax({
                url: '{{url('/schedule/time/update')}}',
                type: 'POST',
                data: {
                    'id': id,
                    'time': sTime
                },
                success: function (data) {
                    if (data == 'success') {
                        swal("Success", 'Time updated', 'success');
                    } else {
                        swal('Error!', data, 'error');
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong check the console message", 'error');
                    console.log(data.responseText);

                }
            });
        })

    </script>
@endsection