@extends('admin.top-nav')


@section('content-header')

@endsection

@section('content')
<div class="panel panel-flat panel-wb">
    <div class="panel-body" style="padding: 0;">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-md-8 col-xs-12">
                    <div class="row">
                        title : datatitle
                    </div>
                    <div class="row">
                        <div class="col-md-4">data</div>
                        <div class="col-md-4">data</div>
                        <div class="col-md-4">data</div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="" class="btn-bloo-w">{{ trans('show_form') }}</a>
                        </div>
                        <div class="col-xs-12">
                            <a href="" class="btn-bloo-w">{{ trans('select_op') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                  <div class="modal fade" id="modal-default" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                            <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
                          <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter des lecteurs</font></font></h4>
                        </div>
                        <form method="POST" action="{{ route('ajoutlecteur') }}">
                            @csrf
                            <input type="hidden" name="operation" value="{{ $operation->id }}">
                             <div class="modal-body">
                                <ul class="nav nav-stacked" id="listlecteur">
                                </ul>
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
                                <ul class="nav nav-stacked" id="listoperateur">

                                </ul>
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
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-white">
                  <div class="inner">
                    <h3>150</h3>

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
                    <h3>150</h3>

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
                    <h3>150</h3>

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
                            <tr>
                              <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                            <tr>
                                <td>Cedric NOUMBO</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-md-8 col-xs-12">
            <div class="row">
                title : datatitle
            </div>
            <div class="row">
                <div class="col-md-4">data</div>
                <div class="col-md-4">data</div>
                <div class="col-md-4">data</div>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <a href="" class="btn-bloo-w">{{ trans('show_form') }}</a>
                </div>
                <div class="col-xs-12">
                    <a href="" class="btn-bloo-w">{{ trans('select_op') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
          <div class="modal fade" id="modal-default" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
                  <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter des lecteurs</font></font></h4>
                </div>
                <form method="POST" action="{{ route('ajoutlecteur') }}">
                    @csrf
                    <input type="hidden" name="operation" value="{{ $operation->id }}">
                     <div class="modal-body">
                        <ul class="nav nav-stacked" id="listlecteur">
                        </ul>
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
                        <ul class="nav nav-stacked" id="listoperateur">

                        </ul>
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
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


    </div>

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
