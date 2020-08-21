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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
            $('#region').DataTable({
               "bLengthChange" : false, //thought this line could hide the LengthMenu
            });
        });
    </script>
    <script>
        let operateurCountriesEvent = function() {
            $('.operateurcountries').on('click', function(e){
                var country_id = e.target.id;
                var datas = null;
                $.get('/json-operateurcountries?country_id=' + country_id,function(data) {
                    $('#operateur_select').empty();
                    $('#operateur_select').append(data.name);
                    $('#'+data.id).DataTable(
                        {
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
                            "bLengthChange" : false, //thought this line could hide the LengthMenu
                            "bInfo":false,
                        }
                    );
                });
            });
        };
        operateurCountriesEvent();
        $('#country').on('click', function (e) {
            console.log(e);
            $.get('/json-allcountries', function (data) {
                console.log(data);
                $('#cities').empty();
                $('#cities').append(data.name);
                $('#'+data.id).DataTable(
                    {
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
                        "bLengthChange" : false, //thought this line could hide the LengthMenu
                        "bInfo":false,
                    }
                );
                operateurCountriesEvent();
            });

        });
        $('#state').on('click', function (e) {
            console.log(e);
            $.get('/json-allstates', function (data) {
                console.log(data);
                $('#cities').empty();
                $('#cities').append(data.name);
                $('#'+data.id).DataTable(
                    {
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
                        "bLengthChange" : false, //thought this line could hide the LengthMenu
                        "bInfo":false,
                    }
                );
                $('.operateurstates').on('click', function(e){
                    var state_id = e.target.id;
                    var datas = null;
                    $.get('/json-operateurstates?state_id=' + state_id,function(data) {
                        $('#operateur_select').empty();
                        $('#operateur_select').append(data.name);
                        $('#'+data.id).DataTable(
                            {
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
                                "bLengthChange" : false, //thought this line could hide the LengthMenu
                                "bInfo":false,
                            }
                        );
                    });
                });
            });
        });
        $('#city').on('click', function (e) {
            console.log(e);
            $.get('/json-allcities', function (data) {
                $('#cities').empty();
                $('#cities').append(data.name);
                $('#'+data.id).DataTable(
                    {
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
                        "bLengthChange" : false, //thought this line could hide the LengthMenu
                        "bInfo":false,
                    }
                );
                $('.operateurcities').on('click', function(e){
                    var city_id = e.target.id;
                    var datas = null;
                    $.get('/json-operateurcities?city_id=' + city_id,function(data) {
                        $('#operateur_select').empty();
                        $('#operateur_select').append(data.name);
                        $('#'+data.id).DataTable(
                            {
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
                                "bLengthChange" : false, //thought this line could hide the LengthMenu
                                "bInfo":false,
                            }
                        );
                    });
                });
            });
        });
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(  {!! $diagram !!});
            var options = {
                legend: {
                    position: 'bottom',
                    alignment: 'center',
                    maxLines: 2
                }
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('1702f90c00112df631a4', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('dashboard-channel');
        channel.bind('my-event', function(data) {
            $('#' + data.to).click();
            alert(JSON.stringify(data));
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
                @if (auth()->user()->hasRole('Superadmin|Account Manager'))
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
                @endif
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
                        <div id="piechart" style="width: 500px; height: 400px;"></div>
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
                                <li>
                                    <select class="form-control bootstrap-select" style="font-size: 12px; height: 20px;">
                                        <option id="country" selected="selected">Pays</option>
                                        <option id="state">Regions</option>
                                        <option id="city">Villes</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="cities">
                            <table class="datatable table stripe dataTable no-footer dtr-column" id="region"  role="grid" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="showall">
                                    @foreach ($countries as $item)
                                    <tr>
                                        <td id='{{{$item->id}}}' class='operateurcountries'>{{ $item->name }}</td>
                                    </tr>
                                    @endforeach
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
                                <li>{{ trans('operators') }}</li>
                            </ul>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="operateur_select">
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
@endsection



