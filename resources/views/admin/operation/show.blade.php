


@extends('admin.top-nav')

@section('content-header')

@endsection

@section('content')
<div class="panel panel-flat panel-wb" style="margin-bottom: 0px">
    <div class="panel-body" style="padding: 0;">
        <div class="row">
            <div class="col-lg-9 col-xs-12">
                <!-- DONUT CHART -->
                <div class="box">
                    <div class="box-header with-border">
                        <p class="box-title" >{{trans('informations_generales')}} <span style="color: #0065A1; font-size:15px;">{{$operation->nom}}</span></p>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-6 col-lg-3">
                            <div class="info">
                                <p class="label">{{ trans('Date_debut') }}</p>
                                <p class="info-value">{{$operation->date_start}}</p>
                            </div>
                            <div class="info">
                                <p class="label">{{ trans('Dat_fin') }}</p>
                                <p class="info-value">{{$operation->date_end}}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="info">
                                <p class="label">Villes</p>
                                <p class="info-value">
                                    {{$operation->sites->count()}}
                                </p>
                            </div>
                            <div class="info">
                                <p class="label">Sites</p>
                                <p class="info-value">{{$operation->sites()->count()}}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="info">
                                <p class="label">trans{{trans('Lecteurs')  }}</p>
                                <p class="info-value">{{$operation->users()->where('role','0')->count()}}</p>
                            </div>
                            <div class="info">
                                <p class="label">{{ trans('Opérateurs') }}</p>
                                <p class="info-value">{{$operation->users()->where('role','1')->count()}}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="info">
                                <p class="label">Clent</p>
                                <p class="info-value">{{$operation->entreprise->nom}}</p>
                            </div>
                            <div class="info">
                                <p class="label">{{ trans('Fondé') }}</p>
                                <p class="info-value">
                                    @php
                                        $entreprise = $operation->entreprise()->with('users')->get()->last();
                                        $user = $entreprise->users()->get()->last();
                                    @endphp
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="box box-solid panel-wb">
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 0 10px;">
                        <div class="row">
                            <div class="col-xs-12" style="padding: 0">
                                <div class="small-box bg-white">
                                    <a href="{{ route('forms.show', [$operation->form->code]) }}" class="btn form-control">{{ trans('Afficher_le_questionnaire') }}</a>
                                </div>
                            </div>
                            <div class="col-xs-12" style="padding: 0">
                                <div class="small-box bg-white">
                                    <a href="{{ route('operation.index') }}"  class="btn form-control">{{ trans('Selectionner_une_opération') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>

<div class="panel panel-flat panel-wb">
    <div class="panel-body" style="padding: 0;">
        <div class="row">
            <div class="col-md-9">
                <div class="box" style="height: 100%;">
                    <div class="box-header with-border">
                        <ul class="box-title" style="padding-left: 4px;">
                            <li>{{ trans('response_stats') }}</li>

                            <li class="dropdown">
                                <a class="dropdown-toggle" style="color:#0065A1; font-size:16px;" data-toggle="dropdown" href="#">
                                    {{ trans('sort_by') }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item" role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                        <span class="pull-right">
                            <i class="fa fa-file-powerpoint" style="font-size: 20px" aria-hidden="true"></i>

                             <a id="download_pdf" href="#">
                                <i class="fa fa-file-pdf"  style="font-size: 20px" aria-hidden="true" ></i>
                             </a>

                            <a href="{{ route('forms.response.export', $form->code) }}">
                                <i class="fa fa-file-excel"  style="font-size: 20px" aria-hidden="true">  </i>
                            </a>
                        </span>
                    </div>


                    <div class="box-body row" id="responses">
                        {!! $view !!}
                    </div>

                    <div class="box-body row" id="responsesprint" style="display: none" >
                        {!! $viewprint !!}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-success ">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="box-title">
                                    {{ trans('Lecteurs') }}
                                </p>
                                @if (auth()->user()->hasRole('Superadmin|Account Manager'))
                                <i class="fa fa-plus-circle pull-right" aria-hidden="true" id="getlecteur" title="{{ $operation->id }}" data-toggle="modal" data-target="#modal-default"></i>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body" id="lecteurs">
                        <table class="datatable table stripe">
                            <thead>
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                          @foreach ($operation->users as $user )
                             @if ($user->role === 0)
                                 <tr>
                                     <td>
                                   {{ $user->first_name }} {{ $user->last_name }}
                                      <span class="pull-right">
                                          @if (auth()->user()->hasRole('Superadmin|Account Manager'))
                                      <i class="fa fa-minus-circle removelecteur"  id="removelecteur" title="{{ $user->id }}"  lang="{{ $operation->id }}" aria-hidden="true"></i>
                                        @endif
                                      </span>
                                    </td>
                                 </tr>
                              @endif
                          @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-info">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="box-title">
                                    {{ trans('Opérateurs') }}
                                </p>
                                @if (auth()->user()->hasRole('Superadmin|Account Manager'))
                                <i class="fa fa-plus-circle pull-right" aria-hidden="true" id="getoperateur" title="{{ $operation->id }}" data-toggle="modal" data-target="#operateur-default"></i>
                                @endif
                            </div>
                            </div>
                    </div>

                    <div class="box-body" id="operateurs">
                        <table class="datatable table stripe">
                            <thead>
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($operation->users as $user )
                                    @if ($user->role === 1)
                                <tr>
                                    <td class="m_operateur" data_lat="4.050000" data_lng="9.700000">
                                        <span class="op_first_name">{{ $user->first_name }}</span> <span class="op_last_name">{{ $user->last_name }}</span>
                                        <span class="pull-right">
                                            @if (auth()->user()->hasRole('Superadmin|Account Manager'))
                                                <i class="fa fa-minus-circle removeoperateur"  id="removeoperateur" title="{{ $user->id }}"  lang="{{ $operation->id }}" aria-hidden="true"></i>
                                            @endif
                                       </span>
                                    </td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button class="btn btn-xs-bloo disabled m_btn_op m_btn_message"><i class="icon ions ion-chatboxes"></i> Message</button>
                            <button class="btn btn-xs-bloo disabled m_btn_op m_btn_location"><i class="icon ions ion-location"></i> Localisation</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-info">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="box-title">
                                    Localisation
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="box-body" id="map_lecteurs">

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>

    <div class="modal fade bd-example-modal-lg"  id="modal-default" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
                </button>
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter des lecteurs</font></font></h4>
            </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('ajoutlecteur') }}">
                        @csrf
                        <input type="hidden" name="operation" value="{{ $operation->id }}" />
                        <div id="datalecteurs">

                        </div>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fermer</font></font></button>
                        <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sauvegarder</font></font></button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="operateur-default" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter des operateurs</font></font></h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ajoutlecteur') }}">
                    @csrf
                    <input type="hidden" name="operation" value="{{ $operation->id }}" />
                    <div id="dataoperateurs">

                    </div>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fermer</font></font></button>
                    <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sauvegarder</font></font></button>
                </form>
            </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bZln12ut506FLipFx-kXh95M-zZdUfc&libraries=places&callback=initMap" defer></script>
    <script type="text/javascript">
        function initMap() {
            let lat = "";
            let lng = "";
            let first_name = "";
            let last_name = "";

            let map = new google.maps.Map(document.getElementById("map_lecteurs"), {
                center: { lat: 4.050000, lng: 9.700000 },
                zoom: 15
            });

            $('.m_operateur').click(function(){
                if($(this).hasClass('op_active')){
                    lat = "";
                    lng = "";
                    first_name = "";
                    last_name = "";

                    $(this).removeClass('op_active');
                    $('.m_btn_op').addClass('disabled');
                }else{
                    lat = $(this).attr("data_lat");
                    lng = $(this).attr("data_lng");
                    first_name = $(this).find(".op_first_name").html();
                    last_name = $(this).find(".op_last_name").html();

                    $(this).addClass('op_active');
                    $('.m_btn_op').removeClass('disabled');
                }
            });

            $('.m_btn_location').click(function(){
                let position = { lat: parseFloat(lat), lng: parseFloat(lng) };
                map.setCenter(position);
                let marker = new google.maps.Marker({
                    position: position,
                    map,
                    animation: google.maps.Animation.DROP
                });
                let contentString = "" +
                    "<div class=\"infowindow-content\">\n" +
                    "    <span class=\"place-name title\">"+ first_name + "</span><br>" +
                    "    <span class=\"place-address\">"+ last_name +"</span>\n" +
                    "</div>";

                let infowindow = new google.maps.InfoWindow({
                    content: contentString
                    });
                marker.addListener("click", () => {
                    infowindow.open(map, marker);
                });
            });
        }
        function addlecteur() {
            $('#listlecteur').on('click', function (e) {
                //console.log(e);
                var lecteur_id = e.target.id;
                console.log(lecteur_id);
            });
        }
        $('#getlecteur').on('click', function (e) {
            console.log(e);
            var operation_id = e.target.title;
            $.get('/listlecteurs/' + operation_id, function (data) {
                console.log(data);
                 $('#datalecteurs').empty();
                 $('#datalecteurs').append(data.name);
                 $('#'+data.id).DataTable(
                    {
                        responsive: {
                            details: {
                                type: 'column',
                                target: 'tr'
                            }
                        },
                        "bLengthChange" : false, //thought this line could hide the LengthMenu
                        "bInfo":false,
                    })

            });
        });

        $('.removelecteur').on('click', function (e) {
            console.log(e);
            var operation_id = e.target.lang;
            var user_id = e.target.title;
            $.get('/removelecteurs/' + user_id + '/' + operation_id , function (data) {
                if(data && $.parseJSON('true') == true){
                    $(e.target).parents('tr').remove();
                }
            });
        });

        $('.removeoperateur').on('click', function (e) {
            console.log(e);
            var operation_id = e.target.lang;
            var user_id = e.target.title;
            $.get('/removeoperateurs/' + user_id + '/' + operation_id , function (data) {
                if(data && $.parseJSON('true') == true){
                    $(e.target).parents('tr').remove();
                }
            });
        });

        $('#getoperateur').on('click', function (e) {
            console.log(e);
            var operation_id = e.target.title;
            $.get('/listoperateurs/' + operation_id, function (data) {
                console.log(data);
                $('#dataoperateurs').empty();
                $('#dataoperateurs').append(data.name);
                $('#'+data.id).DataTable(
                    {
                        responsive: {
                            details: {
                                type: 'column',
                                target: 'tr'
                            }
                        },
                        "bLengthChange" : false, //thought this line could hide the LengthMenu
                        "bInfo":false,
                    })
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/js-html2pdf@1.1.4/lib/html2pdf.min.js"></script>
    <script type="text/javascript">
        $('#download_pdf').click(function () {
            // Get the element to print
            var element = document.getElementById('responsesprint');
                element.style.display = "initial";
            // Define optional configuration
            var options = {
                filename: 'response.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' },
                pdfCallback: pdfCallback
            };
            function pdfCallback(pdfObject) {
                var number_of_pages = pdfObject.internal.getNumberOfPages()
                var pdf_pages = pdfObject.internal.pages
                var myFooter = "Footer info"
                for (var i = 1; i < pdf_pages.length; i++) {
                    // We are telling our pdfObject that we are now working on this page
                    pdfObject.setPage(i)
                    // The 10,200 value is only for A4 landscape. You need to define your own for other page sizes
                    pdfObject.text(myFooter, 10, 200)
                }
            };
            options.source = element;
            options.download = true;
            html2pdf.getPdf(options);
            element.style.display = "none";
        });
    </script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/custom/pages/datatable.js') }}"></script> --}}
    <script>
        $(function() {
            $('.datatable').DataTable(
                {
                    "bLengthChange" : false, //thought this line could hide the LengthMenu
                    "searching": false
                })
        });
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('assets/js/custom/pages/response-summary.js') }}"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});

        let data_for_chart = {!! json_encode($data_for_chart) !!};

        if (typeof data_for_chart === 'object' && data_for_chart instanceof Array && data_for_chart.length) {
            google.charts.setOnLoadCallback(function () {
                drawCharts(data_for_chart);
            });
        }


        let data_for_chart2 = {!! json_encode($data_for_chart2) !!};

        if (typeof data_for_chart2 === 'object' && data_for_chart2 instanceof Array && data_for_chart2.length) {
            google.charts.setOnLoadCallback(function () {
                drawCharts(data_for_chart2);
            });
        }
        $(function () {
            // Resize chart on sidebar width change and window resize
            $(window).on('resize', function () {
                drawCharts(data_for_chart);
            });
        });
    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('1702f90c00112df631a4', {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe('responce-channel');
        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data));
            // location.reload(true);
            $.get('/operation/{!! $operation->id !!}' ,function(response) {
                $('#responses').empty()
                    .append(response.response_view);

                data_for_chart = JSON.parse(response.data_for_chart);

                drawCharts(data_for_chart);


                data_for_chart2 = {!! json_encode($data_for_chart2) !!};

                drawCharts(data_for_chart2);

                $(function () {
                    // Resize chart on sidebar width change and window resize
                    $(window).on('resize', function () {
                        drawCharts(data_for_chart);
                    });
                });
            });

        });
    </script>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection
