@extends('admin.top-nav')
@section('page_title', 'Offers')


@section('content')

    @include('partials.alert', ['name' => 'index'])
    <div class="row">
        <div class="col-md-6">
            @if (auth()->user()->hasRole('Superadmin'))
            <div class="box" style="height: 100%;">
                <div class="box-header with-border">
                    <ul class="box-title" style="font-size: 15px;;">
                        <li>{{ trans('Offers') }}</li>
                    </ul>
                </div>
                <div class="box-body">
                    <div  style="padding: 15px">
                        <table id="offers-tab" class="table stripe">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center" style="color:#0065A1 !important">{{ trans('intitule') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('cost') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                                <tr>
                                    <td></td>
                                    <td class="text-center">{{ $offer->intitule }}</td>
                                    <td class="text-center">{{ $offer->montant }}</td>
                                    <td class="text-center" >
                                        <a href="#" class="btn btn-xs btn-primary  mb-5 position-right" style="background-color: #0065A1;" data-target="#myModal-{{$offer->id}}" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                @include('admin.offers.offer_modal',['offer'=>$offer])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            @endif

                @if(auth()->user()->hasRole('Superadmin'))
                <div class="box" style="height: 100%;">
                    <div class="box-header with-border">
                        <ul class="box-title" style="font-size: 15px;;">
                            <li>{{ trans('Extra') }}</li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div  style="padding: 15px">
                            <table id="extra-tab" class="table stripe">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center" style="color:#0065A1 !important">{{ trans('type') }}</th>
                                    <th class="text-center "style="color:#0065A1 !important">{{ trans('Offer') }}</th>
                                    <th class="text-center" style="color:#0065A1 !important">{{ trans('cost') }}</th>
                                    <th class="text-center "style="color:#0065A1 !important">{{ trans('actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($extras as $item)
                                    <tr>
                                        <td></td>
                                        <td class="text-center">{{ $item->type }}</td>
                                        <td class="text-center">{{ $item->offer->intitule }}</td>
                                        <td class="text-center">{{ $item->cost }}</td>
                                        <td class="text-center" >
                                            <a href="#" class="btn btn-xs btn-primary  mb-5 position-right" style="background-color: #0065A1;" data-target="#theExtra-{{$item->id}}" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @include('admin.offers.extra_modal',['extra'=>$item])
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                @endif


                 @if(auth()->user()->role !== 6)
                <div class="box" style="height: 100%;">
                    <div class="box-header with-border">
                        <ul class="box-title" style="font-size: 15px;;">
                            <li>{{ trans('Extra') }}</li>
                        </ul>
                    </div>
                    <div class="box-body">
                            <div class="panel-heading pull-right">
                                <a href="#" class="btn btn-bloo heading-btn  mb-2 position-right float-right" style="background-color: #0065A1;" data-target="#myExtra" data-toggle="modal">
                                    <i class="fas fa-plus-circle"></i>
                                    @lang("Add an extra")
                                </a>
                            </div>
                        <div  style="padding: 15px">
                            <table id="extras-tab" class="table stripe">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center" style="color:#0065A1 !important">{{ trans('first_name') }}</th>
                                    <th class="text-center "style="color:#0065A1 !important">{{ trans('last_name') }}</th>
                                    <th class="text-center" style="color:#0065A1 !important">{{ trans('role') }}</th>
                                    <th class="text-center "style="color:#0065A1 !important">{{ trans('email') }}</th>
                                    <th class="text-center" style="color:#0065A1 !important">{{ trans('Price') }}</th>
                                    <th class="text-center" style="color:#0065A1 !important">{{ trans('Statut Paid') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $offer)
                                    <tr>
                                        <td></td>
                                        <td class="text-center">{{ $offer->first_name }}</td>
                                        <td class="text-center">{{ $offer->last_name }}</td>
                                        <td class="text-center">{{ $offer->rolename() }}</td>
                                        <td class="text-center">{{ $offer->email }}</td>
                                        <td class="text-center">{{ $offer->cost }}</td>
                                        <td class="text-center">
                                            @if( $offer->active === 0)
                                                NO
                                            @else
                                                YES
                                            @endif
                                        </td>

                                    </tr>
                                    @include('admin.offers.offer_modal',['offer'=>$offer])
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                @endif
        </div>


        @if(auth()->user()->hasRole('Superadmin'))
        <div class="col-md-6">
            <div class="box box-solid panel-wb">
                <!-- /.box-header -->
                <div class="box-body" style="padding: 0 ;">
                    <div class="row">
                        <div class="col-lg-12 col-xs-6">
                            <div class="small-box bg-white">
                                <a href="{{route('topics.index')}}" class="btn form-control">{{ trans('Templates') }}</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box" style="height: 100%;">
                <div class="box-header with-border">
                    <ul class="box-title" style="font-size: 15px;;">
                        <li>{{ trans('Promotions') }}</li>
                    </ul>
                    <div class="panel-heading pull-right">
                        <a href="#" class="btn btn-bloo heading-btn  mb-2 position-right float-right" style="background-color: #0065A1;" data-target="#myModal" data-toggle="modal">
                            <i class="fas fa-plus-circle"></i>
                            @lang("Add promotion")
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div  style="padding: 15px">
                        <table id="promotion-tab" class="table stripe">
                            <thead>
                            <tr>
                                <th></th>
                                <th  style="color:#0065A1 !important">{{ trans('intitule') }}</th>
                                <th  style="color:#0065A1 !important">{{ trans('Offer') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('Percentage') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('Start date') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('End date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($promotion as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $item->intitule }}</td>
                                    <td >{{ $item->offer->intitule }}</td>
                                    <td class="text-center">{{ $item->percentage }}</td>
                                    <td >{{ $item->start_date }}</td>
                                    <td class="text-center">{{ $item->end_date }}</td>
                                </tr>
                                @include('admin.offers.offer_modal',['offer'=>$offer])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        @endif
    </div>


    <div id="myModal" class="modal" tabindex="-1" data-easein="bounce" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('Add promotion') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="promition-form" method='POST' action="{{route('promotion.store')}}">
                    <div class="modal-body">
                        @csrf
                        @php
                            $offers = \App\Offer::all();
                        @endphp

                        <div class="my-content create-user">
                            <div class="form-group focused" >
                                <label for="intitule">@lang("Entitled")</label>
                                <input class="form-control" name="intitule" type="text"  required>
                            </div>

                            <div class="form-group focused" >
                                <label for="percentage">@lang("Percentage")</label>
                                <input class="form-control" name="percentage" type="number" min="0" max="100" required>
                            </div>

                            <div class="form-group focused" >
                                <label for="montant">@lang("offer")</label>
                                <select class="form-control" name="offer">
                                    @foreach($offers as $item)
                                        <option value="{{$item->id}}">{{$item->intitule}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="date_start">{{ trans('free_form1_label3') }} </label>
                                <input type="date" class="form-control form-input-check" value="{{old('date_start')}}" id="date_start" name="date_start"  required>
                                <div class="invalid-feedback">

                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="date_end">{{ trans('free_form1_label4') }} </label>
                                <input type="date" class="form-control form-input-check" value="{{old('date_end')}}" id="date_end" name="date_end"  required>
                                <div class="invalid-feedback">

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bloo-cancel" data-dismiss="modal">{{trans('Annuler')}}</button>
                        <button  class="btn btn-bloo legitRipple">{{trans('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="theExtra" class="modal" tabindex="-1" data-easein="bounce" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('update_promotion') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_offer" method='POST' action="{{route('updateoffers')}}">
                    <div class="modal-body">
                        @csrf
                        @php
                            $extras = \App\Extra::with('offer')->get();
                            $offer = \App\Subscription::where("user_id",auth()->user()->id)->get()->last();
                        @endphp
                        <div class="my-content create-user">

                            <div class="form-group focused" >
                                <label for="montant">Offre</label>
                                <select class="form-control" name="extra_id">
                                    @foreach($extras as $item)
                                        <option value="{{$item->id}}">{{$item->offer->intitule}} - {{$item->type}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group focused" >
                                <label for="montant">Prix</label>
                                <input class="form-control" name="montant" type="number"  required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bloo-cancel" data-dismiss="modal">{{trans('Annuler')}}</button>
                        <button  class="btn btn-bloo legitRipple">{{trans('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg"  id="myExtra" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
                    <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Create an extra') }}</font></font></h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('storeoffers') }}">
                        @csrf
                        <div class="text-center">
                            <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
                            <h5 class="content-group">Create an account <small class="display-block">All fields are required</small></h5>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ (isset($user_data['email'])) ? $user_data['email'] : old('email') }}" required{{ isset($user_data['email']) ? ' disabled' : '' }}>
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
                            </div>
                        </div>

                        @isset($offer->offer_id)
                            <input type="hidden" name="offer_id" value="{{$offer->offer_id}}">
                        @endisset

                        <div class="form-group has-feedback has-feedback-left">
                            <select class="form-control" name="role" id="description" required>
                                <option value=""></option>
                                <option value="4">Client</option>
                                 @if($offer->offer_id === 1)<option value="1">Operateur</option>
                                 @endif
                            </select>
                            <div class="form-control-feedback">
                                <i class="icon-book3 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-teal btn-block">{{ trans('savee') }} <i class="icon-arrow-right14 position-right"></i></button>
                        </div>

                        <div class="content-divider text-muted form-group"><span></span></div>
                        <button type="button" class="btn btn-default btn-block content-group" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Close') }}</font></font></button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <script type="application/javascript"  src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('1702f90c00112df631a4', {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script>


@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>

@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection

@section('laraform_script2')
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script>
        function form_submit(id) {
            document.getElementById(id).submit();
        }
        $(function() {
            window.csrf_token = csrfToken();

            var $initiator = null;

            $('.greeting').text(getGreeting());

            $(document).on("click", "#delete-button", function() {
                var $link = $('<a>');
                var href = $(this).data('href');
                var item = $(this).data('item');
                var message = $(this).data('message');

                message = (message && message.length) ? message : 'Are you sure you want to delete the ' + item + '?';

                bootbox.confirm({
                    message: message,
                    buttons: {
                        confirm: {
                            label: 'Yes',
                        },
                        cancel: {
                            label: 'No',
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            $link.attr({
                                href: href,
                                id: "delete-item",
                                "data-method": 'delete',
                                "data-ajax": false,
                                "data-item": item
                            });

                            $link.text(item);
                            $link.hide().appendTo('body');
                            $link[0].click();
                        }
                    }
                });
            });

            $(document).on('click', 'a[href]', function(e) {
                var method = $(this).data('method');

                if (method) {
                    $initiator = $(this);
                    e.preventDefault();
                    var $form = $('<form>'),
                        action = $(this).attr('href'),
                        target = $(this).attr('target'),
                        ajax_enabled = $(this).data('ajax');
                    item_name = $(this).data('item');

                    if (!action || !action.match(/(^\/|:\/\/)/i)) {
                        action = window.location.href;
                    }

                    if (target) {
                        $form.attr('target', target);
                    }

                    if (!method.match(/(get|post)/i)) {
                        $form.append($('<input>', { type: 'hidden', name: '_method', value: method.toUpperCase() }));
                        method = 'POST';
                    }

                    if (!method.match(/(get|head|option)/i)) {
                        var csrf_token = csrfToken();
                        if (csrf_token) {
                            $form.append($('<input>', { type: 'hidden', name: '_token', value: csrf_token }));
                        }
                    }
                    $form.attr('method', method);
                    $form.attr('action', action);
                    $form.attr('id', item_name);

                    $form.hide().appendTo('body');

                    var form_action_class = (ajax_enabled == true) ? 'action-by-ajax' : 'action-default';
                    $form.addClass(form_action_class);

                    $form.trigger('submit');
                }
            });

            $(document).on("submit", "form.action-by-ajax", function(e) {
                e.preventDefault();
                var data_serialized = $(this).serialize(),
                    route = $(this).attr('action')
                parent_row = $initiator.closest('tr');

                bootbox.confirm({
                    message: "{{trans('Are you sure you want to delete this')}}",
                    buttons: {
                        confirm: {
                            label: '{{trans("Yes")}}',
                        },
                        cancel: {
                            label: '{{trans("No")}}',
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            $.ajax({
                                url: route,
                                type: 'POST',
                                dataType: 'json',
                                data: data_serialized,
                            })
                                .done(function(response) {
                                    if (response.success) {
                                        parent_row.fadeOut('slow');

                                        var next_row = parent_row.next();
                                        if (next_row.attr('class') == 'child') {
                                            next_row.fadeOut('fast');
                                        }
                                    } else {
                                        noty({
                                            width: 200,
                                            text: 'Error occurred: ' + response.error,
                                            type: 'error',
                                            dismissQueue: true,
                                            timeout: 6000,
                                            layout: 'top',
                                            buttons: false
                                        });
                                    }
                                });
                        }
                    },
                });
            });

            $('#flash').delay(6000).fadeOut('slow', function() {
                $('#flash').remove();
            });

            //functions
            function csrfToken() {
                return $('meta[name="csrf-token"]').attr('content');
            }

            function getGreeting() {
                var today = new Date()
                var curHr = today.getHours()

                if (curHr < 12) {
                    return 'Good Morning';
                } else if (curHr < 18) {
                    return 'Good Afternoon';
                } else {
                    return 'Good Evening';
                }
            }
        });
    </script>
    <script type="text/javascript">

        $("#promition-form").on('submit', function(e){
            let valid = verify();
            if(!valid){
                e.preventDefault();
            }
        });

        function verify() {

            var date_start = $('#date_start').val();
            if (is_null_or_whithe_space(date_start)){
                $('#date_start').addClass("is-invalid");
                $('#date_start').next(".invalid-feedback").html("@lang('This field cannot be empty')");
                return false;
            }

            var date_end = $('#date_end').val();
            if (is_null_or_whithe_space(date_end)) {
                $('#date_end').addClass("is-invalid");
                $('#date_end').next(".invalid-feedback").html("@lang('This field cannot be empty')");
                return false;
            }

            date_start = new Date(date_start);
            date_end = new Date(date_end);

            if (date_start.getTime() < (new Date().datePart().getTime())) {
                $('#date_start').addClass("is-invalid");
                $('#date_start').next(".invalid-feedback").html("@lang("Choose a date greater than or equal to today's date")");
                return false;
            }

            if (date_start.getTime() > date_end.getTime()) {
                $('#date_end').addClass("is-invalid");
                $('#date_end').next(".invalid-feedback").html("@lang("The start date must be less than the end date")");
                return false;
            }

            return true;
        }

        const is_null_or_whithe_space = function(input) {
            return !input || !(typeof(input) == 'string') || input.replace(/\s/g, '').length < 3;
        };

        const date_part_only = function () {
            var d = new Date(this);
            d.setHours(0, 0, 0, 0);
            return d;
        };

        Date.prototype.datePart = date_part_only;
    </script>
@endsection

@section('page-script')
    <script>
        $(function() {
            $('#offers-tab').DataTable({

                "language": {
                    @if( app()->getLocale() === "fr" )
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                    @endif
                            @if( app()->getLocale() === "en")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                    @endif
                            @if( app()->getLocale() === "es")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                    @endif
                            @if( app()->getLocale() === "pt")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
                    @endif
                },

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

            $('#extra-tab').DataTable({

                "language": {
                    @if( app()->getLocale() === "fr" )
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                    @endif
                            @if( app()->getLocale() === "en")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                    @endif
                            @if( app()->getLocale() === "es")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                    @endif
                            @if( app()->getLocale() === "pt")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
                    @endif
                },

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

            $('#extras-tab').DataTable({

                "language": {
                    @if( app()->getLocale() === "fr" )
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                    @endif
                            @if( app()->getLocale() === "en")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                    @endif
                            @if( app()->getLocale() === "es")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                    @endif
                            @if( app()->getLocale() === "pt")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
                    @endif
                },

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

            $('#promotion-tab').DataTable({

                "language": {
                    @if( app()->getLocale() === "fr" )
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                    @endif
                            @if( app()->getLocale() === "en")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                    @endif
                            @if( app()->getLocale() === "es")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                    @endif
                            @if( app()->getLocale() === "pt")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
                    @endif
                },

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
            // Set onclick cbg-colour .btn-success
        });
    </script>
@endsection

