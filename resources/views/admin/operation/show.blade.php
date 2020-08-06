@extends('admin.top-nav')


@section('content-header')

@endsection

@section('content')
<div class="panel panel-flat panel-wb" style="margin-bottom: 0px">
    <div class="panel-body" style="padding: 0;">
        <div class="row">
            <div class="col-lg-9 col-xs-12">
                <!-- DONUT CHART -->
                <div class="box" style="padding-top: 14px;">

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
                                    <p class="info-value">10</p>
                                </div>
                                <div class="info">
                                    <p class="label">Sites</p>
                                    <p class="info-value">25</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="info">
                                    <p class="label">Lecteurs</p>
                                    <p class="info-value">{{$operation->users()->where('role','1')->count()}}</p>
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
                                    <p class="info-value">{{$operation->users()->where('role','4')->get()->pluck('last_name')->last()}}</p>
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
                        <span class="pull-right" style="font-size: 20px;">
                            <i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="box-body">
                        <canvas id="pieChart" style="height:250px"></canvas>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title">
                                    Lecteurs
                                </h3>
                                <i class="fa fa-plus-circle pull-right" aria-hidden="true" id="getlecteur" title="{{ $operation->id }}" data-toggle="modal" data-target="#modal-default"></i>   </div>
                            </div>
                    </div>

                    <div class="box-body" id="lecteurs">
                        <ul class="nav nav-stacked">
                          @foreach ($operation->users as $user )
                             @if ($user->role === 0)
                             <li>
                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                   {{ $user->first_name }} {{ $user->last_name }}
                                </font></font>
                                <span class="pull-right"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                      <i class="fa fa-minus-circle removelecteur"  id="removelecteur" title="{{ $user->id }}"  lang="{{ $operation->id }}" aria-hidden="true"></i>
                                    </font></font></span>
                            </li>
                              @endif
                          @endforeach
                        </ul>
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
                                <i class="fa fa-plus-circle pull-right" aria-hidden="true" id="getoperateur" title="{{ $operation->id }}" data-toggle="modal" data-target="#operateur-default"></i>                    </div>
                            </div>
                    </div>
                    <div class="box-body" id="lecteurs">
                        <ul class="nav nav-stacked">
                          @foreach ($operation->users as $user )
                             @if ($user->role === 1)
                             <li>
                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                   {{ $user->first_name }} {{ $user->last_name }}
                                </font></font>
                                <span class="pull-right"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                      <i class="fa fa-minus-circle removeoperateur"  id="removeoperateur" title="{{ $user->id }}"  lang="{{ $operation->id }}" aria-hidden="true"></i>
                                    </font></font></span>
                            </li>
                              @endif
                          @endforeach
                        </ul>
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

<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
                </button>
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter des lecteurs</font></font></h4>
            </div>
            <form method="POST" action="{{ route('ajoutlecteur') }}">
                @csrf
                <input type="hidden" name="operation" value="{{ $operation->id }}" />
                <div class="modal-body">
                    <ul class="nav nav-stacked" id="listlecteur"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fermer</font></font></button>
                    <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sauvegarder les modifications</font></font></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="operateur-default" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter des operateur</font></font></h4>
            </div>
            <form method="POST" action="{{ route('ajoutoperateur') }}">
                @csrf
                <input type="hidden" name="operation" value="{{ $operation->id }}">
                <div class="modal-body">
                    <ul class="nav nav-stacked" id="listoperateur"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fermer</font></font></button>
                    <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sauvegarder les modifications</font></font></button>
                </div>
            </form>
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
            $('#listlecteur').empty();
            $.each(data, function (index, lecteurObj) {
                if(lecteurObj.status === true)
                {
                    $('#listlecteur').append('<li><div class="input-group"><span class="input-group-addon"><input type="checkbox" name="lecteurs[]" value="'+ lecteurObj.id +'" disabled></span><input type="text" class="form-control"value="'+ lecteurObj.first_name + ' ' +lecteurObj.last_name +' " disabled></div></li>');
                }
                else
                {
                    $('#listlecteur').append('<li><div class="input-group"><span class="input-group-addon"><input type="checkbox" name="lecteurs[]" value="'+ lecteurObj.id +'"></span><input type="text" class="form-control"value="'+ lecteurObj.first_name + ' ' +lecteurObj.last_name +' " disabled></div></li>');
                }
            })
        });
    });

    $('.removelecteur').on('click', function (e) {
        console.log(e);
        var operation_id = e.target.lang;
        var user_id = e.target.title;
        $.get('/removelecteurs/' + user_id + '/' + operation_id , function (data) {
            if(data && $.parseJSON('true') == true){
                $(e.target).parents('li').remove();
            }
        });
    });

    $('.removeoperateur').on('click', function (e) {
        console.log(e);
        var operation_id = e.target.lang;
        var user_id = e.target.title;
        $.get('/removeoperateurs/' + user_id + '/' + operation_id , function (data) {
            if(data && $.parseJSON('true') == true){
                $(e.target).parents('li').remove();
            }
        });
    });


    $('#getoperateur').on('click', function (e) {
        console.log(e);
        var operation_id = e.target.title;
        $.get('/listoperateurs/' + operation_id, function (data) {
            console.log(data);
            $('#listoperateur').empty();
            $.each(data, function (index, OperateurObj) {
                if(OperateurObj.status === true)
                {
                    $('#listoperateur').append('<li><div class="input-group"><span class="input-group-addon"><input type="checkbox" name="operateurs[]" value="'+ OperateurObj.id +'"  disabled></span><input type="text" class="form-control"value="'+ OperateurObj.first_name + ' ' +OperateurObj.last_name +' " disabled></div></li>');
                }
                else
                {
                    $('#listoperateur').append('<li><div class="input-group"><span class="input-group-addon"><input type="checkbox" name="operateurs[]" value="'+ OperateurObj.id +'"></span><input type="text" class="form-control"value="'+ OperateurObj.first_name + ' ' +OperateurObj.last_name +' " disabled></div></li>');
                }
            })
        });
    });



</script>
@endsection
