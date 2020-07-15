@extends('admin.top-nav')


@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
            <li><a href="#"><i class="fas fa-user"></i> Users </a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
@endsection

@section('content')

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
