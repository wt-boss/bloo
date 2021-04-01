<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bloo | Ajouter des sites</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/map/jquery-ui.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/map/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="map"></div>
    <div class="pac-card" id="pac-card">
        <div id="pac-container">
            <a class="pac-return" href="{{route('operation.show',[$operation->id])}}"></a>
            <input id="pac-input" class="controls pac-search" type="text" placeholder="{{ trans('Enter a location') }}">
        </div>
        <div id="info-container">
            <form class="pac-form" method="post" action={{route('sites.store')}}>
                @csrf
                <input id="nom" name="nom" class="controls" type="text" placeholder="Nom du site" required>
                <input id="rayon" name="rayon"class="controls" type="number" placeholder="Rayon" required>
                <input id="pays" name="pays" class="controls" type="text" placeholder="Pays">
                <input id="ville" name="ville" class="controls" type="text" placeholder="Ville">
                <input id="lat" name="lat" class="controls" type="hidden">
                <input id="long" name="lng" class="controls" type="hidden">
                <input type="hidden" name="operation_id" value="{{$operation->id}}">
                <input class="controls-btn" type="submit" value="Enregistrer">
            </form>
        </div>
        <div class="pac-table">

            <!-- Table start -->
            <table class="tablemanager table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('Site') }}</th>
                    <th>{{ ('Rayon') }}</th>
                    <th>{{ trans('Pays') }}</th>
                    <th>{{ trans('Ville') }}</th>
                    <th class="disableFilterBy">{{ trans('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($sites as $site)
                <tr>
                    <td>{{$site->id}}</td>
                    <td>{{$site->nom}}</td>
                    <td>{{$site->rayon}}</td>
                    <td>{{$site->pays}}</td>
                    <td>{{$site->ville}}</td>
                    <td><a href="{{route('sites.destroy',[$site->id])}}" class="del-site">Supprimer</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pac-pick pac-pick-active"></div>
        </div>
    </div>
    <div id="infowindow-content" class="infowindow-content">
        <img src="" width="16" height="16" id="place-icon" class="place-icon">
        <span id="place-name" class="place-name title"></span><br>
        <span id="place-address" class="place-address"></span>
    </div>

    <!-- Replace the value of the key parameter with your own API key. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDI_jjizwbzvx2Ik2javjmbftWVfvFK46g&libraries=places&callback=initMap" defer></script>
    <!-- <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/map/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/map/tableManager.js')}}"></script>
    <script src="{{asset('assets/map/app.js')}}"></script>
</body>
</html>
