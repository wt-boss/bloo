@extends('admin.top-nav')

@section('title', 'Accueil')

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

@section('plugin-scripts')
	<script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/datatable.js') }}"></script>
    <script>
        $(function() {
            $('.datatable').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [
                    {
                        className: 'control',
                        orderable: false,
                        targets:   0
                    },
                    {
                        orderable: false,
                        targets: [-1]
                    },
                    { responsivePriority: 1, targets: 0 },
                ],
            });

            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });
        });
    </script>
@endsection

@section('content')

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat panel-wb">
        <div class="panel-body" style="padding: 0;">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-white">
                      <div class="inner">
                        <h3>{{$comptes->count()}}</h3>

                        <p>{{ trans('accounts') }}</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-briefcase"></i>
                      </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-white">
                      <div class="inner">
                        <h3>{{$operations->count()}}</h3>

                        <p>{{ trans('operations') }}</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-social-buffer"></i>
                      </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-white">
                      <div class="inner">
                        <h3>{{$operateurs->count()}}</h3>

                        <p>{{ trans('operators') }}</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-android-person"></i>
                      </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-white">
                      <div class="inner">
                        <h3>150</h3>

                        <p>{{ trans('reports') }}</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-document-text"></i>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <!-- DONUT CHART -->
                    <div class="box" style="height: 100%;">
                        <div class="box-header with-border">
                            <ul class="box-title">
                                <li>{{ trans('client_operations') }}</li>
                            </ul>
                        </div>
                        <div class="box-body">
                        <canvas id="pieChart" style="height:250px"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <ul class="box-title">
                                <li>trier par</li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Dropdown <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table">
                                <tr>
                                  <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                                <tr>
                                    <td>Abong Mbang</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <ul class="box-title">
                                <li>{{ trans('resources') }}</li>
                            </ul>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table">
                                @foreach($lecteurs as $lecteur)
                                <tr>
                                  <td>{{$lecteur->first_name}} {{$lecteur->last_name}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
@endsection
