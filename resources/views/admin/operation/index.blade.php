@extends('admin.top-nav')

@section('title', 'My Forms')


@section('content')

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat">
        <div class="panel-body" style="padding: 0;">
            @if (auth()->user()->hasRole('Superadmin|Account Manager'))
            <div class="panel-heading pull-right">
                <a href="{{ route('entreprise') }}" class="btn btn-bloo heading-btn"><i class="fas fa-plus-circle"></i> {{ trans('Create') }}</a>
            </div>
                @endif
        </div>
        @if (auth()->user()->hasRole('Superadmin|Account Manager'))
            @if ($operations->isEmpty())
                <div class="panel-body text-center">
                    <div class="mt-30 mb-30">
                        <h6 class="text-semibold">
                               {{ trans(' Creer_des_maintenant_votre_premiere_operation') }}
                        </h6>
                    </div>
                </div>
            @else
                <div class="panel panel-flat">
                    <!-- /.box-header -->
                    <div  style="padding: 15px">
                        <table id="operations-tab" class="table stripe">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center" style="color:#0065A1 !important">{{ trans('op_name') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('start_date') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('end_date') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('enterprise') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('city') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('sites') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('operator') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('Status') }}</th>
                                <th class="text-center "style="color:#0065A1 !important">{{ trans('actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($operations as $operation)
                                    <tr>
                                        {{-- @php dd($operation->entreprise->nom) @endphp --}}
                                        <td></td>
                                        <td class="text-center">{{ $operation->nom }}</td>
                                        <td class="text-center">{{ $operation->date_start }}</td>
                                        <td class="text-center">{{ $operation->date_end }}</td>
                                        <td class="text-center">{{ $operation->entreprise->nom }}</td>
                                        <td class="text-center">{{$operation->sites()->count()}}</td>
                                        <td class="text-center">{{$operation->sites()->count()}}</td>
                                        <td class="text-center">{{$operation->users()->where('role','1')->count()}}</td>
                                        <td class="text-center">
                                                @if($operation->status === "CREER")
                                                <a href="#" class="badge badge-warning">    </a>
                                                @endif
                                                @if($operation->status === "EN COUR")
                                                        <a href="#" class="badge badge-success">    </a>
                                                @endif
                                                @if($operation->status === "TERMINER")

                                                        <a href="#" class="badge badge-danger">    </a>
                                                @endif
                                        </td>
                                        <td class="text-center" style="position: relative;">
                                            @include('admin.operation.partials.op-action')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif
        @if (auth()->user()->hasRole('Lecteur|Opérateur'))
        @if ($operations->isEmpty())
        <div class="panel-body text-center">
            <div class="mt-30 mb-30">
                <h6 class="text-semibold">
                        Vous n'avez pas d'operation en cours
                </h6>
            </div>
        </div>
    @else
        <div class="panel panel-flat">
            <!-- /.box-header -->
            <div  style="padding: 15px">
                <table id="operations-tab" class="table stripe">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">{{ trans('op_name') }}</th>
                        <th class="text-center">{{ trans('start_date') }}</th>
                        <th class="text-center">{{ trans('end_date') }}</th>
                        <th class="text-center">{{ trans('enterprise') }}</th>
                        <th class="text-center">{{ trans('city') }}</th>
                        <th class="text-center">{{ trans('sites') }}</th>
                        <th class="text-center">{{ trans('operator') }}</th>
                        <th class="text-center">{{ trans('Status') }}</th>
                        <th class="text-center">{{ trans('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($operations as $operation)
                            <tr>
                                {{-- @php dd($operation->entreprise->nom) @endphp --}}
                                <td></td>
                                <td class="text-center">{{$operation->nom }}</td>
                                <td class="text-center">{{$operation->date_start }}</td>
                                <td class="text-center">{{$operation->date_end }}</td>
                                <td class="text-center">{{$operation->entreprise->nom }}</td>
                                <td class="text-center">{{$operation->sites()->count()}}</td>
                                <td class="text-center">{{$operation->sites()->count()}}</td>
                                <td class="text-center">{{$operation->users()->where('role','1')->count()}}</td>
                                <td class="text-center">{{$operation->users()->where('role','1')->count()}}</td>
                                <td class="text-center" style="position: relative;">
                                    @include('admin.operation.partials.op-action')
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
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection

@section('page-script')
    <script>
        $(function() {
            $('#operations-tab').DataTable({

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

