


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
{{--                            <div class="info">--}}
{{--                                <p class="label">Villes</p>--}}
{{--                                <p class="info-value">--}}
{{--                                    {{$operation->sites->count()}}--}}
{{--                                </p>--}}
{{--                            </div>--}}
                            <div class="info">
                                <p class="label">Sites</p>
                                <p class="info-value">{{$operation->sites()->count()}}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="info">
                                <p class="label">{{trans('Lecteurs') }}</p>
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
                                    @if($user != null)
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    @endif
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
                            <a class="dropdown-toggle" style="color:#0065A1; font-size:16px;" data-toggle="dropdown" href="#">
                                    {{ trans('sort_by') }}
                                </a>
                              <select id="countries"  class="browser-default custom-select custom-select-lg mb-3" style="font-size: 12px;">
                                 <option>...</option>
                                 <option   value="1">Pays</option>
                                 <option value="2">Sites</option>
                                 <option value="3">Opérateurs</option>
                            </select>

                            <select id="select1" class="browser-default custom-select custom-select-lg mb-3" style="font-size: 12px; display:none;">

                            </select>
                            <select id="select2" class="browser-default custom-select custom-select-lg mb-3" style="font-size: 12px; display:none;">

                            </select>
                            <select id="select3" class="browser-default custom-select custom-select-lg mb-3" style="font-size: 12px; display:none;">

                            </select>
                        </ul>
                        <span class="pull-right">
                            {{-- <i class="fa fa-file-powerpoint" style="font-size: 20px" aria-hidden="true"></i> --}}
                            <a id="download_pdf" >
                               <img src="{{ asset('assets/images/PDF_24.png') }}" ></img>
                             </a>
                            {{-- <a href="{{ route('forms.response.export', $form->code) }}">
                                <img src="{{ asset('assets/images/exel.png') }}" ></img>
                            </a> --}}
                        </span>
                    </div>


                    <div class="box-body row" id="responses">
                        {!! $view !!}
                    </div>

{{--                    <div class="box-body row" id="responsesprint" style="display: none" >--}}
{{--                        {!! $viewprint !!}--}}
{{--                        </div>--}}
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
                        {{-- <div class="text-center">
                            <button class="btn btn-xs-bloo disabled m_btn_op m_btn_message"><i class="icon ions ion-chatboxes"></i> {{ trans('Message') }}</button>
                            <button class="btn btn-xs-bloo disabled m_btn_op m_btn_location"><i class="icon ions ion-location"></i> {{ trans('Localisation') }}</button>
                        </div> --}}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-info">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="box-title">
                                    {{ trans('Localisation') }}
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
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('add_lecteurs1')}}</font></font></h4>
            </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('ajoutlecteur') }}">
                        @csrf
                        <input type="hidden" name="operation" value="{{ $operation->id }}" />
                        <div id="datalecteurs">

                        </div>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fermer</font></font></button>
                        <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('savee') }}</font></font></button>
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
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('add_ops') }}</font></font></h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ajoutlecteur') }}">
                    @csrf
                    <input type="hidden" name="operation" value="{{ $operation->id }}" />
                    <div id="dataoperateurs">

                    </div>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Close') }}</font></font></button>
                    <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('savee') }}</font></font></button>
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
                 $('#'+data.id).DataTable({
                     "language": {
                         @if( app()->getLocale() === "fr" )
                         "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                         @endif
                             @if( app()->getLocale() === "en")
                         "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                         @endif
                             @if( app()->getLocale() === "es")
                         "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                         @endif
                             @if( app()->getLocale() === "pt")
                         "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
                         @endif
                     },

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
                     ]
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
                $('#'+data.id).DataTable({
                    "language": {
                        @if( app()->getLocale() === "fr" )
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                        @endif
                            @if( app()->getLocale() === "en")
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                        @endif
                            @if( app()->getLocale() === "es")
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                        @endif
                            @if( app()->getLocale() === "pt")
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
                        @endif
                    },

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
                    })
            });
        });
    </script>
    <script type="text/javascript">
        document.getElementById('download_pdf').onclick = function () {
            var now = new Date();
            var annee   = now.getFullYear();
            var mois    = now.getMonth() + 1;
            var jour    = now.getDate();
            var heure   = now.getHours();
            var minute  = now.getMinutes();
            var seconde = now.getSeconds();
            var imgData = 'data:image/png;base64,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'
            var element = document.getElementById('responses');
            var opt = {
                margin:      [20, 20, 20, 20] ,
                enableLinks: true,
                filename:     '{{$operation->nom}}.pdf',
                image:        { type: 'jpeg', quality: .95 },
                html2canvas:  {scale: 1},
                jsPDF:        { unit: 'mm', format: 'letter', orientation: 'landscape' }
            };
            html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
                var totalPages = pdf.internal.getNumberOfPages();
                console.log(totalPages)
                for (i = 1; i <= totalPages; i++) {
                    console.log('here', i);
                    pdf.setPage(i);
                    pdf.setFont("helvetica");
                    pdf.setFontSize(10);
                    pdf.text('Page ' + i + '/' + totalPages, 260, 210);
                    pdf.text('Imprimé le : '+jour+"/"+mois+"/"+annee+" à "+heure+":"+minute+":"+seconde,05, 210);
                    pdf.addImage(imgData, "PNG",  240, 0);
                    pdf.setFontType("bolditalic");
                    pdf.text('{{$operation->nom}} ({{ $user->first_name }} {{ $user->last_name }})',05,12);
                }
            }).save();

        };
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

        {{--let data_for_chart2 = {!! json_encode($data_for_chart2) !!};--}}

        // if (typeof data_for_chart2 === 'object' && data_for_chart2 instanceof Array && data_for_chart2.length) {
        //     google.charts.setOnLoadCallback(function () {
        //         drawCharts(data_for_chart2);
        //     });
        // }

        $(function () {
            // Resize chart on sidebar width change and window resize
            $(window).on('resize', function () {
                drawCharts(data_for_chart);
            });
        });
    </script>
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

                // data_for_chart2 = JSON.parse(response.data_for_chart2);
                //
                // drawCharts(data_for_chart2);

                $(function () {
                    // Resize chart on sidebar width change and window resize
                    $(window).on('resize', function () {
                        drawCharts(data_for_chart);
                    });
                });
            });

        });
    </script>
    <script>
        $('#countries').on('change', function(e){
            console.log(e);
            var sortoption  = e.target.value;
            if(sortoption == 1)
            {
                $.get('/jsonmapcountries2',function(data) {
                    console.log(data);
                    $('#select1').empty();
                    var element = document.getElementById('select2');
                    element.style.display = "initial";
                    $('#select1').append('<option value="Selectionnez un pays">Selectionnez un pays</option>');
                    $.each(data, function(index, countriesObj){
                        $('#select1').append('<option value="'+ countriesObj.id +'">'+ countriesObj.name +'</option>');
                    })
                });

            }
            if(sortoption == 2)
            {
                $.get('/operationsites/'+{{$operation->id}},function(data) {
                    console.log(data);
                    $('#select2').empty();
                    var element = document.getElementById('select2');
                    element.style.display = "initial";
                    $('#select2').append('<option value="Selectionnez un site">Selectionnez un site</option>');
                    $.each(data, function(index, sitesObj){
                        $('#select2').append('<option value="'+ sitesObj.id +'">'+ sitesObj.nom +'</option>');
                    })
                });
            }
        });

        $('#select1').on('change', function(e){
            var pays_id = e.target.value;
            {
                $.get('/operation/'+'{{$operation->id}}'+'/'+ pays_id,function(response) {
                    console.log(response);
                    $('#responses').empty()
                        .append(response.response_view);

                    data_for_chart = JSON.parse(response.data_for_chart);

                    drawCharts(data_for_chart);

                    $(function () {
                        // Resize chart on sidebar width change and window resize
                        $(window).on('resize', function () {
                            drawCharts(data_for_chart);
                        });
                    });
                });
            }
        });

        $('#select2').on('change', function(e){
            var site_id = e.target.value;
            {
                $.get('/siteoperation/'+'{{$operation->id}}'+'/'+ site_id,function(response) {
                    console.log(response);

                    $('#responses').empty()
                        .append(response.response_view);

                    data_for_chart = JSON.parse(response.data_for_chart);

                    drawCharts(data_for_chart);

                    $(function () {
                        // Resize chart on sidebar width change and window resize
                        $(window).on('resize', function () {
                            drawCharts(data_for_chart);
                        });
                    });
                });
            }
        });
    </script>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection
