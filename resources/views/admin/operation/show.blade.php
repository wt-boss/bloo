


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
                        <span>Informations generales : </span> <span class="bloo-primary-color">{{$operation->nom}}</span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-6 col-lg-3">
                            <div class="info">
                                <p class="label">Date debut</p>
                                <p class="info-value">{{$operation->date_start}}</p>
                            </div>
                            <div class="info">
                                <p class="label">Date debut</p>
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
                                <p class="label">Lecteurs</p>
                                <p class="info-value">{{$operation->users()->where('role','0')->count()}}</p>
                            </div>
                            <div class="info">
                                <p class="label">Operateur</p>
                                <p class="info-value">{{$operation->users()->where('role','1')->count()}}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="info">
                                <p class="label">Clent</p>
                                <p class="info-value">{{$operation->entreprise->nom}}</p>
                            </div>
                            <div class="info">
                                <p class="label">Fondé</p>
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
                                    <a href="{{ route('forms.show', [$operation->form->code]) }}" class="btn form-control">Afficher le questionnaire</a>
                                </div>
                            </div>
                            <div class="col-xs-12" style="padding: 0">
                                <div class="small-box bg-white">
                                    <a href="{{ route('operation.index') }}"  class="btn form-control">Selectionner une opération</a>
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
                        <ul class="box-title">
                            <li>{{ trans('statistiques') }}</li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    {{ trans('sort_by') }} <span class="caret"></span>
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
                        <span class="pull-right" style="font-size: 40px;">
                            <i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
                             <a href="{{ route('forms.response.export2', $operation->id) }}">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                             </a>
                            <a href="{{ route('forms.response.export', $form->code) }}">
                                <i class="fa fa-file-excel-o" aria-hidden="true">  </i>
                            </a>
                        </span>
                    </div>
                    <div class="box-body row" id="responses">
                        @php
                            $data_for_chart = [];
                            $fields = $form->fields;
                            $template_alias_no_options = get_form_templates()->where('attribute_type', 'string')->pluck('alias')->all();
                        @endphp
                        @foreach ($fields as $field)
                            @php
                                $responses = $field->responses;
                                $responses_count = $responses->where('answer', '!==', null)->count();
                            @endphp

                                <div class="col-md-6">
                                    <label class="label-xlg">{{ $field->question }}
                                        @if ($field->required) <span class="text-danger">*</span> @endif
                                    </label>
                                    <p>{{ $responses_count }} {{ Str::plural(trans('response'), $responses_count) }}</p>

                                    @if (in_array($field->template, $template_alias_no_options))
                                        <div class="table-responsive">
                                            <table class="table table-striped-info table-xxs table-framed-info">
                                                @foreach ($responses as $response)
                                                    @if ($loop->index === 10)
                                                        <tr><strong>{{ trans('more_info') }}</strong></tr>
                                                        @break
                                                    @endif
                                                    <tr>
                                                        @php $answer = $response->getAnswerForTemplate($field->template); @endphp
                                                        <td>{!! $answer !!}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @else
                                        @php $response_for_chart = $field->getResponseSummaryDataForChart(); @endphp
                                        @if (!empty($response_for_chart))
                                            @php $data_for_chart[] = $response_for_chart; @endphp
                                            <div class="col-6 chart-container{{ ($response_for_chart['chart'] == 'pie_chart') ? ' text-center' : '' }}">
                                                <div class="{{ ($response_for_chart['chart'] == 'pie_chart') ? 'display-inline-block' : 'chart' }}" id="{{ $response_for_chart['name'] }}"></div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                        @endforeach
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-success ">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title">
                                    Lecteurs
                                </h3>
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
                                <h3 class="box-title">
                                    Operateurs
                                </h3>
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
                                    <td>
                                        {{ $user->first_name }} {{ $user->last_name }}
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
                            <button class="btn btn-xs-bloo disabled"><i class="icon ions ion-chatboxes"></i> Message</button>
                            <button class="btn btn-xs-bloo"><i class="icon ions ion-location"></i> Localisation</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-info">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title">
                                    Localisation
                                </h3>
                            </div>
                        </div>

                    </div>

                    <div class="box-body" id="lecteurs">

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
    <script type="text/javascript">
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

        var data_for_chart = {!! json_encode($data_for_chart) !!};

        if (typeof data_for_chart === 'object' && data_for_chart instanceof Array && data_for_chart.length) {
            google.charts.setOnLoadCallback(function () {
                drawCharts(data_for_chart);
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
            location.reload(true);
        });
    </script>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection
