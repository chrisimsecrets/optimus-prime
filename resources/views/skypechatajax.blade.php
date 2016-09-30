@foreach(array_reverse($messages['messages']) as $no => $message)
    <div class="direct-chat-msg @if($userId != \App\Http\Controllers\Prappo::getSkypeName($message['from'])) right @endif">
        <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-left">{{\App\Http\Controllers\Prappo::getSkypeName($message['from'])}}</span>
            <span class="direct-chat-timestamp pull-right">{{\App\Http\Controllers\Prappo::date($message['composetime'])}}</span>
        </div>
        <!-- /.direct-chat-info -->
        <img class="direct-chat-img" src="{{\App\Http\Controllers\Prappo::getSkypeImg(\App\Http\Controllers\Prappo::getSkypeName($message['from']))}}" alt="message user image"><!-- /.direct-chat-img -->
        <div class="direct-chat-text">
            {!!$message['content'] !!}
        </div>
        <!-- /.direct-chat-text -->
    </div>
@endforeach