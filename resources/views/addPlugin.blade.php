@extends('layouts.app')
@section('title','Add Plugin | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <div align="center">
                    <div id="pluginopt" data-step="5"
                         data-intro="Select your plugin file that you want to upload"
                         class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="uploadPlugin" method="post" enctype="multipart/form-data">
                                    <label><h1><i class="fa fa-puzzle-piece"></i></h1><h4> Select Plugin file</h4>
                                    </label><br/>
                                    <input class="" type="file" name="file"
                                           id="file"/><br>
                                    <button class="btn btn-xs btn-success" type="submit"
                                            id="pluginUploadBtn"><i class="fa fa-upload"></i> Upload
                                    </button>
                                    <input value="" type="hidden" id="image">
                                    <div id="Msg"></div>
                                </form>
                            </div>

                        </div>
                    </div>

                    {{-- progressbar --}}
                    <div style="display: none" id="progress" class="progress progress-sm active">
                        <div id="bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                             aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            <span class="sr-only">Uploading .......</span>
                        </div>
                    </div>
                </div>
                {{-- block 1 end--}}

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')
    <script>
        $("#uploadPlugin").on('submit', (function (e) {
            e.preventDefault();
            $('#progress').show();
            $('#bar').css('width', '30%');

            $.ajax({
                url: "{{url('/plugin/upload')}}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data['status'] == 'success') {
                        swal('Success!', 'Image File successfully uploaded', 'success');
                        $('#bar').css('width', '100%');

                    }
                    else {
                        swal('Error!', data, 'error');
                        $('#Msg').html("Something went wrong can't upload plugin");
                        $('#bar').css('width', '0%');

                    }
                }
            });
            $('#progress').hide();
            $('#bar').css('width', '0%');
        }));
    </script>
@endsection