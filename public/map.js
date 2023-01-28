
const url = "{{ config('app')['url_map'] }}";
const url_end = '/tile/{z}/{x}/{y}{r}.png?t={version}';
const app_url = "{{ config('app')['url'] }}";
const type_titles = {
    'osm': 'Просто карта', 
    'osm_liveness_hex': 'Карта с рейтингом благополучия по секторам', 
    'osm_liveness_region': 'Карта с рейтингом благополучия по регионам', 
    'dtp_hex': 'Карта с рейтингом ДТП по секторам', 
    'dtp_region': 'Карта с рейтингом ДТП по регионам',
    'maktab_hex': 'Карта с рейтингом школ по секторам',
    'maktab_region': 'Карта с рейтингом школ по регионам',
    'shop_hex': 'Карта с рейтингом плотности магазинов по секторам',
    'shop_region': 'Карта с рейтингом плотности магазинов по регионам',
};
const urls = {
    'osm': "http://127.0.0.1:6789/data"+url_end, 
    'dtp_hex': "http://127.0.0.1:6790/data"+url_end,
    'dtp_region': "http://127.0.0.1:6791/data"+url_end,
    'shop_hex': "http://127.0.0.1:6792/data"+url_end,
    'shop_region': "http://127.0.0.1:6793/data"+url_end,
    'maktab_hex': "http://127.0.0.1:6794/data"+url_end,
    'maktab_region': "http://127.0.0.1:6795/data"+url_end,
    'osm_liveness_hex': "http://127.0.0.1:6792/data"+url_end,
    'osm_liveness_region': "http://127.0.0.1:6793/data"+url_end,
}
const tile_options = {
    tileSize: 256,
    version: 1674890858477,
    minZoom: 1,
    maxZoom: 15,
    attribution: '<a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        + '<a href="'+app_url+'">JOY-TOP</a>'
};
let current_type = 'osm';
var current_layer = L.tileLayer(urls.osm, {...tile_options});

var map = L.map('map', {
    center: [41.31117, 69.279773],
    minZoom:1,
    maxZoom: 15,
    zoom: 7
});
map.addLayer(current_layer);
// map.on('click', markerOnClick).addTo(map);
map.on('click', function(e) {        
    var popLocation= e.latlng;
    var result = getPoint(popLocation.lat, popLocation.lng, map.getZoom(), current_type);
    var popup = L.popup()
        .setLatLng(popLocation)
        .setContent('<p>Hello world!<br />This is a nice popup.</p>')
        .openOn(map);
});
// var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);
function changeLayer()
{
    let type = document.getElementById('select-layer').value;
    if(urls[type] !== undefined && map.hasLayer(current_layer))
    {
        let new_layer = L.tileLayer(urls[type], {...tile_options});
        map.addLayer(new_layer);
        map.removeLayer(current_layer);
        current_layer = new_layer;
        current_type = type;
    }
}


let selector = document.getElementById('select-layer');
Object.keys(type_titles).forEach((key) => {
    let opt = document.createElement('option');
    opt.value = key;
    opt.innerHTML = type_titles[key];
    selector.appendChild(opt);
});
function getPoint(lat, long, zoom, layer) {
    axios.get('/api/point', {
        params: {
            lat,
            long,
            layer,
            zoom
        }
    })
    .then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    })
    .then(function () {
        // always executed
    });  
}
