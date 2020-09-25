@section('page_title', trans('footer_btn'))

@extends('admin.top-nav')

@section('laraform_style')
    <!-- Laraform Link Style -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('partials.alert', ['name' => 'index'])
    <div class="panel panel-flat">
        <div class="row">
            <div class="d-none d-sm-block col-sm-5 left-side-bloo">
                <img class="bg-img" src="{{ asset('assets/images/background_create_enterprise.jpg') }}" alt="">
                {{-- <img class="logo-img" src="{{ asset('assets/images/bloo_logo_white.png') }}" alt="Bloo"> --}}
                <h1>{{ trans('creer_compte') }}</h1>
            </div>
            <div class="col-sm-7">
                <div class="my-content">
                    <h2 class="bloo-primary left-side-bloo border-left-primary">{{trans('Prenez_le_contrôle !') }}</h2>
                    <p class="text-justify">

                    </p>
                    <form method="post" action="{{ route('compte.store') }}">
                        @csrf
                        <input class="form-control" type="text" name="nom" placeholder="{{ trans('Nom_entreprise') }}" required>
                        <input class="form-control" type="text" name="adresse" placeholder="{{ trans('Address') }}" required>
                        <input class="form-control" type="text" name="contribuable" placeholder="N° Contribuable">
                        <input class="form-control" type="text" name="siret" placeholder="N° SIRET/RCCM">
                        <select class="form-control" name="" id="country" required>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->native}}</option>
                            @endforeach
                        </select>
                        <div id="div_region" style="display:none">
                            <select class="form-control" name="city_id" id="region" required>

                            </select>
                        </div>
                        <div id="div_ville" style="display:none">
                            <select class="form-control" name="city_id" id="ville" required>

                            </select>
                        </div>
                        <input class="form-control" type="hidden" name="type" value="Personne Morale">
                        <input class="form-control" type="text" name="telephone" placeholder="{{ trans('Phone') }}"required>
                        <input class="form-control" type="email" name="email" placeholder="{{ trans('Email') }}" required>
                        <br>
                        <button type="submit" class="btn btn-bloo">{{ trans('save') }}</button>
                    </form>
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

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection

@section('laraform_script2')
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/datatable.js') }}"></script>
    <script type="text/javascript">
        function affCache(idDiv) {
            var div = document.getElementById(idDiv);
            if (div.style.display === "none"){
                div.style.display = "";
            }
        }
        $('#country').on('change', function(e){
            console.log(e);
            var country_id = e.target.value;
            affCache('div_region');
            $.get('/json-states?country_id=' + country_id,function(data) {
                console.log(data);
                $('#region').empty();
                $.each(data, function(index, stateObj){
                    $('#region').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                });
                $('#region').on('change', function(e){
                    console.log(e);
                    var state_id = e.target.value;
                    affCache('div_ville');
                    $.get('/json-cities?state_id=' + state_id,function(data) {
                        console.log(data);
                        $('#ville').empty();
                        $.each(data, function(index, villeObj){
                            $('#ville').append('<option value="'+ villeObj.id +'">'+ villeObj.name +'</option>');
                        })
                    });
                });
            });

        });
    </script>
@endsection
@section('laraform_script2')
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection
