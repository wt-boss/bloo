@extends('admin.top-nav')
@section('page_title', 'Offers')




@section('content')

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat">
        <div class="panel-body" style="padding: 0;">
{{--            @if (auth()->user()->hasRole('Superadmin'))--}}
{{--                @if(auth()->user()->payg == 0)--}}
{{--                    <div class="panel-heading pull-right">--}}
{{--                        <a href="{{ route('entreprise') }}" class="btn btn-bloo heading-btn"><i class="fas fa-plus-circle"></i> {{ trans('Create') }}</a>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="panel-heading pull-right">--}}
{{--                        <a href="#" class="btn btn-bloo heading-btn"> {{trans("You still have")}}  {{ $tokens->own  }}  {{trans("tokens")}} </a>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endif--}}
        </div>
        @if (auth()->user()->hasRole('Superadmin'))
            @if ($offers->isEmpty())
                <div class="panel-body text-center">
                    <div class="mt-30 mb-30">
                        <h6 class="text-semibold">
{{--                            {{ trans('Creer_des_maintenant_votre_premiere_operation') }}--}}
                            Aucune offre disponible
                        </h6>
                    </div>
                </div>
            @else
                <div class="panel panel-flat">
                    <!-- /.box-header -->
                    <div  style="padding: 15px">
                        <table id="offers-tab" class="table stripe">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center" style="color:#0065A1 !important">{{ trans('intitule') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('payementCycle') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('timeTest') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('userTest') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('reduction') }}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                                <tr>
                                    <td></td>
                                    <td class="text-center">{{ $offer->intitule }}</td>
                                    <td class="text-center">{{ $offer->payementCycle }}</td>
                                    <td class="text-center">{{ $offer->timeTest }}</td>
                                    <td class="text-center">{{ $offer->userTest }}</td>
                                    <td class="text-center">{{ $offer->reduction}}</td>

                                    <td class="text-center" >
{{--                                        <a href="{{ route('offers.show', [$offer->id]) }}" class="btn btn-xs btn-info mb-5" style="background-color: #0065A1;"><i class="fa fa-eye" aria-hidden="true"></i></a>--}}
                                        <a href="{{  route('offers.edit', [$offer->id]) }}" class="btn btn-xs btn-primary  mb-5 position-right" style="background-color: #0065A1;"><i class="fa fa-edit"></i></a>
{{--                                        @if(Auth::user()->rolename() == "Superadmin")--}}
{{--                                            <form  id="myForm" class="btn btn-xs  position-right" method="POST" action="{{route('offers.destroy', [$offer->id]) }}" > @csrf @method('DELETE')--}}
{{--                                                <button  class="btn btn-xs btn-primary  mb-5 position- submit" style="background-color: #0065A1;" > <i class="fa fa-trash"></i> </button>--}}
{{--                                            </form>--}}
{{--                                        @endif--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif

    </div>

    <script type="application/javascript"  src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    {{--    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>--}}
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
    {{-- <script src="{{ asset('assets/js/core/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    {{--    <script src="{{ asset('assets/js/custom/main.js') }}"></script>--}}
    <script>
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

            // $('a[href="javascript:void(0)"]').click(function() {
            // 	$.ajax({
            // 		url: route,
            // 		type: 'POST',
            // 		dataType: 'json',
            // 		data: data_serialized,
            // 	})
            // 	.done(function (response) {
            // 		$(this).find('.no-click').addClass("text-muted");
            // 	});
            // });

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

            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });
            // Set onclick cbg-colour .btn-success
        });
    </script>
@endsection

