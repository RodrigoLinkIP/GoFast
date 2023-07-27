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
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <script src="rutas_copy.js"></script>
    <title>Bus billboard</title>
    <style>
        html,
        body {
            font-family: "Open Sans", Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(https://thumbs.dreamstime.com/z/rayas-abstractas-l%C3%ADnea-modelo-incons%C3%BAtil-fondo-monocrom%C3%A1tico-neutral-del-negocio-color-gris-negro-formas-lineares-ornamento-153866450.jpg?w=768);
        }

        .container {
            display: flex;
            width: 100%;
            flex-wrap: wrap;
            margin-left: 0.5%;
        }

        .container canvas {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .ln {
            flex: 1 1 1 25%;
            min-width: auto;
            box-sizing: border-box;
        }

        .cu {
            border: 3px solid #033666;
            margin-right: 3%;
            margin-bottom: 1%;
            border-radius: 5px;
            background-color: white;
        }

        .last-p {
            margin-bottom: 0;
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

        .h3-tt {
            margin-bottom: 5px;
            display: flex;
            justify-content: center;
        }

        .navbar {
            background-color: #033666 !important;
            margin-bottom: 1%;
        }

        .img {
            border-radius: 5px;
        }

        .nav-link {
            padding: 0.2rem !important;
        }

        .navbar-nav li {
            display: flex !important;
            padding-left: 3px !important;
            padding-right: 3px !important;
        }

        h1 {
            color: white !important;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: #0087ff;
        }

        h2 {
            color: white !important;
        }

        h6 {
            margin: 0;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

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

        #advanced-search {
            position: absolute;
            top: 150px;
            left: 10px;
            width: 11px;
            height: 15px;
            padding: 15px;
            background: url(photos/descarga.png);
            background-position: center;
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

        .cu1 {
            margin-left: 0.5%;
        }

        .h31 {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
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
            text: 'Leaving so soon?',
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, goodbye!',
            cancelButtonText: 'Not yet!'
        }).then((result) => {
            if (result.isConfirmed) 
            {(setTimeout(function(){window.location = 'closesession.php';}, 0))}
          });
                                }
                              </script>
                </li>
                <li class="nav-item">
                    <section>
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
                        </script>
                        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
                    </section>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        var waypoints = [];

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
            const paradaInicial = document.getElementById("paradaInicial").value;
            const paradaFinal = document.getElementById("paradaFinal").value;

            const rutaEncontrada = buscarRuta(paradaInicial, paradaFinal);

            if (!rutaEncontrada) {
                document.getElementById("rutaResultado").innerHTML = "No hay ruta disponible para llegar desde la PI hasta la PF.";
            } else {
                let rutaGenerada = "Recorrido: ";
                rutaGenerada += `${rutaEncontrada.ruta}: ${rutaEncontrada.paradasComunes.join(" ➔ ")} ➔ ${rutaEncontrada.rutaFinal}: ${rutaEncontrada.paradaComunn.join(" ➔ ")}`;
                rutaGenerada += `<h6>Esto es una beta puede que no sea correcta en un 100%<h6>`;
                document.getElementById("rutaResultado").innerHTML = rutaGenerada;
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
    </script>
    <section class="section">
        <div class="cu cu1">
            <div class="ln">
                <h3 id="h31" class="h3-tt h31">Bus Billboard</h3>
            </div>
        </div>
        <div class="container">
            <!-- <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 35</h3>
                    <p>Avenida Cuscatlan</p>
                    <p>Calle Modelo</p>
                    <p>Calle A, 212</p>
                    <p>Avenida Irazu, 166</p>
                    <p>Avenida Irazu</p>
                    <p>Pasaje San Rafel</p>
                    <p>Boulevard San Patricio</p>
                    <p>Iglesia Católica San Patricio</p>
                </div>
            </div> -->
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 97</h3>
                    <div class="div-scroll">
                        <p>Calle Real</p>
                        <p>5 Calle Poniente, 3</p>
                        <p>Paseo Concepción</p>
                        <p>Paseo El Carmen</p>
                        <p>7 Avenida Norte</p>
                        <p>7 Calle Oriene Bis, 18</p>
                        <p>9° Calle Oriente</p>
                        <p>Calle Chiltiupan</p>
                        <p>Boulevard Merliot</p>
                        <p>Carretera Santa Tecla</p>
                        <p>Bulevar Sur</p>
                        <p>14 Avenida Sur, 12y</p>
                        <p class="last-p">Carretera Panamericana, 5</p>
                    </div>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 42-A</h3>
                    <div class="div-scroll">
                        <p>13 Calle Oriente</p>
                        <p>Calle El Jabali, 5</p>
                        <p>Calle El Jabali</p>
                        <p>Bulevar Merliot</p>
                        <p>Calle La Cañada</p>
                        <p>Calle El Pedregal, 13</p>
                        <p>Calle El Pedregal</p>
                        <p>Bulevar Merliot</p>
                        <p>Carretera Panamericana</p>
                        <p>Acceso A La Laguna</p>
                        <p>Calle Circunvalación</p>
                        <p>Calle Cuscatlán Oriente</p>
                        <p>Parada Palo De Hule</p>
                        <p>Avenue Rio Amazonas, 3</p>
                        <p>Calle Del Mediterraneo</p>
                        <p>Carretera Panamericana</p>
                        <p>Alameda Manuel Enrique Araujo, 211</p>
                        <p>Avenida Manuel Enrique Araujo</p>
                        <p>Parque de Pelota</p>
                        <p>Avenida Las Camelias, 140</p>
                        <p>Calle Lorena, 138</p>
                        <p>Alameda Manuel Enrique Araujo, 1066</p>
                        <p>Alameda Franklin Delano Rosevelt, 2731</p>
                        <p>Avenida Franklin Delano Rosevelt</p>
                        <p>37 Avenida Norte, 120</p>
                        <p>Avenida Franklin Delano Rosevelt</p>
                        <p>21 Avenida Sur, 113</p>
                        <p>Calle Arce, 1114</p>
                        <p>13 Avenida Norte, 231</p>
                        <p>3a Calle Poniente Shafik Handal, 318</p>
                        <p>Avenida España, 312</p>
                        <p>3 Calle Oriente, 333</p>
                        <p>12 Avenida Norte, 219</p>
                        <p>20 Avenida Norte, 220</p>
                        <p class="last-p">Parada Terminal De Oriente</p>
                    </div>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 42-B</h3>
                    <div class="div-scroll">
                        <p>9 Calle Oriente Bis, 33</p>
                        <p>11 Calle Oriente</p>
                        <p>9 Calle Oriente</p>
                        <p>Calle Chiltiupán</p>
                        <p>Calle Chiltiupan, 1</p>
                        <p>Calle El Pedregal 26</p>
                        <p>Calle El Pedregal</p>
                        <p>Calle Antigua Ferrocarril, 29</p>
                        <p>Carretera Panamericana</p>
                        <p>Alameda Manuel Enrique Araujo, 211</p>
                        <p>Parque De Pelota</p>
                        <p>Avenida Las Camelias, 140</p>
                        <p>Calle Lorena, 138</p>
                        <p>Alameda Manuel Enrique Araujo, 1100</p>
                        <p>Alameda Manuel Enrique Araujo, 1066</p>
                        <p>Alameda Franklin Delano Roosevelt, 4</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>37 Avenida Norte, 120</p>
                        <p>Avenida Franklin Delano Roosevelt</p>
                        <p>21 Avenida Sur, 113</p>
                        <p>Calle Arce, 1114</p>
                        <p>13 Avenida Norte, 231</p>
                        <p>3a Calle Poniente Shafik Handal, 318</p>
                        <p>3 Calle Oriente, 333</p>
                        <p>Calle Concepción, 241</p>
                        <p class="last-p">12a Avenida Norte</p>
                    </div>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 42-C</h3>
                    <div class="div-scroll">
                        <p>Calle B</p>
                        <p>Avenida A</p>
                        <p>Calle El Jabali</p>
                        <p>Calle La Cañada</p>
                        <p>Avenida La Quebrada</p>
                        <p>Calle El Pedregal</p>
                        <p>Boulevard Merliot</p>
                        <p>Calle Siemens, 50</p>
                        <p>Carretera Panamericana</p>
                        <p>Bulevar Monseñor Romero</p>
                        <p>Boulevard Los Próceres</p>
                        <p>49 Avenida Sur</p>
                        <p>12 Calle Poniente, 2517</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>37 Avenida Norte, 120</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>21 Avenida Sur, 113</p>
                        <p>Calle Arce, 114</p>
                        <p>9 Avenida Norte, 535</p>
                        <p class="last-p">3 Calle Oriente, 333</p>
                    </div>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 101-1</h3>
                    <p>Avenida Francia</p>
                    <p>Carretera Panamericana</p>
                    <p>Calle Ruben Dario, 58</p>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 101A-1</h3>
                    <div class="div-scroll">
                        <p>11 Avenida Norte, 116</p>
                        <p>Calle Arce, 1114</p>
                        <p>Calle Arce, 1278</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>Alameda Franklin Delano Roosevelt, 4</p>
                        <p>Alameda Manuel Enrique Araujo</p>
                        <p>Carretera Panamericana</p>
                        <p>Carretera Panamericana, 14</p>
                        <p>2° Calle Oriente</p>
                        <p>Carretera Panamericana, 2</p>
                        <p>5 Avenida Norte, 2</p>
                        <p>4 Avenida Sur, 2</p>
                        <p>6 Avenida Sur, 1</p>
                        <p>2° Calle Poniente, 7</p>
                        <p>2° Calle Oriente</p>
                        <p>Avenida El Cipres</p>
                        <p>Avenida La Ceiba</p>
                        <p class="last-p">Calle El Cedro</p>
                    </div>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 101A-2</h3>
                    <div class="div-scroll">
                        <p>37 Avenida Norte, 120</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>Alameda Franklin Delano Roosevelt, 2731</p>
                        <p>67 Avenida Sur, 255a</p>
                        <p>Avenida Las Camelias, 140</p>
                        <p>Alameda Manuel Enrique Araujo</p>
                        <p>Carretera Panamericana</p>
                        <p>Carretera Panamericana, 14</p>
                        <p>Carretera Americana</p>
                        <p>Boulevard Merliot</p>
                        <p>Carretera Puerto La Libertad</p>
                        <p>Carretera Santa Tecla</p>
                        <p>Carretera Puerto La Libertad, 11</p>
                        <p>Bulevar Sur</p>
                        <p>5° Avenida Sur</p>
                        <p>6 Calle Oriente 6</p>
                        <p>2° Calle Oriente</p>
                        <p>4 Avenida Sur, 2</p>
                        <p>6 Avenida Sur, 1</p>
                        <p>2 Calle Poniente, 7</p>
                        <p>Avenida El Cipres</p>
                        <p class="last-p">Avenida La Ceiba</p>
                    </div>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 101B-1</h3>
                    <div class="div-scroll">
                        <p>11 Avenida Norte, 116</p>
                        <p>Calle Arce, 1114</p>
                        <p>Calle Arce, 1278</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>37 Avenida Norte, 120</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>Alameda Franklin Delano Roosevelt, 2731</p>
                        <p>Alameda Manuel Enrique Araujo, 1066</p>
                        <p>Carretera Panamericana</p>
                        <p>Alameda Manuel Enrique Araujo</p>
                        <p>Carretera Panamericana, 14</p>
                        <p>2° Calle Oriente</p>
                        <p>Carretera Panamericana, 2</p>
                        <p>3° Avenida Norte</p>
                        <p>3 Calle Oriente, 8</p>
                        <p>Avenida Dr. Manuel Gallardo, 4</p>
                        <p>4 Avenida Norte, 2</p>
                        <p>3° Calle Poniente</p>
                        <p>10 Avenida Norte</p>
                        <p>Calle Real</p>
                        <p>Avenida Pdre Segundo Montes</p>
                        <p class="last-p">Terminal 101b</p>
                    </div>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 101B-2</h3>
                    <div class="div-scroll">
                        <p>4a Calle Poniente, 729</p>
                        <p>4° Calle Poniente</p>
                        <p>21 Avenida Sur, 113</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>37 Avenida Norte, 120</p>
                        <p>Alameda Franklin Delano Roosevelt</p>
                        <p>Alameda Franklin Delano Roosevelt, 2731</p>
                        <p>Alameda Manuel Enrique Araujo, 1066</p>
                        <p>Avenida Las Camelias, 140</p>
                        <p>Alameda Manuel Enrique Araujo</p>
                        <p>Carretera Panamericana</p>
                        <p>Carretera Panamericana, 14</p>
                        <p>2° Calle Oriente</p>
                        <p>Carretera Panamericana, 2</p>
                        <p>3° Avenida Norte</p>
                        <p>3 Calle Oriente, 8</p>
                        <p>Avenida Dr. Manuel Gallardo, 2b</p>
                        <p>3° Calle Poniente</p>
                        <p>4 Avenida Norte, 2</p>
                        <p>3° Calle Poniente</p>
                        <p>12 Avenida Norte</p>
                        <p>Calle Real, 16</p>
                        <p>Avenida Pdre Segundo Montes</p>
                        <p>Avenida 2</p>
                        <p>Calle Real</p>
                        <p>Calle Real, 91</p>
                        <p class="last-p">Avenida Francia</p>
                    </div>
                </div>
            </div>
            <div class="cu">
                <div class="ln">
                    <h3 class="h3-tt">Ruta 101D</h3>
                    <div class="div-scroll">
                        <p>Calle El Poliedro</p>
                        <p>Calle Madre Mariá Mazarello</p>
                        <p>Calle San Miguel</p>
                        <p>Avenida San Francisco</p>
                        <p>Calle San José</p>
                        <p>6° Avenida Norte</p>
                        <p>10 Avenida Norte</p>
                        <p>Calle Daniel Hernández</p>
                        <p>7 Calle Oriente Bis, 18</p>
                        <p>9° Calle Oriente</p>
                        <p>Calle Chiltiupan</p>
                        <p>Calle Chiltiupan, 1</p>
                        <p>Calle El Pedregal</p>
                        <p>Avenida Jerusalen, 13</p>
                        <p>Avenida Jerusalen</p>
                        <p>Calle La Mascota, 928</p>
                        <p>Calle La Mascota, 718</p>
                        <p>Calle La Mascota, 444</p>
                        <p>75 Avenida Sur</p>
                        <p>3a Calle Poniente, 3970</p>
                        <p>9a Calle Poniente, 3843</p>
                        <p>75 Avenida Norte</p>
                        <p>Alameda Juan Pablo II, 21</p>
                        <p>Prolongación Juan Pablo II</p>
                        <p>Avenida Los Andes</p>
                        <p>25 Avenida Norte, 340</p>
                        <p>Boulevard Tutunichapa</p>
                        <p>Prolongación Boulevard Tutunichapa, 808</p>
                        <p class="last-p">5 Avenida Norte, 17</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div>
        <div class="cu cu1">
            <div class="ln h31">
                <label for="paradaInicial">Parada Inicial:</label>
                <input type="text" id="paradaInicial" placeholder="Ingrese la parada inicial">
                <label for="paradaFinal">Parada Final:</label>
                <input type="text" id="paradaFinal" placeholder="Ingrese la parada final">
                <button onclick="generarRuta()">Generar Ruta</button>
                <a href="mapaprueba.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Go back</a>
                <div id="rutaResultado"></div>
            </div>
        </div>
    </div>
</body>

</html>