<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            
        </title>
        <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" crossorigin=""/>
        <script src="{{ asset('leaflet/leaflet.js') }}" crossorigin=""></script>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <style lang="css">
            #map { height: 180px; }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h1>
            HELLO
        </h1>
        <div id="map"></div>
        <<script>
            var map = L.map('map').setView([51.505, -0.09], 13);
            var version = 1
            L.tileLayer('{{ config('app')['url'] }}/tile/{z}/{x}/{y}{r}.png?t={version}', {
                version,
                minZoom: 1,
                maxZoom: 15,
                tileSize: 19,
                attribution: '<a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    + '<a href="{{ config('app')['url'] }}">JOY-TOP</a>'
            }).addTo(map);
        </script>>
    </body>
</html>