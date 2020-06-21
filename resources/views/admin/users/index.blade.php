@extends('admin.index')

@section('page-css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
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
    <section class="content">
      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">
                          <a href="{{route('users.create')}}" >
                              Ajouter un utilisateur <i class="fas fa-plus-square"></i>
                          </a>
                      </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
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
                                          {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                          <div class='btn-group'>
                                              <a href="{{ route('users.show', [$user->id]) }}" class='btn btn-primary btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                              <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                          </div>
                                          {!! Form::close() !!}
                                      </td>
                                  @endif
                              </tr>
                          @endforeach
                          </tbody>
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
                      </table>
                  </div>
                  <!-- /.box-body -->
              </div>
          </div>
      </div>
    </section>
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
    @endsection
