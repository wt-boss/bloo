@extends('admin.top-nav')


@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
        <small>Profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
        <li><a href="#"><i class="fas fa-user"></i> Users </a></li>
        <li class="active">Profile</li>
    </ol>
</section>
@endsection

@section('content')

<div class="row">
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
