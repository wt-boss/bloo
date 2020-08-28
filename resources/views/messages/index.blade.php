<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <div class="{{ ($message->user_id == Auth::id()) ? 'sent' : 'received' }}">
                    <p>{{ $message->message }}</p>
                    <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<div class="input-text">
    <div class="row">
        <div class="col-md-11">
            <input type="text" name="message" class="submit"/>

        </div>
        <div class="col-md-1"><i id="send" class="fa fa-paper-plane"></i></div>
    </div>
</div>
