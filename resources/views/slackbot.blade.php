@extends('layouts.app')

@section('title','Slack Bot')

@section('content')
    <div class="wrapper">
        @include('components.navigation')

        @include('components.sidebar')

        <div id="slack-bot"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Slack Bot</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <form method="POST" action="{{ url('/add-slack-question') }}" id="add-slack-question">
                                {{ csrf_field() }}

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="question">Message</label>
                                        <input type="text" class="form-control" id="question" placeholder="User Message">
                                        <p class="help-block">
                                            Separate using comma (ex: hi, hello) for multiple message.
                                        </p>
                                    </div>
                                    <input type="text" id="userId" name="userId" value="{{Auth::user()->id}}">
                                    <div class="form-group">
                                        <label for="answer">Reply</label>
                                        <textarea type="text" class="form-control" id="answer" placeholder="Message's Reply"></textarea>
                                        <p class="help-block">You can also format message.</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="channel">For Channel</label>
                                        <input type="text" class="form-control" id="channel" placeholder="#channel-name">
                                        <p class="help-block">Separate using comma (ex: #marketing, #developer) for multiple channel.</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="accuracy">Accuracy %</label>
                                        <input type="number" class="form-control" id="accuracy" placeholder="Matching accuracy for this message">
                                        <p class="help-block">Leave blank to use the default.</p>
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button id="addData" class="btn btn-primary"><i class="fa fa-plus"></i> Add reply
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6 visible-lg">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Reply message formatting.</h3>
                            </div>

                            <div class="box-body">
                                <ul>
                                    <li>
                                        You can mention a user.<br>

                                        <code>Hey <strong>{{ '<@john>' }}</strong>, did you see my file?</code>
                                    </li>

                                    <li>
                                        You can add link to the reply.<br>
                                        <code>Visit our website <strong>{{ '<http://google.com|Google>' }}</strong></code>
                                    </li>

                                    <li>
                                        You can reply multiple line message.<br>
                                        <code>This is a line of text.<strong><code>\n</code></strong> And this is another one.</code>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="text-center">
                            <img height="250" width="250" src="{{url('/images/optimus/social/optmeslack.png')}}">
                            <h3>Optimus Prime Slack chat bot</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- /.box -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Slack Bot Config</h3>
                            </div>

                            <div class="box-body">
                                <form method="POST" action="update-slack-bot-config" id="bot-config-form">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="matchAcc">Default accuracy %</label>
                                        <input type="number" value="{{\App\Http\Controllers\Data::get('slackBotMatchAcc')}}"
                                               class="form-control" id="matchAcc" placeholder="Matching accuracy for messages">
                                        <p class="help-block">Recommend: 75</p>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button id="saveConfig" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Available questions and answers</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-striped table-bordered dt-responsive slack-bot-messages" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Message</th>
                                            <th>Reply</th>
                                            <th>Channel</th>
                                            <th>Accuracy</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($data as $index => $d)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $d->question }}</td>
                                                <td>{{ $d->answer }}</td>
                                                <td>{{ $d->channel }}</td>
                                                <td>{{ !empty($d->accuracy) ? $d->accuracy : 'Default' }}</td>
                                                <td>
                                                    <a class="delete-slack-question"data-id="{{$d->id}}" href="#">
                                                        <span class="badge bg-red">
                                                            <i class="fa fa-times"></i> Delete
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Message</th>
                                            <th>Reply</th>
                                            <th>Channel</th>
                                            <th>Accuracy</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection
