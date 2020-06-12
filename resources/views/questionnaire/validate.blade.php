@extends('layouts.frontend.app')

@section('content')

    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>

<div class="hero-wrap">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">Accuiel</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Validation du sondage gratuit</h1>
            </div>
        </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <center>
                <div>
                    <h1>Valider votre formulaire</h1>
                </div>
            </center>
            <form method="post" action="{{route('questionnaire.validate_free',[$questionnaire->slug])}}">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" aria-describedby="titre" value="{{$questionnaire->title}}" disabled>
                    </div>
                    <div class="form-group col-6">
                        <label for="objectif">Objectif</label>
                        <input type="text" class="form-control" id="objectif"  value="{{$questionnaire->purpose}}" disabled>
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleInputEmail1">ID du sondage</label>
                        <div class="input-group mb-3">
                            <input class="form-control" style="font-size: 16px"  id="token" value="{{$questionnaire->token}}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"  data-clipboard-action="copy" data-clipboard-target="#token">
                                    <span class="iconify" data-icon="octicon-clippy" data-inline="false"></span>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-success text-capitalize col-9">Vous devez garder ce token pour avoir acces a votre formulaire plus tard</small>
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleInputEmail1">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="password" required>
                        <small id="password"  class="form-text text-success">Entrer un mot de passe pour avoir acces a votre formulaire prochainement</small>
                    </div>



                </div>
                <button type="submit" class="btn btn-primary float-right">Valider</button>
            </form>
            <script src="{{asset('js/dist/clipboard.js')}}"></script>
            <script>
                 var toCopy  = document.getElementById( 'to-copy' ),
                     btnCopy = document.getElementById( 'copy' ),
                     paste   = document.getElementById( 'cleared' );

                 btnCopy.addEventListener( 'click', function(){
                     toCopy.select();
                     paste.value = '';

                     if ( document.execCommand( 'copy' ) ) {
                         btnCopy.classList.add( 'copied' );
                         paste.focus();

                         var temp = setInterval( function(){
                             btnCopy.classList.remove( 'copied' );
                             clearInterval(temp);
                         }, 600 );

                     } else {
                         console.info( 'document.execCommand went wrong…' )
                     }

                     return false;
                 } );
             </script>
            <script>
                var clipboard = new ClipboardJS('.btn');

                clipboard.on('success', function(e) {
                    console.log(e);
                });

                clipboard.on('error', function(e) {
                    console.log(e);
                });
            </script>
        </div>
    </div>

</section>
    <br>  <br>
@endsection
