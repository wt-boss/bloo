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

    <div class="panel panel-flat border-left-xlg border-left-success">
        <div class="panel-heading">
            <h4 class="panel-title text-semibold">Mes formulaires</h4>
            <div class="heading-elements">
                <a href="{{ route('sondage.index') }}" class="btn-xs btn-primary heading-btn">Tous mes formulaires</a>
            </div>
        </div>
    </div>

    <div class="panel panel-flat border-top-lg border-top-success">
        <div class="panel-heading">
            <h5 class="panel-title">Créer un formulaire</h5>
        </div>
        <div class="panel-body">
            @include('forms.form._form', ['type' => 'create'])
        </div>
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
