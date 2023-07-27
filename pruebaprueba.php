<!DOCTYPE html>
<html>

<head>
    <title>Sistema de Rutas de Autobús</title>
</head>

<body>
    <script>
        // Datos de las rutas de autobús
        const rutas = [{
                nombre: 'Ruta A',
                paradas: ['Parada 1', 'Parada 2', 'Parada 23', 'Parada 4', 'Parada 5', 'Parada 6']
            },
            {
                nombre: 'Ruta B',
                paradas: ['Parada 6', 'Parada 7', 'Parada 8', 'Parada 9', 'Parada 12', 'Parada 3']
            },
            {
                nombre: 'Ruta C',
                paradas: ['Parada 3', 'Parada 10', 'Parada 11', 'Parada 13']
            },
            {
                nombre: 'Ruta D',
                paradas: ['Parada 13', 'Parada 19', 'Parada 31', 'Parada 27']
            }
        ];

        function generateRoute() {
            // Obtener la parada inicial y la parada final ingresadas por el usuario
            const startInput = document.getElementById('startInput');
            const endInput = document.getElementById('endInput');
            const start = startInput.value;
            const end = endInput.value;

            // Buscar la parada inicial y la parada final en las rutas
            const startRoute = findRouteByStop(start);
            const endRoute = findRouteByStop(end);

            // Verificar si se encontraron las rutas y generar la ruta completa
            if (startRoute && endRoute) {
                const routePath = getCompleteRoute(startRoute, endRoute, start, end);

                // Combinar las rutas y mostrar la ruta completa en el contenedor HTML
                const resultContainer = document.getElementById('resultContainer');
                resultContainer.innerHTML = '';
                const routeElement = document.createElement('p');
                routeElement.textContent = `Recorrido: ${routePath}`;
                resultContainer.appendChild(routeElement);
            } else {
                const noRoutesElement = document.createElement('p');
                noRoutesElement.textContent = 'No se encontraron rutas que incluyan las paradas ingresadas.';
                resultContainer.appendChild(noRoutesElement);
            }
        }

        // Función para obtener la ruta completa con rutas intermedias entre la parada inicial y la parada final
        function getCompleteRoute(startRoute, endRoute, start, end) {
            const commonStop = findCommonStop(startRoute, endRoute);
            if (commonStop) {
                const startRoutePath = getPathToStop(startRoute, start, commonStop);
                const endRoutePath = getPathToStop(endRoute, commonStop, end);
                const commonPath = getPathBetweenStops(startRoute, endRoute, commonStop);
                const intermediateStops = getIntermediateStops(commonPath);
                // Combinar las rutas y mostrar la ruta completa
                let routePath = '';

                const endRouteIndex = rutas.indexOf(endRoute);

                for (let i = 0; i <= endRouteIndex; i++) {
                    const route = rutas[i];
                    const indexEnd = route.paradas.indexOf(end);
                    if (route === endRoute) {
                        const routePathInclusive = getPathToStop(route, commonStop, end);
                        routePath += `${route.nombre}: ${routePathInclusive.join(' -> ')} `;
                    } else {
                        //Este
                        const routePathInclusive = getPathToStop(route, route.paradas[0], route.paradas[route.paradas.length - 1], endRouteIndex, indexEnd);
                        routePath += `${route.nombre}: ${routePathInclusive.join(' -> ')} `;
                    }
                }

                return routePath;
            } else {
                const noRoutesElement = document.createElement('p');
                noRoutesElement.textContent = 'No se encontró una ruta directa entre las paradas ingresadas.';
                resultContainer.appendChild(noRoutesElement);
            }
        }

        // Función para obtener el camino desde una parada inicial hasta una parada específica en una ruta
        function getPathToStop(route, start, end, endIndexRoute, indexEnd) {
            const startIndex = route.paradas.indexOf(start);
            const endIndex = route.paradas.indexOf(end);
            const rotex = indexEnd;
            //const index = rutas.paradas.indexOf(end);
            if (rotex == endIndexRoute) {
                return route.paradas.slice(startIndex, endIndex + 1);
            } else {
                if (startIndex < endIndex) {
                    return route.paradas.slice(startIndex, endIndex + 1);
                } else {
                    return route.paradas.slice(endIndex, startIndex + 1).reverse();
                }
            }

        }

        function getPathBetweenStops(route1, route2, commonStop) {
            const commonIndex1 = route1.paradas.indexOf(commonStop);
            const commonIndex2 = route2.paradas.indexOf(commonStop);
            return route1.paradas.slice(commonIndex1).concat(route2.paradas.slice(commonIndex2 + 1));
        }

        function findRouteByStop(stop) {
            return rutas.find(ruta => ruta.paradas.includes(stop));
        }

        function findCommonStop(route1, route2, visitedRoutes = []) {
            const commonStops = route1.paradas.filter(parada => {
                return route2.paradas.includes(parada) && !visitedRoutes.includes(parada);
            });

            if (commonStops.length > 0) {
                return commonStops[0]; // Devolver la primera parada en común encontrada
            } else {
                // Buscar otras rutas que tengan paradas en común con la ruta1
                const otherRoutes = rutas.filter(ruta => {
                    return ruta !== route1 && ruta.paradas.some(parada => !visitedRoutes.includes(parada));
                });

                for (const otherRoute of otherRoutes) {
                    const commonStop = findCommonStop(otherRoute, route2, visitedRoutes.concat(route1.paradas));
                    if (commonStop) {
                        return commonStop;
                    }
                }

                return null; // No se encontraron más paradas en común
            }
        }

        function getIntermediateStops(startRoute, endRoute, commonStop) {
            const intermediateStops = [];
            const startRouteIndex = rutas.indexOf(startRoute);
            const endRouteIndex = rutas.indexOf(endRoute);

            for (let i = startRouteIndex + 1; i < endRouteIndex; i++) {
                const route = rutas[i];
                const commonStopIndex = route.paradas.indexOf(commonStop);
                intermediateStops.push(...route.paradas.slice(commonStopIndex + 1));
            }

            return intermediateStops;
        }

    </script>
    <h1>Sistema de Rutas de Autobús</h1>
    <label for="startInput">Parada Inicial:</label>
    <input type="text" id="startInput" placeholder="Ingrese la parada inicial">
    <label for="endInput">Parada Final:</label>
    <input type="text" id="endInput" placeholder="Ingrese la parada final">
    <button onclick="generateRoute()">Generar Ruta</button>
    <div id="resultContainer"></div>
</body>

</html>