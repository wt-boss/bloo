@extends('layouts.frontend.app')

@section('content')


    <!-- <div class="js-fullheight"> -->
        <div class="hero-wrap">
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
                <h2 class="mb-4">{{ trans('prix') }} </h2>
              </div>
            </div>
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-primary">
                                  <tr class="tab">
                                    <th></th>
                                    <th>Compte Free</th>
                                    <th>Compte Silver </th>
                                    <th>Compte platinum</th>

                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><a href="#">{{ trans('Prix') }}</a></td>
                                    <td>Gratuit</td>
                                    <td>Sur devise</td>
                                    <td>APD 50M</td>

                                  </tr>
                                  <tr>
                                    <td><a href="#">{{ trans('Validité') }}</a></td>
                                    <td>Sans engagement</td>
                                    <td>30J </td>
                                    <td>365J</td>
                                  </tr>
                                  <tr>
                                    <td><a href="#">{{ trans('Sondage en ligne gratuit') }}</a> </td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td><a href="#">{{ trans('Export des fichiers') }}</a> </td>
                                    <td> PDF </td>
                                    <td> PDF </td>
                                    <td>XLS, PDF, PPT </td>
                                  </tr>
                                  <tr>
                                    <td><a href="#">{{ trans('Droit de publication') }}</a></td>
                                    <td>Droit partagé </td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>

                                  <tr>
                                    <td><a href="#">{{ trans('Enquête/sondage terrain ') }}</a></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td><a href="#">{{ trans('Nombre d’opération max') }}</a> </td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>1</td>
                                    <td>Illimité</td>
                                  </tr>
                                  <tr>
                                    <td><a href="#">{{ trans('Nombre d’opérateurs max ') }}</a></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>20</td>
                                    <td>120</td>
                                  </tr>
                                  <tr>
                                    <td><a href="#">{{ trans('Nombre de sites max') }} </a> </td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>20</td>
                                    <td>60</td>
                                  </tr>
                                  <tr>
                                    <td><a href="#">{{ trans('Nombre utilisateur max') }}</a></td>
                                    <td>1</td>
                                    <td>4</td>
                                    <td>12</td>
                                  </tr>
                                  <tr>
                                    <td>  <a href="#">{{ trans('Account manager') }} </a>    </td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td> <a href="">{{ trans('Support technique direct') }} </a></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td> <a href="">{{ trans('Messagerie') }}</a></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>

                                  <tr>
                                    <td> <a href="">{{ trans('Paiement d’acompte en ligne') }}  </a></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td> <a href="">{{ trans('Montant') }}</a></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>12KF</td>
                                    <td>50KF</td>
                                  </tr>
                                  <tr>
                                    <td> <a href="">{{ trans('Remboursable') }} </a></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td>Oui</td>
                                    <td>Oui</td>
                                  </tr>
                                  <tr>
                                    <td> <a href="">{{ trans('Rapport d’étude ') }} </a></td>
                                    <td><span class="expanded"><i class="icon-remove icon-4x" style="color: #bf3030;;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                    <td><span class="expanded"><i class="icon-check icon-4x" style="color: #217dff;"></i></span></td>
                                  </tr>
                                  <tr>
                                    <td> <i class="icon-cloud" style="color: #217dff; "></i> <a href="">{{ trans('Accès Bloo Market Vue') }}</a></td>
                                    <td>Payant</td>
                                    <td>Payant</td>
                                    <td>Gratuit</td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                    </div>
                </div>
            </div>
        </section>




@endsection
