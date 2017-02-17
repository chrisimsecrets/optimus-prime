@extends('layouts.app')
@section('title','Schedule days | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row daysbox">
                    <div class="dayBox">
                        <div class="dayHead">
                            Monday
                        </div>


                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Tuesday
                        </div>
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Wednesday
                        </div>
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Thursday
                        </div>
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Friday
                        </div>
                        <div class="row">
                            <div class="sContainer colorFb">
                                <span class="sTime">2017-01-11 12:30</span>
                                <img src="https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-0/p480x480/16684388_1453736817978720_1889951800592650817_n.png?oh=4645b6b4c051d7a56180b0a9c002afeb&oe=59393FEB">
                                <h4><i class="fa fa-facebook-official"></i> Some Title</h4>
                                <p>
                                    Lorem ipsum dolor sit amet.
                                </p>
                                <button data-id="2" type="button" class="btn btn-block btn-warning btn-xs">Scheduled
                                </button>
                                <div id="2" style="display:;"  align="center">
                                    <hr>
                                    <input type="text" id="time">
                                    <hr>
                                    <div class="btn-group">
                                        <button type="button" class="btn  btn-primary btn-xs">Save</button>
                                        <button type="button" class="btn  btn-danger btn-xs">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Saturday
                        </div>
                        <br>
                    </div>
                    <div class="dayBoxLast">
                        <div class="dayHead">
                            Sunday

                        </div>
                        <div class="row">
                            <div class="sContainer colorTw">
                                <span class="sTime">2017-01-19 12:30</span>
                                <img src="https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-0/p480x480/16684388_1453736817978720_1889951800592650817_n.png?oh=4645b6b4c051d7a56180b0a9c002afeb&oe=59393FEB">
                                <h4><i class="fa fa-twitter"></i> Some Title</h4>
                                <p>
                                    Lorem ipsum dolor sit amet.
                                </p>
                                <button type="button" class="btn btn-block btn-xs bg-olive">Published</button>

                            </div>
                        </div>

                        <div class="row">
                            <div class="sContainer colorTw">
                                <span class="sTime">2017-01-15 3:30</span>
                                <img src="https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-0/p480x480/16684388_1453736817978720_1889951800592650817_n.png?oh=4645b6b4c051d7a56180b0a9c002afeb&oe=59393FEB">
                                <h4><i class="fa fa-twitter"></i> Some Title</h4>
                                <p>
                                    Lorem ipsum dolor sit amet.
                                </p>
                                <button type="button" class="btn btn-block btn-xs bg-olive">Published</button>

                            </div>
                        </div>


                        <div class="row">
                            <div class="sContainer colorTw">
                                <span class="sTime">2017-01-11 01:30</span>
                                <img src="https://scontent-sin6-1.xx.fbcdn.net/v/t1.0-0/p480x480/16684388_1453736817978720_1889951800592650817_n.png?oh=4645b6b4c051d7a56180b0a9c002afeb&oe=59393FEB">
                                <h4><i class="fa fa-twitter"></i> Some Title</h4>
                                <p>
                                    Lorem ipsum dolor sit amet.
                                </p>
                                <button type="button" class="btn btn-block btn-xs bg-olive">Published</button>

                            </div>
                        </div>



                    </div>
                </div>

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
            min-height: 500px;
            border-right: 2px dashed darkgray;
        }

        .dayBoxLast {
            position: relative;
            width: 100%;

            padding: 5px;

            min-height: 500px;

        }

        .daysbox {
            display: flex;
            margin: 5px;
            justify-content: space-between;
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
        flatpickr("#time", {
            minDate: new Date(), // "today" / "2016-12-20" / 1477673788975
            maxDate: "2017-12-20",
            enableTime: true,

            // create an extra input solely for display purposes
            altInput: true,
            altFormat: "F j, Y h:i K",
            time_24hr: false
        });

    </script>
@endsection