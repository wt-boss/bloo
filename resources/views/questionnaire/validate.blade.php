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
                    <h1>Votre formulaire</h1>
                </div>
            </center>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" aria-describedby="titre" value="{{$form->title}}" disabled>
                    </div>
                    <div class="form-group col-6">
                        <label for="objectif">Objectif</label>
                        <input type="text" class="form-control" id="objectif"  value="{{$form->description}}" disabled>
                    </div>
                    <div class="form-group col-12">
                        <label for="exampleInputEmail1">ID du sondage</label>
                        <div class="input-group mb-3">
                            <input class="form-control" style="font-size: 16px"  id="token" value="{{$form->code}}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"  data-clipboard-action="copy" data-clipboard-target="#token">
                                    <span class="iconify" data-icon="octicon-clippy" data-inline="false"></span>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-success text-capitalize col-9">Vous devez garder ce pour avoir acces a votre formulaire plus tard</small>
                    </div>
                    <div class="form-group col-6">
                        <form action="{{route('forms.show_free')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$form->code}}" name="code">
                            <input type="submit" class="btn btn-primary" value="Suivant">
                        </form>
                    </div>
                </div>


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
