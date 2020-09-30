@extends('admin.top-nav')



@section('page_title', 'Utilisateurs|Edit')



@section('content-header')
    <!-- Content Header (Page header) -->
@endsection

@section('content')

@include('partials.alert', ['name' => 'index'])
    <div class="panel panel-flat">
        <div class="row">
            <div class="d-none d-sm-block col-sm-5 left-side-bloo">
                <img class="bg-img" src="{{ asset('assets/images/background_create_enterprise.jpg') }}" alt="">
                {{-- <img class="logo-img" src="{{ asset('assets/images/bloo_logo_white.png') }}" alt="Bloo"> --}}
                <h1>{{ trans('update_compte') }}</h1>
            </div>
            <div class="col-sm-7">
                <div class="my-content create-user">
                    {!! Form::model($user, [
                            'action' => ['UsersController@update', $user->id],
                            'method' => 'put',
                            'files' => true
                        ])
                    !!}
                        @csrf
                        @include('admin.users.form2')
                        <br>
                        <a class="btn btn-bloo-cancel" href="{{ route('users.index') }}">{{ trans('Annuler') }}</a>
                        <button type="submit" class="btn btn-bloo">{{ trans('Mettre_jour') }}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
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
