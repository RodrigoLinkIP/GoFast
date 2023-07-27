var parads = L.icon({
    iconUrl: 'photos/CC.png',

    iconSize: [26, 26], // size of the icon
    iconAnchor: [10, 20], // point of the icon which will correspond to marker's location
    popupAnchor: [4, -20] // point from which the popup should open relative to the iconAnchor
});

var routingControl = null;

function makeRoute() {
    var waypoints = [
        [13.694662, -89.191923],
        [13.678539, -89.199633],
        [13.670764438506898, -89.22247326507767],
        [13.663860, -89.213643],
        [13.670904, -89.209158],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
        lineOptions: {
            styles: [{ color: '#033666', weight: 5 }]
        }
    }).addTo(mapa);
    var ruta = rutas[0];
    var directionsDiv = document.querySelector('.leaflet-routing-container');

    // Verifica si el elemento existe antes de ocultarlo
    if (directionsDiv) {
        // Aplica un estilo CSS para ocultar el elemento
        directionsDiv.style.display = 'none';
    }
}

function makeRoute2() {
    var waypoints = [
        [13.68078053849636, -89.30616493659207],
        [13.675265576004998, -89.28572439847454],
        [13.677819541113127, -89.26355693238473],
        [13.666716135119131, -89.28764519511441],
        [13.672118456263869, -89.28894742890361],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute3() {
    var waypoints = [
        [13.68173, -89.27984],
        [13.67161361434936, -89.27531426862102],
        [13.687636, -89.235046],
        [13.701167, -89.193599],
        [13.70083, -89.1758],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute4() {
    var waypoints = [
        [13.680137556171633, -89.28176834726784],
        [13.677819541113127, -89.26355693238473],
        [13.689382210356008, -89.232753692798826],
        [13.70101041430872, -89.22190186716553],
        [13.699310300760917, -89.18608340031723],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute5() {
    var waypoints = [
        [13.687816278030965, -89.27262940818521],
        [13.6687336533196, -89.2666701897165],
        [13.676005305128466, -89.30373556227966],
        [13.700367139990627, -89.21429291684709],
        [13.70082480799357, -89.19575117504924],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute6() {
    var waypoints = [
        [13.680885066699249, -89.31231026303205],
        [13.67161361434936, -89.27531426862102],
        [13.692359652216977, -89.20070239756589],
        [13.698808359422099, -89.19731045709648]
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute7() {
    var waypoints = [
        [13.699603732323908, -89.19686213263637],
        [13.700367139990627, -89.21429291684709],
        [13.691231640040266, -89.23106313231399],
        [13.673445702691305, -89.29498786903474],
        [13.671722124901507, -89.30147041290189],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute8() {
    var waypoints = [
        [13.700655380879496, -89.21046566721955],
        [13.692612924625411, -89.22859303957112],
        [13.669561344223897, -89.26498482948686],
        [13.670767711005183, -89.28174572455414],
        [13.671710878593773, -89.30122025828777],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute9() {
    var waypoints = [
        [13.699797036414756, -89.19681412891606],
        [13.700367139990627, -89.21429291684709],
        [13.691231640040266, -89.23106313231399],
        [13.676717480231899, -89.28791612837011],
        [13.681333504290398, -89.31198326976241],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute10() {
    var waypoints = [
        [13.6978314288765, -89.19696087074924],
        [13.692612924625411, -89.22859303957112],
        [13.676717896281806, -89.28791664705155],
        [13.678256662199717, -89.29687577328001],
        [13.680885066699249, -89.31231026303205],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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

function makeRoute11() {
    var waypoints = [
        [13.719228690260174,-89.35578716689339],
        [13.679582927759444, -89.27387896562632],
        [13.67838087613831, -89.25621241261784],
        [13.714011895040207, -89.24729183102691],
        [13.707183563365385, -89.19271049293407],
    ];
    //waypoints.forEach(function (waypoint) {
    //    L.marker(waypoint, { icon: parads }).addTo(mapa);
    //});
    if (routingControl) {
        mapa.removeControl(routingControl);
    }
    routingControl = L.Routing.control({
        waypoints: waypoints,
        router: L.Routing.graphHopper('66afe0b2-48b5-4b39-aae5-1eeb6cae4586'),
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        createMarker: function () { return null; },
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