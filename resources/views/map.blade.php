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

        <link rel="stylesheet" href="{{ asset('components/grid/grid.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
        <style lang="css">
            .map{
                height: 80vh; 
                padding: 2rem;
            }
            #map{
                height: 100%; 
            }
            body, html {
                margin: 0;
                padding: 0;
                height: 100vh;
            }
            .nav_top {
                box-shadow: -3px 19px 15px -4px rgba(0,0,0,0.55);
            }

            .nav_left {
                box-shadow: 6px 2px 9px -2px rgba(0,0,0,0.55);
            }

            .flex-grow-1{
                flex-grow: 1;
            }

            .flex-column {
                height: 100%;
                display: flex;
                flex-direction: column;
            }
            
            .no-show {
                display: none;
            }

            .infografik tr td{
                border: 1px;
                font-size: larger;
                font-weight: 10px;
            }
            .infografik-title{
                font-size: 4em;
            }
            .infografik-value{
                font-size: 4em;
            }
            .select-layer{
                display: flex;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container-fluid h-100 d-flex flex-column">
            <div class="row mb-0 nav_top ">
                <div class="col-4">
                    <img src="{{ asset('images/jt_logo.png') }}" height="100px" alt="joy-top logo" />
                </div>
                <div class="col-8 select-layer">
                    <div style="padding: 10px;">
                        <select id="select-layer" align-vertical onchange="changeLayer()">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row flex-grow-1 mt-0 align-self-stretch" style="margin-top: 0px!important;">
                <div class="col-4 nav_left ">
                    <div id="infografika-title">
                        <h1> 
                            Нажмите на карту 
                        </h1>
                        <h3>
                            для отображение подробной инфографики
                        </h3>
                    </div>
                    <div id="infografika-hex" class="no-show">
                        <h1>
                            Infographics
                        </h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col infografik-title">Rating</th>
                                    <th class="col infografik-title">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="rating_val" class="infografik-value">21321</td>
                                    <td id="count_val" class="infografik-value">qweqw</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="infografika-region" class="no-show">
                        <h1>
                            Region: 
                        </h1>
                        <h3 id="region-name"></h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col infografik-title">Rating</th>
                                    <th class="col infografik-title">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="rating_val_region" class="infografik-value">21321</td>
                                    <td id="count_val_region" class="infografik-value">qweqw</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-8">

                    <div class="map">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('axios.js') }}"></script>
        <script src="{{ asset('map.js') }}"></script>
    </body>
</html>