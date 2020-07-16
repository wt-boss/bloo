@extends('admin.top-nav')

@section('title', 'My Forms')

@section('page-css')
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="panel panel-flat border-left-xlg border-left-bloo-primary">
        <div class="panel-heading">
            <h4 class="panel-title text-semibold">Mes operations</h4>
            <div class="heading-elements">
                <a href="{{ route('entreprise') }}" class="btn btn-bloo heading-btn"><i class="fas fa-plus-circle"></i> Creer une operation</a>
            </div>
        </div>
    </div>

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat">
        @if ($operations->isEmpty())
            <div class="panel-body text-center">
                <div class="mt-30 mb-30">
                    <h6 class="text-semibold">Creer des maintenant votre premiere operation</h6>
                </div>
            </div>
        @else
        <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
                <table id="operations-tab" class="table stripe">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Nom operation</th>
                            <th class="text-center">Date debut</th>
                            <th class="text-center">Date fin</th>
                            <th class="text-center">Entreprise</th>
                            <th class="text-center">Villes</th>
                            <th class="text-center">Sites</th>
                            <th class="text-center">Operateurs</th>
                            <th class="text-center">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($operations as $operation)
                            <tr>
                                <td></td>
                                <td class="text-center">{{ $operation->nom }}</td>
                                <td class="text-center">{{ $operation->date_start }}</td>
                                <td class="text-center">{{ $operation->date_end }}</td>
                                <td class="text-center">{{ $operation->entreprise->nom }}</td>
                                <td class="text-center">Villes</td>
                                <td class="text-center">Sites</td>
                                <td class="text-center">15</td>
                                <td class="text-center">
                                    <a href="{{ route('forms.show', [$operation->form->code]) }}" class="btn btn-xs btn-success mb-5">Form</a>
                                    {{-- <a href="{{ route('operation.show', [$operation->id]) }}" class="btn btn-xs btn-default mb-5 ">View</a>
                                    <a href="{{  route('operation.edit', [$operation->id]) }}" class="btn btn-xs btn-primary mb-5 position-right">Edit</a>
                                    <a href="{{route('messages_show',$operation->id)}}" class="btn btn-xs btn-info mb-5 position-right">Messages</a>
                                    <a href="{{ route('operation.destroy', $operation->id) }}" class="btn btn-xs btn-danger mb-5 position-right" data-id="{{ $operation->id }}" data-method="delete" data-item="form" data-ajax="true">Delete</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        @endif

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
    {{-- <script src="{{ asset('assets/js/custom/pages/datatable.js') }}"></script> --}}
    <script>
        $(function() {
            $('#operations-tab').DataTable({
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
