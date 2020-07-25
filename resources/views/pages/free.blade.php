
@extends('layouts.frontend.app')

@section('content')
<div class="hero-wrap">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{trans('free__home')}}</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Sondage gratuit</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section sondages">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="subheading">{{trans('free_header0')}}</span>
                {{-- <h2 class="mb-4 text-justify">{{trans('free_header')}}</h2> --}}
            </div>

            <div class="col-md-12 align-items-center ftco-animate">
                <div class="tab-content ftco-animate" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                        <div class="d-md-flex">
                            <div class="one-half ml-md-5 align-self-center">
                                <p>
                                    {{ trans('sondage_content') }}
                                </p>
                            </div>
                            <div class="one-half ml-md-5 align-self-center">
                                <p>
                                    {{ trans('sondage_content1') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light sondage">
    <div class="container">
        <div class="row d-md-flex">
            <div class="col-md-6 ftco-animate img about-image" style="border-radius: 5px; background-image: url({{asset('assets/images/avantages_bloo_okay.jpg')}});">
            </div>
            <div class="col-md-6 ftco-animate p-md-5">
                <div class="row">
              <div class="col-md-12 nav-link-wrap mb-5">
                <div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="v-pills-whatwedo-tab" data-toggle="pill" href="#v-pills-whatwedo" role="tab" aria-controls="v-pills-whatwedo" aria-selected="true">{{trans('free_content1')}}</a>

                  <a class="nav-link" id="v-pills-mission-tab" data-toggle="pill" href="#v-pills-mission" role="tab" aria-controls="v-pills-mission" aria-selected="false">{{trans('free_content2')}}</a>
                </div>
              </div>
              <div class="col-md-12 d-flex align-items-center">

                <div class="tab-content ftco-animate" id="v-pills-tabContent">

                  <div class="tab-pane fade show active" id="v-pills-whatwedo" role="tabpanel" aria-labelledby="v-pills-whatwedo-tab">
                        <div>
                            <form action="{{route('forms.store_free')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="title">{{trans('free_form1_label1')}}</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="purpose">{{trans('free_form1_label2')}}</label>
                                        <input type="text" class="form-control" id="description"  name="description" placeholder="Entrer l'objectif" required >
                                    </div>

                                    <div class="form-group col-12">
                                        <input type="submit" class="btn btn-primary float-right"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-mission" role="tabpanel" aria-labelledby="v-pills-mission-tab">
                      <form  id="form2" action="{{ route('forms.show_free') }}" method="post" >
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="text" class="form-control" id="title"  placeholder="Entrer le titre" required>
                            </div>

                            <div class="form-group col-12">
                                <input type="submit" class="btn btn-primary float-right"/>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>


<script type="application/javascript"  src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
   // Définir l'en-tête CSRF par défaut
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Interception du Formulaire de connexion
    $('#form2').submit(function(e){

        // Empêcher la soumission de formulaire normale, nous le faisons bien en JS à la place
        e.preventDefault();
        // Obtenir les données du formulaire
        var data = {
            title: $('[name=title]').val(),
        };
        // Envoyer la demande
        $.post($('this').attr('action'), data, function(response) {
            if (response.success) {--}}
                // Si la connexion réussit, redirection
                window.location.replace(response.redirect);-
            }
       });
    });

</script>

@endsection

