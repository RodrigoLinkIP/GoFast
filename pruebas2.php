<?php
//session_start();
//include_once("db.php");
// if (isset($_SESSION['usuario'])) {
//     header('Location: index.php');
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- <script src="script2.js"></script> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <title>Mapa</title>
    <style type="text/css">
        #map {
            height: 50%;
            width: 100vw;
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
        .container {
            display: flex;
            width: 100%;
            flex-wrap: wrap;
            justify-content: center;
        }

        .ln {
            flex: 1 1 1 25%;
            min-width: auto;
            box-sizing: border-box;
            margin-right: 10%;
        }
    </style>
</head>

<body>
    <div id="map" style="align-content: center;"></div>
    <script src="js/lrm-graphhopper.js"></script>
    <script src="coords_Paradas.js"></script>
    <script id="jvmapa">
        //Definición de variables utiles para el mapa
        const plat = document.querySelector("#latitud"),
            plong = document.querySelector("#longitud");
        var lati, long;
        var lati2, long2;
        var marcador = null;
        var marker = 1;
        var routingControl = null;
        var firstWaypointMarker = null;
        var boton = document.getElementById('btnsr');
        var script = document.getElementById('jvmapa');
        var mapa = L.map('map');
        var waypoints = [];
        var waypoint1 = null;
        var dvdr = null;
        var routeLayer;

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);
        var waypointsLayer = L.layerGroup().addTo(mapa);
        var routingControl = null;
        var marker = L.marker([80, 80]).addTo(mapa);
        mapa.setView([13.68031, -89.28997], 15);
        var initialLatLng = L.latLng(13.67351, -89.28469);

        const init = () => {
            if (!"geolocation" in navigator) {
                return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
            }

            const ZOOM = 15;

            const onActualizacionDeUbicacion = ubicacion => {
                const coordenadas = ubicacion.coords;
                let { latitude, longitude } = coordenadas;
                // Actualización de ubicación
                console.log(latitude);
                console.log(longitude);
                plat.innerText = latitude;
                plong.innerText = longitude;
                lati = document.getElementById('latitud').innerText;
                long = document.getElementById('longitud').innerText;
                // if (marker != null) {
                //     mapa.removeControl(marker);
                //     marker = L.marker([latitude, longitude]).bindPopup(latitude + ", " + longitude).addTo(mapa);
                // }
                //waypoints.push(L.Routing.waypoint(L.latLng(latitude, longitude)));
            }

            const onErrorDeUbicacion = err => {
                console.log("Error obteniendo ubicación: ", err);
            }

            const opcionesDeSolicitud = {
                enableHighAccuracy: true, // Alta precisión
                maximumAge: 0, // No queremos caché
                timeout: 5000 // Esperar solo 5 segundos
            };

            idWatcher = navigator.geolocation.watchPosition(onActualizacionDeUbicacion, onErrorDeUbicacion, opcionesDeSolicitud);
        }
        init();
        var marcador = L.marker(initialLatLng, { draggable: true }).addTo(mapa);

        marcador.bindPopup("Coordenadas: " + initialLatLng.toString());

        marcador.on('dragend', function (event) {
            var marcadorLatLng = event.target.getLatLng();
            marcador.setPopupContent("Coordenadas: " + marcadorLatLng.toString()).openPopup();;
        });

        function makeRoute(cd1, cd2) {
            console.log(cd1 + " y " + cd2);
            if (routingControl) {
                mapa.removeControl(routingControl);
            }
            routingControl = L.Routing.control({
                waypoints: [
                    cd1,
                    cd2
                ],
                router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
                routeWhileDragging: false,
                draggableWaypoints: false,
                addWaypoints: false,
                createMarker: function () {return null;},
                lineOptions: {
                    styles: [{ color: '#033666', weight: 5 }]
                }
            }).addTo(mapa);
            var directionsDiv = document.querySelector('.leaflet-routing-container');

            // Verifica si el elemento existe antes de ocultarlo
            if (directionsDiv) {
                // Aplica un estilo CSS para ocultar el elemento
                directionsDiv.style.display = 'none';
            }
        }
    </script>
    <script src="markers_Paradas.js"></script>
    <div class="container">
        <div class="ln">
            <h3>Ruta 35</h3>
            <p>Avenida Cuscatlan, 528</p>
            <p>Calle Modelo</p>
            <p>Calle A, 212</p>
            <p>Avenida Irazu, 166</p>
            <p>Avenida Irazu</p>
            <p>Pasaje San Rafel</p>
            <p>Boulevard San Patricio</p>
            <p>Iglesia Católica San Patricio</p>
        </div>
        <div class="ln">
            <h3>Ruta 97</h3>
            <p>Calle Real</p>
            <p>5 Calle Poniente, 3</p>
            <p>Paseo Concepción</p>
            <p>Paseo El Carmen</p>
            <p>7° Avenida Norte</p>
            <p>7 Calle Oriene Bis, 18</p>
            <p>9° Calle Oriente</p>
            <p>Calle Chiltiupan</p>
            <p>Boulevard Merliot</p>
            <p>Carretera Santa Tecla</p>
            <p>Boulevard Sur</p>
            <p>14 Avenida Sur, 12y</p>
            <p>Carretera Panamericana, 5</p>
        </div>
        <div class="ln">
            <h3>Linea Jose</h3>
            <p>Parada B</p>
            <p>Parada D</p>
            <p>Parada E</p>
            <p>Parada F</p>
            <p>Parada I</p>
            <p>Parada J</p>
        </div>
        <div class="ln">
            <h3>Linea Antonio</h3>
            <p>Parada C</p>
            <p>Parada E</p>
            <p>Parada F</p>
            <p>Parada G</p>
            <p>Parada K</p>
            <p>Parada L</p>
        </div>
        <div class="ln">
            <h3>Linea Bernardo</h3>
            <p>Parada A</p>
            <p>Parada B</p>
            <p>Parada C</p>
            <p>Parada M</p>
            <p>Parada N</p>
            <p>Parada F</p>
        </div>
    </div>
</body>

</html>