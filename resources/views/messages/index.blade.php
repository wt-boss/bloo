<div class="message-wrapper" style:"padding: 10px; height: 427px; background: #fff;}">
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
        <div class="col-md-11  col-xs-10">
            <input type="text" id="msginput" name="message" class="submit"/>

        </div>
        <div class="col-md-1  col-xs-2" style="padding-top: 18px;padding-right: -4px;padding-left: 0px;font-size: 23px;" >
            <button id="send"> <i class="fa fa-paper-plane"></i></button>
           </div>
    </div>
</div>
