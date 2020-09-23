
@foreach($items as $item)
<li class='user' data-id='{{$item->id}}'>
    <div class='media'>
        <div class='media-left'>
            <img src='{{$item->avatar}}' alt='' class='media-object'>
        </div>
        <div class='media-body'>
            <p class='name'>{{substr($item->first_name, 0, 50)}} {{substr($item->last_name, 0, 50)}} </p>
            <p class='email'>{{substr($item->email, 0, 24)}}</p>
        </div>
    </div>
</li>
@endforeach

