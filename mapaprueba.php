<?php
session_start();
include_once("db.php");
$upload_dir = 'photos/';
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <!-- <script src="script2.js"></script> -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="rutas_copy.js"></script>
  <title>Map</title>
  <style type="text/css">
    #map {
      height: 100%;
      width: 100vw;
    }

    h4 {
      color: #033666;
    }

    h5 {
      color: #033666;
      margin-bottom: 0;
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

    .navbar {
      background-color: #033666 !important;
    }

    .img {
      border-radius: 5px;
    }

    .nav-link {
      padding: 0.25rem !important;
    }

    .navbar-nav li {
      display: flex !important;
      padding-left: 3px !important;
      padding-right: 3px !important;
    }

    .btnrt {
      color: black;
      background-color: white;
      border: 2px solid #033666;
      border-radius: 3px;
      font-family: "Open Sans", Helvetica, sans-serif;
      transition-duration: 0.4s;
    }

    .btnrt:hover {
      background-color: #033666;
      color: white;
    }

    .all-routes {
      position: absolute;
      top: 150px;
      left: 10px;
      width: 11px;
      height: 15px;
      padding: 15px;
      background-position: center;
      background: url(photos/descarga.png);
      background-size: contain;
      background-color: white;
      z-index: 400;
      cursor: pointer;
      border: 2px solid #033666;
      border-radius: 2px;
    }

    .advanced-search {
      position: absolute;
      top: 185px;
      left: 10px;
      width: 11px;
      height: 15px;
      padding: 15px;
      background-position: center;
      background: url(photos/descarga.png);
      background-size: contain;
      background-color: white;
      z-index: 400;
      cursor: pointer;
      border: 2px solid #033666;
      border-radius: 2px;
    }

    .leaflet-bar {
      border: 2px solid #033666 !important;
      border-radius: 2px !important;
    }

    .div-search {
      position: absolute;
      top: 220px;
      left: 10px;
      z-index: 400;
      display: none;
      transition-property: all 1s ease;
    }

    .div-search.show {
      position: absolute;
      top: 220px;
      left: 10px;
      z-index: 400;
      display: block;
    }

    .div-scroll {
      overflow-y: scroll;
      height: 300px;
    }

    .div-scroll::-webkit-scrollbar {
      -webkit-appearance: none;
    }

    .div-scroll::-webkit-scrollbar:vertical {
      width: 10px;
    }

    .div-scroll::-webkit-scrollbar-button:increment,
    .div-scroll::-webkit-scrollbar-button {
      display: none;
    }

    .div-scroll::-webkit-scrollbar:horizontal {
      height: 10px;
    }

    .div-scroll::-webkit-scrollbar-thumb {
      background-color: #033666;
      border-radius: 20px;
      border: 2px solid #f1f2f3;
    }

    .div-scroll::-webkit-scrollbar-track {
      border-radius: 10px;
    }

    ul {
      list-style: none;
    }
  </style>
</head>

<body id="body">
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="display: flex;">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <!-- Avatar -->
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="userinfo.php" id="navbarDropdownMenuLink2" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <?php
            $unamet = $_SESSION['usuario'];
            $sql = "select * from usuario where username = '" . $unamet . "'";
            $result = pg_query($conn, $sql);
            if (pg_num_rows($result)) {
              while ($row = pg_fetch_assoc($result)) {
            ?>
                <img style="background-color: white;" src="<?php echo $upload_dir . $row['images']; ?>" class="rounded-circle" height="50" width="50" alt="<?php echo $row['username']; ?>'s Profile" title="<?php echo $row['username']; ?>'s Profile" loading="lazy" />
            <?php
              }
            }
            ?>
          </a>
          <a class="nav-link d-flex align-items-center" href="redirgal.php" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" src="https://icon-library.com/images/white-home-icon-png/white-home-icon-png-21.jpg" height="50" alt="Home" loading="lazy" />
          </a>
          <a class="nav-link d-flex align-items-center" onclick="ByeByeAl()" id="navbarDropdownMenuLink2" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" src="https://icon-library.com/images/logout-icon-png/logout-icon-png-13.jpg" height="50" alt="Log Out" loading="lazy" />
          </a>
          <a class="nav-link d-flex align-items-center" onclick="doGTranslate('es'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="Spanish" src="https://img.freepik.com/vector-premium/colores-proporciones-originales-bandera-espana-ilustracion-vectorial-eps-10_148553-524.jpg" height="50" width="50" alt="Home" loading="lazy" />
          </a>
          <a class="nav-link d-flex align-items-center" onclick="doGTranslate('en'); return false;" href="#" id="navbarDropdownMenuHome" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img class="img" title="English" src="https://img.freepik.com/free-vector/illustration-uk-flag_53876-18166.jpg" height="50" width="50" alt="Home" loading="lazy" />
          </a>
        </li>
      </ul>
      <script>
        function ByeByeAl() {
          Swal.fire({
            title: 'Leaving so soon?',
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, goodbye!',
            cancelButtonText: 'Not yet!'
          }).then((result) => {
            if (result.isConfirmed) {
              (setTimeout(function() {
                window.location = 'closesession.php';
              }, 0))
            }
          });
        }
      </script>
      </li>
      <li class="nav-item">
        <section>
          <style type="text/css">
            #goog-gt-tt {
              display: none !important;
            }

            .goog-te-banner-frame {
              display: none !important;
            }

            .goog-te-menu-value:hover {
              text-decoration: none !important;
            }

            body {
              top: 0 !important;
            }

            #google_translate_element2 {
              display: none !important;
            }

            body>.skiptranslate {
              display: none;
            }
          </style>
          <div id="google_translate_element2"></div>
          <script type="text/javascript">
            function googleTranslateElementInit2() {
              new google.translate.TranslateElement({
                pageLanguage: 'en',
                autoDisplay: false
              }, 'google_translate_element2');
            }

            function doGTranslate(lang) {
              var teCombo = document.querySelector('.goog-te-combo');
              if (teCombo) {
                teCombo.value = lang;
                if (document.createEvent) {
                  var event = document.createEvent('HTMLEvents');
                  event.initEvent('change', true, true);
                  teCombo.dispatchEvent(event);
                } else {
                  teCombo.fireEvent('onchange');
                }
              }
            }

            function rutass() {
              window.location.href = 'rutasbuses.php';
            }
          </script>
          <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>

        </section>
      </li>
      </ul>
    </div>
  </nav>
  <div id="map" style="align-content: center; width: 100%; height: 90%;"></div>
  <button class="all-routes" onclick="rutass()"></button>
  <button class="advanced-search" onclick="toggleSearch()"></button>
  <div class="div-search" id="div-search">
    <h5>From:</h5>
    <input placeholder="Calle Real" type="text" id="buscador">
    <h5>To:</h5>
    <input placeholder="Parque de Pelota" type="text" id="buscador2">
    <button onclick="generarRuta()">Search</button>
    <div class="div-scroll">
      <ul id="resultado-lista"></ul>
    </div>
  </div>
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
  <script id="script-rutas">
    function toggleSearch() {
      var searchContainer = document.getElementById("div-search");
      searchContainer.classList.toggle("show");
    }

    function actualizarResultados(terminoBusqueda, resultadoLista) {
      const resultados = buscarEnArray(terminoBusqueda);
      mostrarResultados(resultados, resultadoLista);
    }

    function actualizarResultados2(terminoBusqueda, resultadoLista) {
      const resultados = buscarEnArray(terminoBusqueda);
      mostrarResultados2(resultados, resultadoLista);
    }

    function buscarEnArray(terminoBusqueda) {
      const resultados = new Set();

      rutas.forEach((ruta) => {
        ruta.paradas.forEach((parada) => {
          if (parada.nombre.toLowerCase().includes(terminoBusqueda)) {
            resultados.add(parada.nombre);
          }
        });
      });

      return Array.from(resultados);
    }

    function mostrarResultados(resultados, resultadoLista) {
      resultadoLista.innerHTML = '';

      if (resultados.length > 0) {
        resultados.forEach((paradaNombre) => {
          const listItem = document.createElement('li');
          listItem.textContent = paradaNombre;
          resultadoLista.appendChild(listItem);
          listItem.addEventListener('click', () => {
            buscadorInput.value = paradaNombre;
            resultadoLista.innerHTML = '';
          });
        });
      }
    }

    function mostrarResultados2(resultados, resultadoLista) {
      resultadoLista.innerHTML = '';

      if (resultados.length > 0) {
        resultados.forEach((paradaNombre) => {
          const listItem = document.createElement('li');
          listItem.textContent = paradaNombre;
          resultadoLista.appendChild(listItem);
          listItem.addEventListener('click', () => {
            buscadorInput2.value = paradaNombre;
            resultadoLista.innerHTML = '';
          });
        });
      }
    }

    var waypoints = [];
    var routingContro = null;

    const buscadorInput = document.getElementById('buscador');
    const resultadoLista = document.getElementById('resultado-lista');

    buscadorInput.addEventListener('input', () => {
      const terminoBusqueda1 = buscadorInput.value.toLowerCase();
      actualizarResultados(terminoBusqueda1, resultadoLista);
    });

    buscadorInput.addEventListener('blur', () => {
      setTimeout(() => {
        resultadoLista.innerHTML = '';
      }, 200);
    });

    const buscadorInput2 = document.getElementById('buscador2');

    buscadorInput2.addEventListener('input', () => {
      const terminoBusqueda2 = buscadorInput2.value.toLowerCase();
      actualizarResultados2(terminoBusqueda2, resultadoLista);
    });

    buscadorInput2.addEventListener('blur', () => {
      setTimeout(() => {
        resultadoLista.innerHTML = '';
      }, 200);
    });

    function encontrarRutasConParada(parada) {
      return rutas.filter(ruta => ruta.paradas.some(paradaObj => paradaObj.nombre === parada));
    }

    function encontrarParadaComunMasCercana(rutasEncontradas, pi) {
      let paradaComunMasCercana = null;
      let distanciaMasCercana = Infinity;

      for (const ruta of rutasEncontradas) {
        const paradaObj = ruta.paradas.find(parada => parada.nombre === pi);
        if (paradaObj) {
          const paradaIndex = ruta.paradas.indexOf(paradaObj);
          if (paradaIndex !== -1) {
            for (let i = paradaIndex + 1; i < ruta.paradas.length; i++) {
              const distancia = i - paradaIndex;
              const paradaComun = ruta.paradas[i];
              const isParadaComunInAllRoutes = rutasEncontradas.every(rutaEncontrada => rutaEncontrada.paradas.some(parada => parada.nombre === paradaComun.nombre));
              if (isParadaComunInAllRoutes) {
                if (distancia < distanciaMasCercana) {
                  distanciaMasCercana = distancia;
                  paradaComunMasCercana = paradaComun;
                }
                break;
              }
            }
          }
        }
      }

      return paradaComunMasCercana;
    }

    function buscarRuta(pi, pf) {
      const rutasConPI = encontrarRutasConParada(pi);
      const rutasConPF = encontrarRutasConParada(pf);

      for (const rutaPI of rutasConPI) {
        for (const rutaPF of rutasConPF) {
          if (rutaPI === rutaPF) {
            return {
              ruta: rutaPI.nombres,
              paradasComunes: [pi, pf]
            };
          }

          const paradaComun = encontrarParadaComunMasCercana([rutaPI, rutaPF], pi);
          if (paradaComun) {
            return {
              ruta: rutaPI.nombres,
              paradasComunes: [pi, paradaComun.nombre],
              paradaComunn: [paradaComun.nombre, pf],
              rutaFinal: rutaPF.nombres
            };
          }
        }
      }

      return null;
    }

    function generarRuta() {
      const paradaInicial = document.getElementById("buscador").value;
      const paradaFinal = document.getElementById("buscador2").value;

      const rutaEncontrada = buscarRuta(paradaInicial, paradaFinal);

      if (!rutaEncontrada) {
        document.getElementById("rutaResultado").innerHTML = "No hay ruta disponible para llegar desde la PI hasta la PF.";
      } else {
        //let rutaGenerada = "Recorrido: ";
        //rutaGenerada += `${rutaEncontrada.ruta}: ${rutaEncontrada.paradasComunes.join(" ➔ ")} ➔ ${rutaEncontrada.rutaFinal}: ${rutaEncontrada.paradaComunn.join(" ➔ ")}`;
        //rutaGenerada += `<h6>Esto es una beta puede que no sea correcta en un 100%<h6>`;
        //document.getElementById("rutaResultado").innerHTML = rutaGenerada;

        waypoints = [];
        waypoints.push({
          lat: getCoordenadaLat(paradaInicial),
          lng: getCoordenadaLng(paradaInicial)
        });
        const paradaComunNombre = rutaEncontrada.paradasComunes[1];
        waypoints.push({
          lat: getCoordenadaLat(paradaComunNombre),
          lng: getCoordenadaLng(paradaComunNombre)
        });
        waypoints.push({
          lat: getCoordenadaLat(paradaFinal),
          lng: getCoordenadaLng(paradaFinal)
        });
        console.log(waypoints);
        personalRoute(waypoints);
      }
    }

    function getCoordenadaLat(paradaNombre) {
      const rutaEncontrada = rutas.find(ruta => ruta.paradas.some(parada => parada.nombre === paradaNombre));
      const paradaEncontrada = rutaEncontrada.paradas.find(parada => parada.nombre === paradaNombre);
      return paradaEncontrada.coords.lat;
    }

    function getCoordenadaLng(paradaNombre) {
      const rutaEncontrada = rutas.find(ruta => ruta.paradas.some(parada => parada.nombre === paradaNombre));
      const paradaEncontrada = rutaEncontrada.paradas.find(parada => parada.nombre === paradaNombre);
      return paradaEncontrada.coords.lng;
    }

    function personalRoute(waypoints) {
      console.log(waypoints);
      if (routingControl) {
        mapa.removeControl(routingControl);
      }
      routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function() {
          return null;
        },
        lineOptions: {
          styles: [{
            color: '#033666',
            weight: 5
          }]
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
  <script src="js/lrm-graphhopper.js"></script>
  <script src="coords_Paradas.js"></script>
  <script id="jvmapa">
    //Definición de variables utiles para el mapa
    const plat = document.querySelector("#latitud"),
      plong = document.querySelector("#longitud");
    var lati, long;
    var lati2, long2;
    var marcador = null;
    var routingControl = null;
    var boton = document.getElementById('btnsr');
    var script = document.getElementById('jvmapa');
    var mapa = L.map('map');
    var waypoint1 = null;
    var dvdr = null;
    var routeLayer;
    var body = document.getElementById('body');


    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapa);
    var marker = L.marker([80, 80]).addTo(mapa);
    mapa.setView([13.68031, -89.28997], 15);
    var initialLatLng = L.latLng(13.67351, -89.28469);

    const init = () => {
      if (!"geolocation" in navigator) {
        return alert("Your browser does not support location access. try another");
      }

      const ZOOM = 15;

      const onActualizacionDeUbicacion = ubicacion => {
        const coordenadas = ubicacion.coords;
        let {
          latitude,
          longitude
        } = coordenadas;
        // Actualización de ubicación
        console.log(latitude);
        console.log(longitude);
        plat.innerText = latitude;
        plong.innerText = longitude;
        lati = document.getElementById('latitud').innerText;
        long = document.getElementById('longitud').innerText;
        if (marker != null) {
          mapa.removeControl(marker);
          marker = L.marker([latitude, longitude]).addTo(mapa);
          marker.setPopupContent("<p>You!</p>").openPopup();
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
    // var marcador = L.marker(initialLatLng, {
    //   draggable: true
    // }).addTo(mapa);

    // marcador.bindPopup("Coordenadas: " + initialLatLng.toString());

    // marcador.on('dragend', function(event) {
    //   var marcadorLatLng = event.target.getLatLng();
    //   marcador.setPopupContent("Coordenadas: " + marcadorLatLng.toString()).openPopup();;
    // });
  </script>
  <script src="markers_Paradas.js"></script>
</body>

</html>