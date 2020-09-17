@extends('layouts.frontend.app')
@section('page_title', trans('prix_fil'))
@section('content')


    <!-- <div class="js-fullheight"> -->
        <div class="hero-wrap other-p">
          <div class="overlay"></div>
          <div class="circle-bg"></div>
          <div class="circle-bg-2"></div>
          <div class="container-fluid">
            <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
              <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{  trans('home_fil')  }}</a></span> <span>{{ trans('prix_fil') }}</span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('prix_fil') }}</h1>
              </div>
            </div>
          </div>
        </div>

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center mb-5">
              <div class="col-md-7 text-center heading-section ftco-animate">
                {{-- <h2 class="mb-4">{{ trans('prix') }} </h2> --}}
              </div>
            </div>
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="table-responsive">
                            <table class="table prix_compte">
                                <thead class="thead-primary">
                                  <tr class="tab">
                                    <th></th>
                                    <th>Compte Free</th>
                                    <th>Compte Silver </th>
                                    <th>Compte Platinum</th>

                                  </tr>
                                </thead>
                                <style>
                                    .rg{
                                        color: #217dff
                                    }
                                </style>
                                <tbody>
                                  <tr>
                                    <td ><p class="rg">{{ trans('Prix') }}</p></td>
                                    <td>Gratuit</td>
                                    <td>Sur devis</td>
                                    <td>APD 80k&euro;</td>

                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Validité') }}</p></td>
                                    <td>Sans engagement</td>
                                    <td>30J </td>
                                    <td>365J</td>
                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Sondage en ligne gratuit') }}</p> </td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Export des fichiers') }}</p> </td>
                                    <td> PDF </td>
                                    <td> PDF </td>
                                    <td>PDF, PPT </td>
                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Droit de publication') }}</p></td>
                                    <td>Droit partagé </td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>

                                  <tr>
                                    <td><p class="rg">{{ trans('Enquête/sondage terrain ') }}</p></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Nombre d’opération max') }}</p> </td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>1</td>
                                    <td>Illimité</td>
                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Nombre d’opérateurs max ') }}</p></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>20</td>
                                    <td>120</td>
                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Nombre de sites max') }} </p> </td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>20</td>
                                    <td>60</td>
                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Nombre utilisateur max') }}</p></td>
                                    <td>1</td>
                                    <td>4</td>
                                    <td>12</td>
                                  </tr>
                                  <tr>
                                    <td>  <p class="rg">{{ trans('Account manager') }} </p>    </td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td> <p class="rg">{{ trans('Support technique direct') }} </p></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td> <p class="rg">{{ trans('Messagerie') }}</p></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>

                                  <tr>
                                    <td> <p class="rg">{{ trans('Paiement d’acompte en ligne') }}  </p></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td> <p class="rg">{{ trans('Montant') }}</p></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>20&euro;</td>
                                    <td>80&euro;</td>
                                  </tr>

                                  <tr>
                                    <td> <p class="rg">{{ trans('Rapport d’étude ') }} </p></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td><p class="rg">{{ trans('Accès Bloo Market Vue') }}</p></td>
                                    <td>Payant</td>
                                    <td>Payant</td>
                                    <td>Gratuit</td>
                                  </tr>
                                  <tr>
                                    <td><a href=""></td>
                                    <td><a href="{{route('questionnaire.free')}}"  class="btn btn-primary d-block">{{ trans('prix_btn') }}</a></td>
                                    <td><a href="{{route('primus')}}" class="btn  btn-primary  d-block">{{ trans('prix_btn') }}</a></td>
                                    <td><a href="{{route('illimité')}}" class="btn btn-primary d-block">{{ trans('prix_btn') }}</a></td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                    </div>
                </div>
            </div>
        </section>




@endsection
