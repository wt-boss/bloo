@extends('admin.top-nav')

@section('content-header')
@endsection

@section('content')
<div class="panel panel-flat panel-wb">
    <div class="panel-body" style="padding: 0;">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="box box-success">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title">
                                    Operations
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="box-body" id="lecteurs">

                        <ul class="menu-list">
                            @foreach($operations as $operation)
                            <li id="{{$operation->id}}">
                                <div class="cir-image" id="{{$operation->id}}">
                                    <div class="widget-user-image text-center op-msg-list operation" id="{{$operation->id}}">
                                        <img src="{{ asset('assets/images/bg_1.jpg') }}" alt="LOGO HERE" class="img-circle" id="{{$operation->id}}">
                                        <p id="{{$operation->id}}">{{$operation->nom}}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="height: 100%;">
                            <div class="box-header with-border">
                                <ul class="box-title">
                                    <li>Lecteurs</li>
                                </ul>
                            </div>
                            <div class="box-body">
                                <ul class="nav nav-stacked menu-list" id="lecteur">

                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="box" style="height: 100%;">
                            <div class="box-header with-border">
                                <ul class="box-title"  >
                                    <li class="user">Operateurs</li>
                                </ul>
                            </div>
                            <div class="box-body">
                                <ul class="nav nav-stacked menu-list"  id="operateur">

                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="box" style="height: 100%;">
                    <div class="box-header with-border">
                        <ul class="box-title" id="receiver">
                        </ul>
                    </div>
                    <div class="box-body">
                        <div id="messages">

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('admin_lte_script')
    <!-- jQuery 3 -->
    <script type="application/javascript"  src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script type="application/javascript">
        $('.operation').on('click', function(e){
            console.log(e);
            var operation_id = e.target.id;
            var datas = null;
            $.get('/json-lecteursoperations?operation_id=' + operation_id,function(data) {
                console.log(operation_id);

                $('#lecteur').empty();
                $.each(data, function(index, lecteurObj){
                    $('#lecteur').append('<li class="user" id="'+ lecteurObj.id +'">'+ lecteurObj.first_name +' ' +  lecteurObj.last_name +'</li>');
                });
                $('#messages').html(datas);

                showMessages(operation_id);
            });
            $.get('/json-operateuroperations?operation_id=' + operation_id,function(data) {
                console.log(operation_id);
                $('#operateur').empty();
                $.each(data, function(index, operateurObj){
                    $('#operateur').append('<li class="user" id="'+ operateurObj.id +'">'+ operateurObj.first_name +' ' +  operateurObj.last_name +'</li>');
                });
                $('#messages').html(datas);
                showMessages(operation_id);
            });

        });
       function showMessages(operation_id)
       {
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
               console.log('show');
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
                   $.get('/json-user?user_id=' + receiver_id,function(data) {
                       console.log(data);
                       $('#receiver').empty();
                           $('#receiver').append('<li >'+ data.first_name +' ' +  data.last_name +'</li>');
                   });
                   $.ajax({
                       type: "get",
                       url: "operation_messages/" + receiver_id + '/' + operation_id, // need to create this route
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

                       var datastr = "receiver_id=" + receiver_id + "&message=" + message + "&operation_id=" + operation_id;
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

       }
        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
    </script>
@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper,
        .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 427px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 5px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received,
        .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        /*.active {*/
        /*    background: #eeeeee;*/
        /*}*/

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }


        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }

    </style>
@endsection

@section('laraform_script2')
    {{-- <script src="{{ asset('assets/js/core/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection
