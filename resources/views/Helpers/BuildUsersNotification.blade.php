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
                <div style="padding-left: 10px; padding-right:10px;">
                    <!-- User Image -->
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <!-- The message -->
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <p class="card-body">
                                        {{strlen($notification->data['message'])>30 ? substr($notification->data['message'] ,0,30 ). " ... " : $notification->data['message'] }}
                                        <small class="pull-right" style="color:rgb(49, 49, 49)">{{ $notification->created_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </li>
            <!-- end message -->
        </ul>
        <!-- /.menu -->
    </li>
    <li><a class="btn btn-success" href="{{ route('markasread') }}">@lang("Mark
            as read")</a></li>
</ul>
