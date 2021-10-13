@extends('admin.top-nav')



@section('page_title', 'Offer|Edit')



@section('content-header')
    <!-- Content Header (Page header) -->
@endsection

@section('content')

    @include('partials.alert', ['name' => 'index'])
    <div class="panel panel-flat">
        <div class="row">
            <div class="d-none d-sm-block col-sm-5 left-side-bloo">
                <img class="bg-img" src="{{ asset('assets/images/background_create_enterprise.jpg') }}" alt="">
                {{-- <img class="logo-img" src="{{ asset('assets/images/bloo_logo_white.png') }}" alt="Bloo"> --}}
                <h1>{{ trans('update_offer') }}</h1>
            </div>
            <div class="col-sm-7">
                <div class="my-content create-user">
                    {!! Form::model($offer, [
                            'action' => ['OfferController@update', $offer->id],
                            'method' => 'put',

                        ])
                    !!}
                    @csrf
                    <?php
                    $allowedRoles = config('variables.role');
                    if (Auth::user()->rolename() !== "Superadmin") {
                        foreach ($allowedRoles as $key => $value ) {
                            if ($key >= Auth::user()->role) {
                                unset($allowedRoles[$key]);
                            }
                        }
                    }

                    //$img_url = (isset($item) ? $item->avatar : "http://placehold.it/160x160");
                    //$img_url = (isset($user) ? $user->avatar : url('/') . config('variables.avatar.public') . 'avatar0.png');
                    ?>
                    <div class="form-group focused" >
                        <label for="intitule">Intitule</label>
                        <input class="form-control" name="intitulé" type="text" value="{{$offer->intitule}}" id="intitule" disabled>
                    </div>

                    <div class="form-group focused" >
                        <label for="payementCycle">Payement Cycle</label>
                        <input class="form-control" name="payementCycle" type="text" value="{{$offer->payementCycle}}" id="payementCycle" >
                    </div>

                    <div class="form-group focused">
                        <label for="timeTest">Time Test</label>
                        <input class="form-control" name="timeTest" type="text" value="{{$offer->timeTest}}" id="timeTest">
                    </div>

                    <div class="form-group focused" >
                        <label for="userTest">User Test</label>
                        <input class="form-control" name="userTest" type="text" value="{{$offer->userTest}}" id="userTest">
                    </div>
                    <div class="form-group focused" >
                        <label for="reduction">Reduction</label>
                        <input class="form-control" name="reduction" type="text" value="{{$offer->reduction}}" id="reduction">
                    </div>
                    {{--                    @include('admin.users.form2')--}}
                    <br>
                    <a class="btn btn-bloo-cancel" href="{{ route('offers.index') }}">{{ trans('Annuler') }}</a>
                    <button type="submit" class="btn btn-bloo">{{ trans('Mettre_jour') }}</button>
                    {!! Form::close() !!}
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
@endsection

@section('laraform_script2')
    {{-- <script src="{{ asset('assets/js/core/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection

@section('page-script')

    <script>
        $(function() {
            $('.datatable').DataTable({

                "language": {
                    @if( app()->getLocale() === "fr" )
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                    @endif
                            @if( app()->getLocale() === "en")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                    @endif
                            @if( app()->getLocale() === "es")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                    @endif
                            @if( app()->getLocale() === "pt")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
                    @endif
                },

                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [
                    {
                        className: 'control',
                        orderable: false,
                        targets:   0
                    },
                    {
                        orderable: false,
                        targets: [-1]
                    },
                    { responsivePriority: 1, targets: 0 },
                ],
            });

            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });

        });
    </script>
@endsection
