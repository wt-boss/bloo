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
    <div class="panel panel-flat border-left-xlg border-left-primary">
        <div class="panel-heading">
            <h4 class="panel-title text-semibold">Create your client account</h4>
            <div class="heading-elements">
                @if ($entreprises->isEmpty())
                    @else
                <a href="{{ route('operation.create') }}" class="btn btn-success heading-btn">Skip</a>
                    @endif
            </div>
        </div>
    </div>

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat">
            <div class="panel-body">
                        <form method="post" action="{{ route('saventreprise') }}">
                           @csrf
                           <input class="form-control" type="text" name="nom" placeholder="nom de l'entreprise">
                           <input class="form-control" type="text" name="adresse" placeholder="Adresse">
                           <input class="form-control" type="text" name="contribuable" placeholder="N° Contribuable">
                           <input class="form-control" type="text" name="siret" placeholder="N° SIRET/RCCM">
                           <input class="form-control" type="text" name="ville" placeholder="Ville">
                           <input class="form-control" type="text" name="pays" placeholder="Pays">
                           <input class="form-control" type="text" name="telephone" placeholder="Telephoone">
                           <br>
                           <button type="submit" class="btn btn-info" style="width:100px;">Sauvegarder</button>
                           <a class="btn btn-warning " href="{{ route('users.index') }}" style="width:100px;"><i class="fa fa-btn fa-back"></i>Annuler</a>
                        </form>
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
