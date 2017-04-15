@foreach(array_reverse($response['messages']['data']) as $data)
    <div class="direct-chat-msg @if($data['from']['id'] == $me)right @endif">
        <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-@if($data['from']['id'] == $me)right @else left @endif">{{$data['from']['name']}}</span>
            <span class="direct-chat-timestamp pull-@if($data['from']['id'] == $me)left @else right @endif">{{\App\Http\Controllers\Prappo::date($data['created_time'])}}</span>
        </div>
        <!-- /.direct-chat-info -->
        @foreach($response['participants']['data'] as $par)

        @endforeach

        <div class="direct-chat-text">
            {{$data['message']}}
        </div>
        <!-- /.direct-chat-text -->
    </div>
@endforeach