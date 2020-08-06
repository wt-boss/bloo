@extends('admin.top-nav')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-bottom: 10px;">
        <div class="panel-body" style="padding: 0;">
            <div class="row">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-bloo heading-btn legitRipple" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fas fa-plus-circle"></i>Attribuer un compte
                </button>
                <div class="pull-right">
                    <a href="{{route('compte.create')}}" class="btn btn-bloo heading-btn legitRipple"><i class="fas fa-plus-circle"></i> Creer un compte</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
<div class="row comptes">



    <table class="datatable table stripe">
        <thead>
        <tr>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <tr>
            @foreach($comptes as $compte)
            <th>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-b-blue-gradient">
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="{{asset('assets/images/about.jpg')}}" alt="User Avatar">
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-12 border-right">
                                    <div class="description-block">
                                        {{$compte->users()->where('role','4')->get()->pluck('last_name')->last()}}
                                        <h5 class="description-header" title="{{$compte->nom}}">{{$compte->nom}}</h5>
                                        <span class="description-text">
                                Compte Primus
                                @if($compte->type === "Personne Physique")
                                                Particulier
                                            @else
                                                Entreprise
                                            @endif
                            </span>
                                        <span class="description-text">{{$compte->ville}}, {{$compte->pays}}</span>
                                        <span class="description-text">{{$compte->operations->count()}} operations</span>
                                        <span class="description-text">{{$compte->email}}</span>
                                        <button class=" btn btn-xs-bloo"><i class="fas fa-cog"></i> Parametres</button>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <!-- /.col -->
            </th>
            @endforeach
        </tr>

        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('savegift') }}">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Veuillez choisir un Account Manager et une operation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @csrf
                    <select class="form-control" name="user_id" required>
                        @foreach($users as $user)
                            <option  value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control" name="entreprise_id" required>
                        @foreach($comptes as $sompte)
                            <option  value="{{$sompte->id}}">{{$sompte->nom}}</option>
                        @endforeach
                    </select>
                    <br/>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-bloo">Enregistrer</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

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
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
@endsection
