@extends('layouts.app')
@section('title','Twitter Send Message')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input data-step="1" data-intro="Type username " type="text" class="form-control"
                                   placeholder="Type User Name" id="user"><br>
                            <textarea class="form-control" rows="4"
                                      id="status"
                                      data-step="2"
                                      data-intro="Type message whatever you want to send"
                                      placeholder="Type your content here ..."></textarea>
                        </div>
                        <button id="send" class="btn btn-success"><i class="fa fa-send"></i> Send Message
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('#send').click(function(){
        $(this).html('Please wait .....');
       $.ajax({
         type:'POST',
           url:'{{url('/twitter/message')}}',
           data:{
               'username':$('#user').val(),
               'text':$('#status').val()
           },
           success:function (data) {
               if(data=='success'){
                   swal('Success','Message sent','success');
                   $('#send').html('<i class="fa fa-send"></i> Send Message');
               }
               else{
                   swal('Error',data,'error');
                   $('#send').html('<i class="fa fa-send"></i> Send Message');
               }
           }
       });
    });
</script>
@endsection
@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection