@extends('admin.top-nav')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="panel-body" style="padding: 0;">
            <div class="panel-heading pull-right">
                <a href="http://localhost:500/entreprise" class="btn btn-bloo heading-btn legitRipple"><i class="fas fa-plus-circle"></i> Creer un compte</a>
            </div>
        </div>
    </section>
@endsection

@section('content')
        <div class="col-12">
            @foreach($comptes as $compte)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-aqua-active">
                            <center>
                                <h3 class="widget-user-username"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$compte->nom}}</font></font></h3>
                            </center>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="{{asset('assets/images/about.jpg')}}" alt="Avatar de l'utilisateur">
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$compte->operations->count()}}</font></font></h5>
                                        <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Operations</font></font></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                    {{$compte->users->where('role','1')->count()}}
                                                </font></font></h5>
                                        <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Operateurs</font></font></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                    @if($compte->type === "Personne Physique")
                                                        PARTICULIER
                                                    @else
                                                        ENTREPRISE
                                                    @endif
                                                </font></font></h5>
                                        <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Operations</font></font></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$compte->pays}}</font></font></h5>
                                        <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$compte->ville}}</font></font></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-12">
                                    <div class="description-block">

                                        <a class="m-link legitRipple" href="#">
                                            <i class="fas fa-cog"></i>
                                            <span>Parametres</span>
                                        </a>
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
            @endforeach
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
@endsection
