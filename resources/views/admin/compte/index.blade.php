@extends('admin.top-nav')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-bottom: 10px;">
        <div class="panel-body" style="padding: 0;">
            <div class="row">
                <div class="pull-left">
                    <a href="{{route('giftoperation')}}" class="btn btn-bloo heading-btn legitRipple"><i class="fas fa-plus-circle"></i> Attribuer un compte</a>
                </div>
                <div class="pull-right">
                    <a href="{{route('entreprise')}}" class="btn btn-bloo heading-btn legitRipple"><i class="fas fa-plus-circle"></i> Creer un compte</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
<div class="row comptes">
    @foreach($comptes as $compte)
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
                            <h5 class="description-header" title="{{$compte->nom}}">{{$compte->nom}}</h5>
                            <span class="description-text">
                                Compte Primus (
                                @if($compte->type === "Personne Physique")
                                    Particulier
                                @else
                                    Entreprise
                                @endif
                                )
                            </span>
                            <span class="description-text">{{$compte->ville}}, {{$compte->pays}}</span>
                            <span class="description-text">{{$compte->operations->count()}} operations</span>
                            <span class="description-text">email@email.com</span>
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
