
@extends('admin.top-nav')
@section('page_title', trans('operations'))
@section('content-header')

@endsection

@section('content')
    <div class="panel panel-flat panel-wb">
        <div class="panel-body" style="padding: 0;">
            <div class="row">
                <div class="col-md-7">
                    <div class="box box-success">
                        <div class="row ">
                            <div class="col-lg-12">
                                <h2 class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Détails de la commande </h2>
                                <div class="p-4">
                                    <h5 class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</h5>
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous-total {{$facture->Total}}</strong><strong></strong></li>
                                        <br>
                                         <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>${{$facture->Total}}</strong></li>
                                        <br>
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                                            <h5 class="font-weight-bold">{{$facture->Total}}</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->




                </div>
                <div class="col-lg-5 col-xs-12">
                    <div class="box box-solid panel-wb">
                        <!-- /.box-header -->
                        <div class="box-body" style="padding: 0 ;">
                            <div class="row">
                                <div class="col-lg-12 col-xs-6">
                                    <div class="small-box bg-black">
                                        <a href="#" class="btn form-control" style="color:white">{{ trans('Invoice information') }}</a>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-xs-6">
                                    <!-- Set up a container element for the button -->
                                    <div id="paypal-button-container"></div>
                                </div>

                                <div class="col-md-6 col-lg-12 col-xs-6 mt-8 mb-8">
                                     <br> <br>
                                    <form action="#" class="my-4">
                                        <div id="card-element">
                                            <!-- Elements will create input elements here -->
                                        </div>

                                        <!-- We'll put the error messages in this element -->
                                        <div id="card-errors" role="alert"></div>

                                        <button class="btn btn-success mt-3" id="submit">Procéder au paiement</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </div>
    </div>

@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>

    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bZln12ut506FLipFx-kXh95M-zZdUfc&libraries=places&callback=initMap" defer></script>

@endsection

@section('page-script')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="{{ asset('assets/js/custom/pages/response-summary.js') }}"></script>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=Ada3ogr7__ry3oQu0ncGZ-PjtUvHnXEoumG8m9c5Txr1tcGT9nsJkOo3gvsCx3MtmXrBcKZpclyWbbop&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            style: {
                layout: 'horizontal'
            },
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: "{{$facture->Total}}"
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    fetch("/json-payfacture?facture_id={{$facture->id}}")
                        .catch(error => alert("Erreur : " + error));
                    window.location.href = "{{route('factures.index')}}";
                    //alert('Transaction completed by ' + details.payer.name.given_name);
                });
            }
        }).render('#paypal-button-container');
    </script>


    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var stripe = Stripe('pk_test_51Gs1ssFp9ycafSIN7IDSbb86yO5wpgcnJrhRPyvrjDE3ngqVQQaBuFNG5ddPtag86Evnl1tW7Xc8Pf2XjdMYvBDT00yntJ03sO');
        var elements = stripe.elements();
        var style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };
        var card = elements.create("card", { style: style });
        card.mount("#card-element");
        card.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.classList.add('alert', 'alert-warning', 'mt-3');
                displayError.textContent = error.message;
            } else {
                displayError.classList.remove('alert', 'alert-warning', 'mt-3');
                displayError.textContent = '';
            }
        });
        var submitButton = document.getElementById('submit');

        submitButton.addEventListener('click', function(ev) {
            ev.preventDefault();
            stripe.confirmCardPayment("{{ $clientSecret }}", {
                payment_method: {
                    card: card
                }
            }).then(function(result) {
                if (result.error) {
                    // Show error to your customer (e.g., insufficient funds)
                    console.log(result.error.message);
                    console.log('A very hard hero');
                } else {
                    // The payment has been processed!
                    if (result.paymentIntent.status === 'succeeded') {
                        // Show a success message to your customer
                        // There's a risk of the customer closing the window before callback
                        // execution. Set up a webhook or plugin to listen for the
                        // payment_intent.succeeded event that handles any business critical
                        // post-payment actions.
                        fetch("/json-payfacture?facture_id={{$facture->id}}")
                            .catch(error => alert("Erreur : " + error));
                        console.log(result.paymentIntent);
                        window.location.href = "{{route('factures.index')}}";
                    }
                }
            });
        });
    </script>

@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection
