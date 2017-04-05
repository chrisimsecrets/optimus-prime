@extends('layouts.app')
@section('title','Spam Defender')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                {{--message preview section --}}
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-pie-chart"></i> Statistic</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">Comments will be automatically deleted if <kbd>Black listed
                                    words</kbd> found
                            </li>
                            <li class="list-group-item">Comment with <kbd>White listed URLs</kbd> will not be removed
                                otherwise all comments with URLs will be removed
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Spam Defender</div>
                    <div class="panel-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Spam Defender</label>
                                <div class="col-md-6">
                                    <select id="spamDefender" class="form-control">
                                        <option value="on"
                                                @if(\App\Http\Controllers\SettingsController::get('spamDefender') == 'on') selected @endif>
                                            On
                                        </option>
                                        <option value="off"
                                                @if(App\Http\Controllers\SettingsController::get('spamDefender') == 'off') selected @endif>
                                            Off
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <label class="control-label"><input id="autoDelete"
                                                                        @if(\App\Http\Controllers\SettingsController::get('autoDelete') == 'on') checked
                                                                        @endif type="checkbox"> Delete automatically
                                        spam
                                        comments</label>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Black Listed Words </label>
                                <div class="col-md-6">
                                    <textarea placeholder="Write words separated by commas" id="blackList"
                                              class="form-control" rows="3">{{\App\Http\Controllers\SettingsController::get('words')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">White Listed URLs</label>
                                <div class="col-md-6">
                                    <textarea id="whiteList" placeholder="Wirte URLs separated by commas"
                                              class="form-control" rows="4">{{\App\Http\Controllers\SettingsController::get('urls')}}</textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="save" class="btn btn-primary">
                                        <i class="fa fa-btn fa-bug"></i> Save
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
    $('#save').click(function () {
        var autoDelete;
        if($('#autoDelete').is(':checked')){
            autoDelete = "on";
        }else{
            autoDelete = "off";
        }

        $.ajax({
            type:'PUT',
            url:'{{url('/settings/spam')}}',
            data:{
                'autoDelete':autoDelete,
                'spamDefender':$('#spamDefender').val(),
                'blackList':$('#blackList').val(),
                'whiteList':$('#whiteList').val(),
                '_token':'{{csrf_token()}}'
            },
            success:function (data) {
                if(data=='success'){
                    alert('Saved');
                    location.reload();
                }else{
                    alert(data);
                }
            },
            error:function (data) {
                alert('Something went wrong , please check the console log');
                console.log(data.responseText);
            }
        })

    })
    </script>
@endsection
