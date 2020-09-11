@extends('admin.top-nav')

@section('page-css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('Users') }}
            <small>{{ trans('paneau_controle') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"> <i class="fas fa-tachometer-alt"></i> {{ trans('Dashboard') }}</a></li>
            <li class="active">{{ trans('Users') }}</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="row">
        @foreach($operations as $operation)
        <div class="col-md-3">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$operation->nom}}</font></font></h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            {{$operation->description}}
                            <div class="pull-right">
                              <a href="{{route('messages_show',$operation->id)}}">
                                  <button type="button" class="btn btn-sm btn-primary" >{{ trans('Voir_messages') }}</i>
                                  </button>
                              </a>
                            </div>
                        </font></font></div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
            @endforeach
    </div>

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
