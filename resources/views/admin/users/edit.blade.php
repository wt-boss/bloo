@extends('admin.top-nav')

@section('page-css')

@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Edition d'un utilisateur</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
            <li><a href="#"><i class="fas fa-user"></i> Users </a></li>
            <li class="active">Editer</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box" style="border:1px solid #d2d6de;">
                {!! Form::model($user, [
                        'action' => ['UsersController@update', $user->id],
                        'method' => 'put',
                        'files' => true
                    ])
                !!}

                <div class="box-body" style="margin:10px;">
                    @include('admin.users.form2')
                </div>

                <div class="box-footer" style="background-color:#f5f5f5;border-top:1px solid #d2d6de;">
                    <button type="submit" class="btn btn-info" style="width:100px;">Mettre à jour</button>
                    <a class="btn btn-warning " href="{{ route('users.index') }}" style="width:100px;"><i class="fa fa-btn fa-back"></i>Cancel</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
