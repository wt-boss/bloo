



@extends('layouts.frontend.app')

@section('content')


<div class="hero-wrap">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">Accuiel</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Sondage gratuit</h1>
            </div>
        </div>
</div>

<section class="ftco-section">
    <div class="container">


        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Obtenez les réponses dont vous avez besoin</span>
                    <br>
                  </div>


                  <div class="col-md-12 align-items-center ftco-animate">

                    <div class="tab-content ftco-animate" id="v-pills-tabContent">

                      <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                          <div class="d-md-flex">
                            <div class="one-half ml-md-5 align-self-center">
                                <p>
                                Rejoignez les centaines d’entreprises et de particuliers qui font confiance à Bloonline pour bénéficier de données instantanées à visage humain.
                              </p>
                              </div>
                              <div class="one-half ml-md-5 align-self-center">
                                <p>
                                    Rejoignez les centaines d’entreprises et de particuliers qui font confiance à Bloonline pour bénéficier de données instantanées à visage humain.
                                  </p>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

          </div>

        <div class="row">
            <div class="col-md-12 align-items-center ftco-animate">

                <div class="tab-content ftco-animate" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                        <div class="d-md-flex">
                            <div class="one-forth align-self-center">
                                <center><h2>Créer votre sondage</h2></center>
                                <form action="{{route('questionnaire.store_free')}}" method="post" onsubmit="return verifDate(this)">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="title">Titre</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="purpose">Objectif</label>
                                            <input type="text" class="form-control" id="purpose"  name="purpose"  placeholder="Enter l'objectif">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="date_start">Date de debut</label>
                                            <input type="date" class="form-control" id="date_start" name="date_start"  >
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="date_end">Date de fin</label>
                                            <input type="date" class="form-control" id="date_end" name="date_end" >
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary float-right col-4"/>
                                </form>
                                <script>
                                    function verifDate()
                                    {
                                        var date = new Date().toISOString().slice(0, 10);
                                        var start = new  Date(document.getElementById('date_start').value).toISOString().slice(0, 10);
                                        var end = new  Date(document.getElementById('date_end').value).toISOString().slice(0, 10);
                                        console.log(start);
                                        console.log(date);
                                        console.log(end > start);
                                        if(start >= date && end > start)
                                        {
                                            return true;
                                        }
                                        else{
                                            alert('Veuillez choisir une date de debut superieur a la date actuelle et une date de fin superieur a celle de debut');
                                            return false;
                                        }
                                    }
                                </script>

                            </div>
                            <div class="one-half ml-md-5 align-self-center">
                                @if (Session::has('errors'))
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        <ul class="list-unstyled">
                                            @foreach (Session::get('errors')->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::has('warning'))
                                    <div class="alert alert-warning" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        {{Session::get('warning')}}
                                    </div>
                                @endif
                                @if (Session::has('info'))
                                    <div class="alert alert-info" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        {{Session::get('info')}}
                                    </div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                      <center><h2>Administrer votre sondage</h2></center>
                                <form method="POST"    action="{{ route('questionnaire.identify_free') }}">
                                    @csrf
                                    <div class="form-group ">
                                        <label for="token" class="col-md-4 col-form-label">ID du sondage</label>
                                        <div class="col-md-12">
                                            <input id="token" type="text" class="form-control" name="token" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-md-4 col-form-label">Mot de passe</label>
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control " name="password" >
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary float-right col-4"/>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
