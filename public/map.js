
const url = "http://azamkhon.uz";
const app_url = "http://datahack.azamkhon.uz";
const url_end = '/tile/{z}/{x}/{y}{r}.png?t={version}';
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
    'osm': url+":6789/data"+url_end, 
    'dtp_hex': url+":6790/data"+url_end,
    'dtp_region': url+":6791/data"+url_end,
    'shop_hex': url+":6792/data"+url_end,
    'shop_region': url+":6793/data"+url_end,
    'maktab_hex': url+":6794/data"+url_end,
    'maktab_region': url+":6795/data"+url_end,
    'osm_liveness_hex': url+":6796/data"+url_end,
    'osm_liveness_region': url+":6797/data"+url_end,
}
const tile_options = {
    tileSize: 256,
    version: 1674890858477,
    minZoom: 1,
    maxZoom: 15,
    attribution: '<a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        + '<a href="'+app_url+'">JOY-TOP</a>'
};
    marker = L.marker();
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

    getPoint(popLocation.lat, popLocation.lng, map.getZoom(), current_type)
        .then(function (response) {
            if(response.data)
            {
                document.getElementById("infografika-title").classList.add("no-show");
                let type = current_type.split('_').pop();
                if(type === 'osm'){
                    document.getElementById("infografika-title").classList.remove("no-show");
                } else if (type === 'hex')
                {
                    showOneInfo(type);
                    document.getElementById("rating_val").innerText = response.data.rating;
                    if(typeof response.data.count === 'undefined')
                    {
                        document.getElementById("info-count").classList.add("no-show");
                        document.getElementById("count_val").classList.add("no-show");
                    }else{
                        document.getElementById("info-count").classList.remove("no-show");
                        document.getElementById("count_val").classList.remove("no-show");
                        document.getElementById("count_val").innerText = response.data.count;
                    }

                } else if (type === 'region') {
                    showOneInfo(type);
                    document.getElementById("region-name").innerText = response.data.region
                    document.getElementById("rating_val_region").innerText = response.data.rating
                    if(typeof response.data.count === 'undefined')
                    {
                        document.getElementById("region-count").classList.add("no-show");
                        document.getElementById("count_val_region").classList.add("no-show");
                    }else{
                        document.getElementById("region-count").classList.remove("no-show");
                        document.getElementById("count_val_region").classList.remove("no-show");
                        document.getElementById("count_val_region").innerText = response.data.count;
                        document.getElementById("count_val_region").innerText = response.data.count;
                    }
                }
            }
        });
    marker.setLatLng(popLocation).addTo(map);
});
// var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);
function showOneLegend(type)
{
    showOneInfo('qw');
    let new_type;
    let work = type.split('_');
    if(work[0] === 'osm' && work.length !== 1)
    {
        new_type = 'osm_liveness';
    }else{
        new_type = work[0];
    }

    [
        'maktab',
        'osm_liveness',
        'shop',
        'dtp'
    ].map((el) => {
        if(new_type === el)
        {
            document.getElementById(el+'_legend').classList.remove("no-show");
        }else{
            document.getElementById(el+'_legend').classList.add("no-show");
        }
    })
}

function showOneInfo(info)
{
    ['hex', 'region'].map((el) => {
        let id = 'infografika-'+el;
        if(info === el) {
            document.getElementById(id).classList.remove("no-show");
        } else {
            document.getElementById(id).classList.add("no-show");
        }
    });
}

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
        showOneLegend(current_type);
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
    return axios.get('/api/point', {
        params: {
            lat,
            long,
            layer,
            zoom
        }
    });
}
