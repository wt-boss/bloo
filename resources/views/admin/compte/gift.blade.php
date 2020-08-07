@extends('admin.top-nav')

@section('content-header')
    <!-- Content Header (Page header) -->
@endsection

@section('content')
    @include('partials.alert', ['name' => 'index'])
    <div class="panel panel-flat">
        <div class="row">
            <div class="d-none d-sm-block col-sm-5 left-side-bloo">
                <img class="bg-img" src="{{ asset('assets/images/background_create_enterprise.jpg') }}" alt="" />
                {{-- <img class="logo-img" src="{{ asset('assets/images/bloo_logo-white.png') }}" alt="Bloo" /> --}}
                <h1>Attribuer un compte</h1>
            </div>
            <div class="col-sm-7">
                <div class="my-content">
                    <h2 class="bloo-primary left-side-bloo border-left-primary">Attribuer un compte !</h2>

                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box" style="border:1px solid #d2d6de;">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
    <script type="text/javascript">
        function addlecteur() {
            $('.onelecteur').on('click', function (e) {
                console.log(e);
                $.get('/listlecteurs', function (data) {
                    console.log(data);
                });
                var lecteur_id = e.target.first_name;
                console.log(lecteur_id);
            });
        }

        $('#list').on('click', function (e) {
            console.log(e);
            $.get('/listlecteurs', function (data) {
                console.log(data);
                $('#listlecteur').empty();
                $.each(data, function (index, lecteurObj) {
                    $('#listlecteur').append(
                        '<input type="button" class="onelecteur" id="onelecteur" value="' +
                        lecteurObj.first_name + '">');
                    setTimeout(addlecteur, 400);
                })
            });
        });

    </script>

@endsection
