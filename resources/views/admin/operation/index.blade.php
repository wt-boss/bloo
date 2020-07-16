@section('title', 'My Forms')

@extends('admin.top-nav')

@section('content')
    <div class="panel panel-flat border-left-xlg border-left-primary">
        <div class="panel-heading">
            <h4 class="panel-title text-semibold">My operation</h4>
            <div class="heading-elements">
                <a href="{{ route('entreprise') }}" class="btn btn-success heading-btn">Create an operation</a>
            </div>
        </div>
    </div>

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat">
        @if ($operations->isEmpty())
            <div class="panel-body text-center">
                <div class="mt-30 mb-30">
                    <h6 class="text-semibold">You are yet to create any operation</h6>
                </div>
            </div>
        @else
            <table class="table datatable">
                <thead>
                    <tr>
                        <th></th>
                        <th>name</th>
                        <th class="text-center">Date debut</th>
                        <th class="text-center">Date fin</th>
                        <th class="text-center">Entreprise</th>
                        <th class="text-center">Nbre de ville</th>
                        <th class="text-center">Nbre de site</th>
                        <th class="text-center">Nbre d'opérateur</th>
                        <th class="text-center">Actions</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach($operations as $operation)
                        <tr>
                            <td></td>
                        <td>{{ $operation->nom }}</td>
                            <td class="text-center">debut</td>
                            <td class="text-center">fin</td>
                            <td class="text-center">entreprise</td>
                            <td class="text-center">nombre de ville</td>
                            <td class="text-center">nombre de site</td>
                            <td class="text-center">nombre d'operateur</td>
                            <td class="text-center">
                                <a href="{{ route('forms.show', [$operation->form->code]) }}" class="btn btn-xs btn-success mb-5">Form</a>
                                <a href="{{ route('operation.show', [$operation->id]) }}" class="btn btn-xs btn-default mb-5 ">View</a>
                                <a href="{{  route('operation.edit', [$operation->id]) }}" class="btn btn-xs btn-primary mb-5 position-right">Edit</a>
                                <a href="{{route('messages_show',$operation->id)}}" class="btn btn-xs btn-info mb-5 position-right">Messages</a>
                                <a href="{{ route('operation.destroy', $operation->id) }}" class="btn btn-xs btn-danger mb-5 position-right" data-id="{{ $operation->id }}" data-method="delete" data-item="form" data-ajax="true">Delete</a>
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
    {{-- <script src="{{ asset('assets/js/core/app.js') }}"></script> --}}
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
