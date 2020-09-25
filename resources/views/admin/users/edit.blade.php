@extends('admin.top-nav')

@section('page-css')
@section('page_title', 'Utilisateurs|Edit')
@endsection

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
