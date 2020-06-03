@extends('adminlte.index')

@section('css')

@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
    <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a href="{{route('users.create')}}" >
                        Ajouter un utilisateur <i class="fas fa-plus-square"></i>
                    </a>
                </h6>
            </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Compte Actif</th>
                    @if(Auth::user()->rolename() == "Superadmin")
                        <th class="actions"></th>
                    @endif
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Compte Actif</th>
                    @if(Auth::user()->rolename() == "Superadmin")
                        <th class="actions"></th>
                    @endif
                </tr>
                </tfoot>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{ Helper::getRolename($user->role) }}</td>

                        <td>
                            @if($user->active == 1)
                                <i class="fas fa-check-square text-success"></i>
                            @else
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </td>
                        @if(Auth::user()->rolename() == "Superadmin")
                            <td class="actions">

                                <div class='btn-group'>
                                    <a href="{{ route( 'users.edit', $user->id) }}" class="btn btn-primary" title="Modifier utilisateur" ><i class="fas fa-pen"></i></a></li>
                                    <form method="post" action="{{route('users.destroy',$user->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        @if ( $user->hasRole('Admin|Opérateur|Lecteur') )
                                            <button class="btn btn-danger" title="Supprimer utilisateur"><i class="fas fa-trash"></i></button>
                                        @endif
                                    </form>
                                    <a href="{{ route( 'users.show',$user->id)  }}" title="Voir utilisateur" class="btn btn-success"><i class="fas fa-user-alt"></i></a></li>
                                </div>
                                @endif
                            </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection

@section('js')

@endsection
