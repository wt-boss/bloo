@extends('adminlte.index')

@section('css')

@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users/Profile</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
                        <li class="breadcrumb-item active"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{ $user->name}}</h3>
                    <h5 class="widget-user-desc">{{  $user->rolename() }}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2"  src="{{asset($user->avatar)}}" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">3,200</h5>
                                <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">13,000</h5>
                                <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">35</h5>
                                <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mon compte</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('users.update',$user->id) }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Informations de l'utilisateur</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nom<span class="small text-danger"></span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('name', $user->name) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="email">Adress Email<span class="small text-danger"></span></label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email', $user->email) }}" disabled>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection

@section('js')

@endsection
