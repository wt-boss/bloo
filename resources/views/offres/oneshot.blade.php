
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
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Offre OneShoot</h1>
                </div>
            </div>
        </div>
        <section class="ftco-section">
            <div class="container">
                        <form role="form" action="" method="post">
                            <h4>Operation <span class="step"></span></h4>
                            <div class="row">
                                        <div class="form-group col-6">
                                        <label for="operation_name">Nom :</label><br>
                                        <input type="text" name="operation_name" class="form-control" id="operation_name">
                                    </div>
                                        <div class="form-group col-6">
                                        <label for="operation_start">Date de début:</label><br>
                                        <input type="date" name="operation_start" class="form-control" id="operation_start">
                                    </div>
                                        <div class="form-group col-6">
                                        <label for="operation_end">Date de fin:</label><br>
                                        <input type="date" name="operation_end" class="form-control" id="operation_end">
                                    </div>
                                        <div class="form-group col-6">
                                            <label for="name_enterprise">Nom entreprise :</label><br>
                                            <input type="text" name="name_enterprise" class="birth-city form-control" id="name_enterprise">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="address_enterprise">Adresse :</label><br>
                                            <input type="text" name="address_enterprise" class="birth-state form-control" id="address_enterprise">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="birth-country">Numero Contribuable:</label><br>
                                            <input type="text" name="contribuanle_enterprise" class="birth-country form-control" id="birth-country">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="birth-country">Numero SIRET/RCCM:</label><br>
                                            <input type="text" name="siret_enterprise" class="birth-country form-control" id="birth-country">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="birth-date">Ville:</label><br>
                                            <input type="text" name="ville_entreprise" class="birth-date form-control" id="birth-date">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="birth-date">Pays:</label><br>
                                            <input type="text" name="pays_entreprise" class="birth-date form-control" id="birth-date">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="birth-date">Telephone:</label><br>
                                            <input type="text" name="telephone_entreprise" class="birth-date form-control" id="birth-date">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="particulier_name">Nom:</label><br>
                                            <input type="text" name="particulier_name" class="address form-control" id="particulier_name">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="particulier_email">Addresse Email :</label><br>
                                            <input type="email" name="address-city" class="address-city form-control" id="particulier_email">
                                        </div>
                            </div>
                        </form>
            </div>
        </section>

@endsection
