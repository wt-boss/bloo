@extends('adminlte.index')

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users/Créer</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Créer</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                </div>

                <div class="card-body">

                    {!! Form::open([
                        'action' => ['UsersController@store'],
                        'files' => true
                    ])
                !!}

                    <div class="box-body" style="margin:10px;">
                        @include('adminlte.users.form')
                    </div>

                    <!-- Button -->
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary"><i></i> Valider</button>
                            </div>
                            <div class="col text-left">
                                <button type="submit" href="{{ route('users.index') }}" class="btn btn-warning">Annuler</button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>
    </div>
@endsection
