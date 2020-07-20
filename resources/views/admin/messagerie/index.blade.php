@extends('admin.top-nav')

@section('page-css')
    <style>
        #taille{

        }
    </style>
@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Panneau de control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"> <i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
            <li class="active">Users</li>
        </ol>
    </section>
@endsection

@section('content')
    <private :user="{{auth()->user()}}" :operation="{{$operation->id}}"></private>

@endsection

@section('admin_lte_script')
    <!-- jQuery 3 -->
    <script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{'admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'}}"></script>
    <!-- FastClick -->
    <script src="{{'admin/bower_components/fastclick/lib/fastclick.js'}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admin/dist/js/demo.js')}}"></script>
@endsection
@section('page-script')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
