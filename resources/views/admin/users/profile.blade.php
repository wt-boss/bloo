@extends('admin.top-nav')

@section('page_title', trans('Profile'))
@section('title', 'Accueil')

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
{{--    <style>--}}
{{--        /* width */--}}
{{--        ::-webkit-scrollbar {--}}
{{--            width: 7px;--}}
{{--        }--}}

{{--        /* Track */--}}
{{--        ::-webkit-scrollbar-track {--}}
{{--            background: #f1f1f1;--}}
{{--        }--}}

{{--        /* Handle */--}}
{{--        ::-webkit-scrollbar-thumb {--}}
{{--            background: #a7a7a7;--}}
{{--        }--}}

{{--        /* Handle on hover */--}}
{{--        ::-webkit-scrollbar-thumb:hover {--}}
{{--            background: #929292;--}}
{{--        }--}}

{{--        ul {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--        }--}}

{{--        li {--}}
{{--            list-style: none;--}}
{{--        }--}}

{{--        .user-wrapper,--}}
{{--        .message-wrapper {--}}
{{--            border: 1px solid #dddddd;--}}
{{--            overflow-y: auto;--}}
{{--        }--}}

{{--        .user-wrapper {--}}
{{--            height: 600px;--}}
{{--        }--}}

{{--        .user {--}}
{{--            cursor: pointer;--}}
{{--            padding: 5px 0;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .user:hover {--}}
{{--            background: #eeeeee;--}}
{{--        }--}}

{{--        .user:last-child {--}}
{{--            margin-bottom: 0;--}}
{{--        }--}}

{{--        .pending {--}}
{{--            position: absolute;--}}
{{--            left: 13px;--}}
{{--            top: 9px;--}}
{{--            background: #b600ff;--}}
{{--            margin: 0;--}}
{{--            border-radius: 50%;--}}
{{--            width: 18px;--}}
{{--            height: 18px;--}}
{{--            line-height: 18px;--}}
{{--            padding-left: 5px;--}}
{{--            color: #ffffff;--}}
{{--            font-size: 12px;--}}
{{--        }--}}

{{--        .media-left {--}}
{{--            margin: 0 10px;--}}
{{--        }--}}

{{--        .media-left img {--}}
{{--            width: 64px;--}}
{{--            border-radius: 64px;--}}
{{--        }--}}

{{--        .media-body p {--}}
{{--            margin: 6px 0;--}}
{{--        }--}}

{{--        .message-wrapper {--}}
{{--            padding: 10px;--}}
{{--            height: 536px;--}}
{{--            background: #eeeeee;--}}
{{--        }--}}

{{--        .messages .message {--}}
{{--            margin-bottom: 15px;--}}
{{--        }--}}

{{--        .messages .message:last-child {--}}
{{--            margin-bottom: 0;--}}
{{--        }--}}

{{--        .received,--}}
{{--        .sent {--}}
{{--            width: 45%;--}}
{{--            padding: 3px 10px;--}}
{{--            border-radius: 10px;--}}
{{--        }--}}

{{--        .received {--}}
{{--            background: #ffffff;--}}
{{--        }--}}

{{--        .sent {--}}
{{--            background: #3bebff;--}}
{{--            float: right;--}}
{{--            text-align: right;--}}
{{--        }--}}

{{--        .message p {--}}
{{--            margin: 5px 0;--}}
{{--        }--}}

{{--        .date {--}}
{{--            color: #777777;--}}
{{--            font-size: 12px;--}}
{{--        }--}}

{{--        .active {--}}
{{--            background: #eeeeee;--}}
{{--        }--}}

{{--        input[type=text] {--}}
{{--            width: 100%;--}}
{{--            padding: 12px 20px;--}}
{{--            margin: 15px 0 0 0;--}}
{{--            display: inline-block;--}}
{{--            border-radius: 4px;--}}
{{--            box-sizing: border-box;--}}
{{--            outline: none;--}}
{{--            border: 1px solid #cccccc;--}}
{{--        }--}}

{{--        input[type=text]:focus {--}}
{{--            border: 1px solid #aaaaaa;--}}
{{--        }--}}

{{--    </style>--}}
@endsection

@section('laraform_script2')
    {{-- <script src="{{ asset('assets/js/core/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/datatable.js') }}"></script>
    <script>
        $(function() {
            $('.datatable').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [
                    {
                        className: 'control',
                        orderable: false,
                        targets:   0
                    },
                    {
                        orderable: false,
                        targets: [-1]
                    },
                    { responsivePriority: 1, targets: 0 },
                ],
            });

            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });
        });
    </script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('1702f90c00112df631a4', {
                cluster: 'ap2'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                //alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());

                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();

                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
            });

            $(document).on('keyup', '.input-text input', function (e) {
                var message = $(this).val();

                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty

                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {

                        },
                        error: function (jqXHR, status, err) {},
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                }
            });
        });

        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }

    </script>
    <script type="text/javascript">
        function affCache(idDiv) {
            var div = document.getElementById(idDiv);
            if (div.style.display === "none"){
                div.style.display = "";
            }
        }
        $('#country').on('change', function(e){
            console.log(e);
            var country_id = e.target.value;
            affCache('div_region');
            $.get('/json-states?country_id=' + country_id,function(data) {
                console.log(data);
                $('#region').empty();
                $.each(data, function(index, stateObj){
                    $('#region').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                });
                $('#region').on('change', function(e){
                    console.log(e);
                    var state_id = e.target.value;
                    affCache('div_ville');
                    $.get('/json-cities?state_id=' + state_id,function(data) {
                        console.log(data);
                        $('#ville').empty();
                        $.each(data, function(index, villeObj){
                            $('#ville').append('<option value="'+ villeObj.id +'">'+ villeObj.name +'</option>');
                        })
                    });
                });
            });

        });
    </script>
@endsection

@section('content')
    @include('partials.alert', ['name' => 'index'])
    <div class="panel panel-flat panel-wb">
        <div class="panel-body" style="padding: 0;">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ auth()->user()->avatar }}" alt="Photo de profil utilisateur">

                            <h3 class="profile-username text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</font></font></h3>

                            <p class="text-muted text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{Helper::getRolename(auth()->user()->role)}}</font></font></p>

                            <ul class="list-group list-group">
                                <li class="list-group-item">
                                    <b><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{auth()->user()->email}}</font></font></b> <a class="pull-right"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></a>
                                </li>
                                <li class="list-group-item">
                                    <b><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">   {{ trans('operations') }}     </font></font> </b> <span class="badge badge-info">{{$operations->count()}}</span>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
{{--                @if (auth()->user()->hasRole('Superadmin|Account Manager|Opérateur'))--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="container-fluid">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="user-wrapper">--}}
{{--                                    <ul class="users">--}}
{{--                                        @foreach($users as $user)--}}
{{--                                            <li class="user" id="{{ $user->id }}">--}}
{{--                                                --}}{{--will show unread count notification--}}
{{--                                                @if($user->unread)--}}
{{--                                                    <span class="pending">{{ $user->unread }}</span>--}}
{{--                                                @endif--}}
{{--                                                <div class="media">--}}
{{--                                                    <div class="media-left">--}}
{{--                                                        <img src="/files/avatar/{{ $user->avatar }}" alt="" class="media-object">--}}
{{--                                                    </div>--}}

{{--                                                    <div class="media-body">--}}
{{--                                                        <p class="name">{{$user->first_name }} {{$user->last_name}}</p>--}}
{{--                                                        <p class="email">{{ $user->email }}</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-8" id="messages">--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @endif--}}

                <div class="col-md-9">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body">
                            <form id="update-profile-form" action="{{ route('profile.update') }}" enctype="multipart/form-data" method="post">
                                @csrf @method('PUT')
                                <center><h1>@lang('Personal informations')</h1></center>
                                <br><br>
                                <ul class="list-group list-group">
                                    <div class="form-group list-group-item">
                                        <label for="exampleInputEmail1">@lang('first_name')</label>
                                        <input type="text" class="form-control" name="first_name" value="{{  auth()->user()->first_name }}">
                                    </div>

                                    <div  class="form-group list-group-item">
                                        <label for="exampleInputEmail1">@lang('last_name')</label>
                                        <input type="text" class="form-control" name="last_name" value="{{  auth()->user()->last_name }}">
                                    </div>

                                    <div class="form-group list-group-item">
                                        <label for="exampleInputEmail1">@lang('Payment number')</label>
                                        <input type="number" class="form-control" name="phonepaiement" value="{{  auth()->user()->phonepaiement }}">
                                    </div>

                                    <div class="form-group list-group-item">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{  auth()->user()->email }}">
                                    </div>

                                    <div class="form-group list-group-item">
                                        <label for="exampleInputPassword1">@lang('Country')</label>
                                        <select class="form-control" name="country_id" id="country" >
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{trans($country->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group list-group-item">
                                        <label for="exampleInputPassword1">@lang('State')</label>
                                        <div id="div_region" style="display:none">
                                            <select class="form-control" name="state_id" id="region" >

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group list-group-item">
                                        <label for="exampleInputPassword1">@lang('City')</label>
                                        <div id="div_ville" style="display:none">
                                            <select class="form-control" name="city_id" id="ville" >

                                            </select>
                                        </div>
                                    </div>

                                    <br><br>
                                    <div class="form-group list-group-item">
                                        <label for="exampleInputPassword1">@lang('Avatar')</label>
                                        <img src="{{ auth()->user()->avatar }}" style='width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;'>
                                        <input type="file" class="form-control" name="avatar">
                                    </div>
                                </ul>
                                <br>
                                <center><h1>@lang('Access management')</h1></center>
                                <br>
                                <ul class="list-group list-group">
                                    <div class="form-group list-group-item">
                                        <label for="exampleInputPassword1">@lang('Current Password')</label>
                                        <input type="text" name="current_password" class="form-control">
                                    </div>
                                    <div class="form-group list-group-item">
                                        <label for="exampleInputPassword1">@lang('New Password')</label>
                                        <input type="text" name="new_password" class="form-control">
                                    </div>
                                    <div class="form-group list-group-item">
                                        <label for="exampleInputPassword1">@lang('Password Confirmation')</label>
                                        <input type="text" name="password_confirmation" class="form-control">
                                    </div>
                                </ul>
                                <br><br>
                                <button type="submit" class="btn btn-primary pull-right">@lang('Send')</button>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>

@endsection
