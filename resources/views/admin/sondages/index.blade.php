@extends('admin.index')

@section('page-css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Form
            <small>Panneau de control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"> <i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
            <li class="active">Form</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="panel panel-flat border-left-xlg border-left-primary">
        <div class="panel-heading">
            <h4 class="panel-title text-semibold">Mes formulaires</h4>
            <div class="heading-elements">
                <a href="{{ route('sondage.create') }}" class="btn-xs btn-success heading-btn">Créer un formulaire</a>
            </div>
        </div>
    </div>

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat">
        @if ($forms->isEmpty())
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
                    <th>Form Title</th>
                    <th class="text-center">Date Created</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $symbols = App\Form::getStatusSymbols() @endphp
                @foreach ($forms as $form)
                    @php
                        $symbol = $symbols[$form->status];
                        $role_symbol = ($form->user_id === $current_user->id) ? ['role' => 'Owner', 'color' => 'success'] : ['role' => 'Collaborator', 'color' => 'primary'];
                    @endphp
                    <tr>
                        <td></td>
                        <td>{{ $form->title }}</td>
                        <td class="text-center">{{ $form->created_at->format('jS F, Y') }}</td>
                        <td class="text-center"><span class="label label-flat border-{{ $role_symbol['color'] }} text-{{ $role_symbol['color'] }}-600">{{ $role_symbol['role'] }}</span></td>
                        <td class="text-center"><span class="label bg-{{ $symbol['color'] }}">{{ $symbol['label'] }}</span></td>
                        <td class="text-center">
                            <a href="{{ route('forms.show', $form->code) }}" class="btn btn-xs btn-default mb-5">View</a>
                            <a href="{{ route('forms.edit', $form->code) }}" class="btn btn-xs btn-primary mb-5 position-right">Edit</a>
                            <a href="{{ route('forms.destroy', $form->code) }}" class="btn btn-xs btn-danger mb-5 position-right" data-id="{{ $form->code }}" data-method="delete" data-item="form" data-ajax="true">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('page-script')
    <!-- DataTables -->
    <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>

@endsection
