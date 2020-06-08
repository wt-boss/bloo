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
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Resume du sondage</h1>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route('take_survey',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-primary col-3" value="Prévisualiser"/></a>
                                <a href="{{route('questionnaire.edit',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-warning col-3 offset-1" value="Editer"/></a>
                                <a href="{{route('questionnaire.stat',[$questionnaire->slug])}}" class="col-4"> <input type="button" class="btn btn-info float-right col-3" value="Statistique"/></a>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="titre">Titre</label>
                                        <input type="text" class="form-control" name="titre" id="titre" aria-describedby="titre" value="{{$questionnaire->title}}" disabled>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="objectif">Objectif</label>
                                        <input type="text" class="form-control" id="objectif" name="objectif" value="{{$questionnaire->purpose}}" disabled>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="date_start">Sondage ID</label>
                                        <input type="text" class="form-control" name="date_start" id="date_start" aria-describedby="titre" value="{{$questionnaire->token}}" disabled>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="date_start">Date de debut</label>
                                        <input type="text" class="form-control" name="date_start" id="date_start" aria-describedby="titre" value="{{$questionnaire->date_start}}" disabled>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="date_end">Date de fin</label>
                                        <input type="text" class="form-control" id="date_end" name="date_end" value="{{$questionnaire->date_end}}" disabled>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="exampleInputEmail1">Partarger le lien :</label>
                                        <div class="input-group mb-3">
                                            <p class="form-control" style="font-size: 16px"  id="token"> {{ asset('take_survey').'/'.$questionnaire->slug  }} </p>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button"  data-clipboard-action="copy" data-clipboard-target="#token">
                                                    <span class="iconify" data-icon="octicon-clippy" data-inline="false"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="form-text text-success text-capitalize col-9">Lien à partarger pour faire passer votre questionnaire</small>
                                    </div>
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
                                    <script src="{{asset('js/dist/clipboard.js')}}"></script>
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

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>  <br>
@endsection
