<?php
session_start();
include_once("db.php");
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="script2.js"></script> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <title>Map</title>

    <style type="text/css">
        #map {
            height: 100%;
        }


        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: "Open Sans", Helvetica, sans-serif !important;
        }

        #adresss {
            top: 10px;
            left: 11px;
            padding: 0px 5px 5px 5px;
            background-position: center;
            background-size: contain;
            z-index: 400;
            cursor: pointer;
            font-family: "Open Sans", Helvetica, sans-serif;
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            background-color: #7f135f;
        }

        .btn {
            top: 10px;
            left: 11px;
            padding: 5px;
            background-position: center;
            background-size: contain;
            z-index: 400;
            cursor: pointer;
            font-family: "Open Sans", Helvetica, sans-serif;
            border: none;
            background-color: #7f135f;
            color: white;
            border-radius: 4px;
        }

        .btnlg {
            top: 100px;
            left: 11px;
            padding: 5px;
            background-position: center;
            background-size: contain;
            z-index: 400;
            cursor: pointer;
            font-family: "Open Sans", Helvetica, sans-serif;
            border: none;
            background-color: #7f135f;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }

        .search {
            top: 45px;
            left: 11px;
            padding: 5px;
            background-position: center;
            background-size: contain;
            z-index: 400;
            cursor: pointer;
            font-family: "Open Sans", Helvetica, sans-serif;
        }

        .address {
            cursor: pointer;
            font-family: "Open Sans", Helvetica, sans-serif;
            display: flex;
            flex-direction: row;
        }

        .address:hover {
            text-decoration: underline
        }

        #btnsr {
            border: none;
            font-family: "Open Sans", Helvetica, sans-serif;
            color: white;
            background-color: #7f135f;
            border-radius: 4px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div id="adresss" style="align-content: center; width: auto; height: auto">
        <div class="search">
            <b style="color: white;">Address Lookup</b><br>
            <input type="text" name="addr" value="" id="addr" size="58" />
            <button id="btnsr" type="button" onclick="addr_search()">Search</button>
            <a class="btnlg">
                <?php echo $_SESSION['usuario']; ?>
            </a>
            <a class="btnlg" href="closesession.php">Close Session</a>
            <div id="results" style="color: white;"></div>
        </div>
    </div>
    <div id="map" style="align-content: center; width: 100%; height: 90%"></div>
    <div style="display: none">
        <br>
        <strong>Latitude: </strong>
        <p id="latitud"></p>
        <p id="latitud2"></p>
        <br>
        <strong>Length: </strong>
        <p id="longitud"></p>
        <p id="longitud2"></p>
    </div>
    <script src="js/lrm-graphhopper.js"></script>

    <script id="jvmapa">
        //Definición de variables utiles para el mapa
        const plat = document.querySelector("#latitud"),
            plong = document.querySelector("#longitud");
        var lati, long;
        var lati2, long2;
        var marcador = null;
        var marker = null;
        var routingControl = null;
        var firstWaypointMarker = null;
        var boton = document.getElementById('btnsr');
        var script = document.getElementById('jvmapa');
        var mapa = L.map('map');
        var waypoints = [];
        var waypoint1 = null;
        var dvdr = null;

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);
        var waypointsLayer = L.layerGroup().addTo(mapa);
        var routingControl = null;

        const init = () => {
            if (!"geolocation" in navigator) {
                return alert("Your browser does not support location access. try another");
            }

            const ZOOM = 15;

            const onActualizacionDeUbicacion = ubicacion => {
                const coordenadas = ubicacion.coords;
                let { latitude, longitude } = coordenadas;
                // Actualización de ubicación
                mapa.setView([latitude, longitude], 17);
                console.log(latitude);
                console.log(longitude);
                plat.innerText = latitude;
                plong.innerText = longitude;
                lati = document.getElementById('latitud').innerText;
                long = document.getElementById('longitud').innerText;
                if (routingControl) {
                    routingControl.spliceWaypoints(0, 1, L.latLng(latitude, longitude));
                }
                if (waypoint1 == null) {
                    waypoint1 = waypoints.push(L.Routing.waypoint(L.latLng(latitude, longitude)));
                }
                //waypoints.push(L.Routing.waypoint(L.latLng(latitude, longitude)));
            }

            const onErrorDeUbicacion = err => {
                console.log("Error getting location: ", err);
            }


            const opcionesDeSolicitud = {
                enableHighAccuracy: true, // Alta precisión
                maximumAge: 0, // No queremos caché
                timeout: 5000 // Esperar solo 5 segundos
            };

            idWatcher = navigator.geolocation.watchPosition(onActualizacionDeUbicacion, onErrorDeUbicacion, opcionesDeSolicitud);
        }
        init();
        lati = document.getElementById('latitud').innerText;
        long = document.getElementById('longitud').innerText;
        marcador = L.marker([13.6778293, -89.2874144], {
            draggable: true
        }).addTo(mapa);

        function chooseAddr(lat1, long1) {
            console.log("(x , y) respectivamente (" + lat1 + ", " + long1 + ")");
            lati2 = lat1;
            long2 = long1;
            if (routingControl) {
                mapa.removeControl(routingControl);
            }
            waypoints.push(L.latLng(lati2, long2));
            routingControl = L.Routing.control({
                waypoints: waypoints,
                router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
                routeWhileDragging: true
            }).addTo(mapa);
            dvdr = document.querySelectorAll('.address');
            dvdr.forEach(function (dvdr) {
                dvdr.style.display = 'none';
            });

            var directionsDiv = document.querySelector('.leaflet-routing-container');

            // Verifica si el elemento existe antes de ocultarlo
            if (directionsDiv) {
                // Aplica un estilo CSS para ocultar el elemento
                directionsDiv.style.display = 'none';
            }
        }

        function myFunction(arr) {
            var out = "<br />";
            var i;

            if (arr.length > 0) {
                for (i = 0; i < arr.length; i++) {
                    out += "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat + ", " + arr[i].lon + ");return false;'>" + arr[i].display_name + "</div>";
                }
                document.getElementById('results').innerHTML = out;
            } else {
                document.getElementById('results').innerHTML = "Sorry, no results...";
            }

        }

        function addr_search() {
            var inp = document.getElementById("addr");
            var xmlhttp = new XMLHttpRequest();
            var url = "https://nominatim.openstreetmap.org/search?format=json&countrycodes=sv&limit=3&q=" + inp.value;
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var myArr = JSON.parse(this.responseText);
                    myFunction(myArr);
                }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    </script>
</body>

</html>