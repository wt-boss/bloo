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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

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

        // $(function() {
        //     $('.datatable').DataTable({
        //         responsive: {
        //             details: {
        //                 type: 'column',
        //                 target: 'tr'
        //             }
        //         },
        //         columnDefs: [
        //             {
        //                 className: 'control',
        //                 orderable: false,
        //                 targets:   0
        //             },
        //             {
        //                 orderable: false,
        //                 targets: [-1]
        //             },
        //             { responsivePriority: 1, targets: 0 },
        //         ],
        //         "bLengthChange" : false, //thought this line could hide the LengthMenu
        //         "bInfo":false,
        //     });
        // });
    </script>
    <script>
        $('#country').on('click', function (e) {
            console.log(e);
            $.get('/json-allcountries', function (data) {
                console.log(data);
                $('#showall').empty();
                $.each(data, function (index, countryObj) {
                        $('#showall').append('<tr><td>' + countryObj.name + '</td></tr>');
                })
            });
        });

        $('#state').on('click', function (e) {
            console.log(e);
            // $.get('/json-allstates', function (data) {
            //     console.log(data);
            //     $('#showall').empty();
            //     $.each(data, function (index, countryObj) {
            //         $('#showall').append('<tr><td>' + countryObj.name + '</td></tr>');
            //     })
            //     $('#region').DataTable();
            // });
            $.get('/json-allstates', function (data) {
                console.log(data);
                $('#cities').empty();
                $('#cities').append(data.name);
                $('#'+data.id).DataTable();
            });
        });

        $('#city').on('click', function (e) {
            console.log(e);
            $.get('/json-allcities', function (data) {
                console.log(data);
                $('#cities').empty();
                $('#cities').append(data.name);
                $('#'+data.id).DataTable();
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
                        <h3>{{$rapports->count()}}</h3>

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
                                        <li role="presentation" class="selected"><a role="menuitem" tabindex="-1" href="#" id="country">Pays</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="state">Regions</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="city">Villes</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="cities">
                            <table class="table" id="region">
                                    <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="showall">
                                    <tr>
                                        <td></td>
                                    </tr>
                                    </tbody>
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
                            <table class="datatable table">
                                <thead>
                                <tr>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                                </tbody>
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



