@extends('admin.top-nav')
@section('page_title', trans('Utilisateurs'))

@section('title', 'Comptes utilisateurs')


@section('content')

    <div class="panel panel-flat">
        <div class="panel-body" style="padding: 0;">
            <div class="panel-heading pull-right">
                <a href="{{ route('users.create') }}" class="btn btn-bloo"><i class="fas fa-plus-circle"></i> {{ trans('create_user') }}</a>
            </div>
        </div>
        @if ($users->isEmpty())
            <div class="panel-body text-center">
                <div class="mt-30 mb-30">
                    <h6 class="text-semibold">{{ trans('nothing_users') }}</h6>
                </div>
            </div>
        @else
        <div class="panel panel-flat">
            <!-- /.box-header -->
            <div  style="padding: 15px">
                <table class="datatable table stripe">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('Name') }}</th>
                            <th class="text-center">{{ trans('Email') }}</th>
                            <th class="text-center">{{ trans('Rôle') }}</th>
                            <th class="text-center">{{ trans('Compte Actif') }}</th>
                            @if(Auth::user()->rolename() == "Superadmin")
                            <th class="text-center">{{ trans('actions') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td></td>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">{{ Helper::getRolename($user->role) }}</td>
                                <td class="text-center">
                                    @if($user->active == 1)
                                            <i class="fas fa-check-square " style="color: #0065A1;"></i>
                                        @else
                                            <i class="fas fa-times-circle text-danger"></i>
                                        @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-xs btn-info mb-5" style="background-color: #0065A1;"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{  route('users.edit', [$user->id]) }}" class="btn btn-xs btn-primary  mb-5 position-right" style="background-color: #0065A1;"><i class="fa fa-edit"></i></a>
                                    @if(($user->rolename() == "Opérateur") && ($user->active == 0))
                                        <a id="activation" href="{{route('activation', [$user->id]) }}" class="btn btn-xs btn-primary  mb-5 position-right" style="background-color: #0065A1;"><i class="fa fa-user-check"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
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

    <script>
        $(function() {
            $('.datatable').DataTable({

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

        });
    </script>
@endsection
