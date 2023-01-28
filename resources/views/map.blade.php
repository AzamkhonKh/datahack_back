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
            .map{
                height: 80vh; 
                padding: 2rem;
            }
            #map{
                height: 100%; 
            }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <select class="btn btn-prime" id="select-layer" onchange="changeLayer()">
                        
                    </select>
                </div>
                <div class="col-3">
                </div>

                <div class="col-8">
                </div>
            </div>
        </div>
        <div class="map">
            <div id="map"></div>
        </div>
        <script src="{{ asset('axios.js') }}"></script>
        <script src="{{ asset('map.js') }}"></script>
        <!-- <script>

            function initLayer(type)
            {
                let uri = '';
                if(typeof urls[type] !== 'undefined') {
                    uri = urls[type];
                } else {
                    uri = url + url_end;
                    if(type !== '') {
                        uri += '&type='+type;
                    }
                }

                return L.tileLayer(uri, {
                    id: type,
                    tileSize: 256,
                    version: 1674890858477,
                    minZoom: 1,
                    maxZoom: 15,
                    attribution: '<a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        + '<a href="'+app_url+'">JOY-TOP</a>'
                });
            }
            var url = "{{ config('app')['url_map'] }}";
            var url_end = '/tile/{z}/{x}/{y}{r}.png?t={version}';
            var app_url = "{{ config('app')['url'] }}";
            let urls = {
                'osm': "http://127.0.0.1:6789/data"+url_end, 
                'dtp_hex': "http://127.0.0.1:6790/data"+url_end
            }
            var baseMaps = {
                "OpenStreetMap": initLayer('')
            };

            var overlayMaps = {};

            Object.keys(types).forEach((key) => {
                overlayMaps = {
                    ...overlayMaps,
                    key: initLayer(key)
                };
            });
            var map = L.map('map', {
                center: [41.31117, 69.279773],
                zoom: 14,
                layers: [initLayer('')]
            });
            var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);

        </script> -->
    </body>
</html>