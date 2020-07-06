@section('title', 'My Forms')

@extends('admin.top-nav')

@section('laraform_style')
    <!-- Laraform Link Style -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-flat border-left-xlg border-left-primary">
        <div class="panel-heading">
            <h4 class="panel-title text-semibold">My users</h4>
            <div class="heading-elements">
                <a href="{{ route('users.create') }}" class="btn btn-success heading-btn">Create an user</a>
            </div>
        </div>
    </div>

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat">
        @if ($users->isEmpty())
            <div class="panel-body text-center">
                <div class="mt-30 mb-30">
                    <h6 class="text-semibold">You are yet to create any form</h6>
                </div>
            </div>
        @else
            <table class="table datatable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Compte Actif</th>
                        @if(Auth::user()->rolename() == "Superadmin")
                        <th class="text-center">Actions</th>
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
                                          <i class="fas fa-check-square text-success"></i>
                                      @else
                                          <i class="fas fa-times-circle text-danger"></i>
                                      @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-xs btn-default mb-5">View</a>
                                <a href="{{  route('users.edit', [$user->id]) }}" class="btn btn-xs btn-primary mb-5 position-right">Edit</a>
                                <a href="{{ route('forms.destroy', $user->id) }}" class="btn btn-xs btn-danger mb-5 position-right" data-id="{{ $user->id }}" data-method="delete" data-item="form" data-ajax="true">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
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
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
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
@endsection
@section('laraform_script2')
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection
