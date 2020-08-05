@section('title', 'My Forms')

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
                <h1>Creer un compte client</h1>
            </div>
            <div class="col-sm-7">
                <div class="my-content">
                    <h2 class="bloo-primary left-side-bloo border-left-primary">Prenez le contrôle !</h2>
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt
                        ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud
                        exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat
                    </p>
                    <form method="post" action="{{ route('compte.store') }}">
                        @csrf
                        <input class="form-control" type="text" name="nom" placeholder="nom de l'entreprise">
                        <input class="form-control" type="text" name="adresse" placeholder="Adresse">
                        <input class="form-control" type="text" name="contribuable" placeholder="N° Contribuable">
                        <input class="form-control" type="text" name="siret" placeholder="N° SIRET/RCCM">
                        <input class="form-control" type="text" name="ville" placeholder="Ville">
                        <input class="form-control" type="text" name="pays" placeholder="Pays">
                        <input class="form-control" type="hidden" name="type" value="Personne Morale">
                        <input class="form-control" type="text" name="telephone" placeholder="Telephoone">
                        <br>
                        <button type="submit" class="btn btn-bloo">Enregistrer</button>
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
@endsection
@section('laraform_script2')
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection
