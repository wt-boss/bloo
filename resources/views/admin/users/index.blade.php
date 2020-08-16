@extends('admin.top-nav')

@section('title', 'Comptes utilisateurs')

@section('page-css')
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('content')

    <div class="panel panel-flat">
        <div class="panel-body" style="padding: 0;">
            <div class="panel-heading pull-right">
                <a href="{{ route('users.create') }}" class="btn btn-bloo"><i class="fas fa-plus-circle"></i> Creer un utilisateur</a>
            </div>
        </div>
        @if ($users->isEmpty())
            <div class="panel-body text-center">
                <div class="mt-30 mb-30">
                    <h6 class="text-semibold">Aucun utilisateur enregistre</h6>
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
                                    <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-xs btn-info mb-5">View</a>
                                    <a href="{{  route('users.edit', [$user->id]) }}" class="btn btn-xs btn-primary  mb-5 position-right">Edit</a>
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
