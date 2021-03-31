<!-- Menu toggle button -->
<a href="#" class="dropdown-toggle h-notif" data-toggle="dropdown">
    <i class="fas fa-bell"></i>
    <span
        class="label label-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
</a>

<ul class="dropdown-menu">
    <li class="header">@lang("You have")
        @php
            $count = auth()
                ->user()
                ->unreadNotifications->count();
        @endphp
        @if ($count === 0)
            {{ $count }} notification
        @else
            {{ $count }} notifications
        @endif
    </li>
    <li>
        <!-- inner menu: contains the messages -->
        <ul class="menu">
            <li>
                <!-- start message -->
                <a href="#">
                    <div class="pull-left">
                        <!-- User Image -->
                        @foreach ($notifications as $notification)
                            <!-- Message title and timestamp -->
                            <h4 class="pull-right">
                                <small><i
                                        class="fa fa-clock-o"></i>{{ $notification->created_at }}</small>
                                <br>
                            </h4>
                            <!-- The message -->
                            <p> {{ $notification->data['message'] }} </p>
                        @endforeach
                    </div>
                </a>
            </li>
            <!-- end message -->
        </ul>
        <!-- /.menu -->
    </li>
    <li><a class="btn btn-success" href="{{ route('markasread') }}">@lang("Mark
            as read")</a></li>
</ul>
