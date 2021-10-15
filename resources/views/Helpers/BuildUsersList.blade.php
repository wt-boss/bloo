
@foreach($users as $item)
<a class='operateur' id='{{$item->id}}'>
    <div class="cir-image">
        <div class="widget-user-image text-center op-msg-list operation" ">
            <img src="{{$item->avatar}}" alt="avatar_image" class="img-circle" " height="50px" width="auto">
            <p style="color: #6F6F6F"  class='name'>{{substr($item->first_name, 0, 50)}} {{substr($item->last_name, 0, 50)}} </p>
            <p style="color: #6F6F6F" class='email'>{{substr($item->email, 0, 24)}}</p>
        </div>
    </div>
</a>
@endforeach


