var greenIcon = L.icon({
    iconUrl: 'photos/Marker_Bus.png',

    iconSize: [26, 42], // size of the icon
    iconAnchor: [10, 41], // point of the icon which will correspond to marker's location
    popupAnchor: [4, -41] // point from which the popup should open relative to the iconAnchor
});

var rt = null;

//*************** Ruta 35 ***************/
var ruta35_n1 = L.marker([13.694662, -89.191923], {
    icon: greenIcon
}).bindPopup("<h4>Route 35</h4><buttton class='btnrt' onclick='makeRoute()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 35)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta35_n2 = L.marker([13.670904, -89.209158], {
    icon: greenIcon
}).bindPopup("<h4>Route 35</h4><buttton class='btnrt' onclick='makeRoute()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 35)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//*************** Ruta 97 ***************/
var ruta97_n1 = L.marker([13.68078053849636, -89.30616493659207], {
    icon: greenIcon
}).bindPopup("<h4>Route 97</h4><buttton class='btnrt' onclick='makeRoute2()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 97)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta97_n2 = L.marker([13.672184, -89.288947], {
    icon: greenIcon
}).bindPopup("<h4>Route 97</h4><buttton class='btnrt' onclick='makeRoute2()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 97)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 42-A **************/
var ruta42A_n1 = L.marker([13.68173, -89.279847], {
    icon: greenIcon
}).bindPopup("<h4>Route 42-A</h4><buttton class='btnrt' onclick='makeRoute3()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 421)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta42A_n2 = L.marker([13.70083, -89.17581], {
    icon: greenIcon
}).bindPopup("<h4>Route 42-A</h4><buttton class='btnrt' onclick='makeRoute3()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 421)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 42-B **************/
var ruta42B_n1 = L.marker([13.680137556171633, -89.28176834726784], {
    icon: greenIcon
}).bindPopup("<h4>Route 42-B</h4><buttton class='btnrt' onclick='makeRoute4()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 422)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta42B_n2 = L.marker([13.699310300760917, -89.18608340031723], {
    icon: greenIcon
}).bindPopup("<h4>Route 42-B</h4><buttton class='btnrt' onclick='makeRoute4()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 422)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 42-C **************/
var ruta42C_n1 = L.marker([13.687816278030965, -89.27262940818521], {
    icon: greenIcon
}).bindPopup("<h4>Route 42-C</h4><buttton class='btnrt' onclick='makeRoute5()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 423)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta42C_n2 = L.marker([13.70082480799357, -89.19575117504924], {
    icon: greenIcon
}).bindPopup("<h4>Route 42-C</h4><buttton class='btnrt' onclick='makeRoute5()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 423)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 101 **************/
var ruta101_n1 = L.marker([13.680885066699249, -89.31231026303205], {
    icon: greenIcon
}).bindPopup("<h4>Route 101</h4><buttton class='btnrt' onclick='makeRoute6()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 101)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta101_n2 = L.marker([13.698808359422099, -89.19731045709648], {
    icon: greenIcon
}).bindPopup("<h4>Route 101</h4><buttton class='btnrt' onclick='makeRoute6()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 101)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 101-A **************/
var ruta101A_n1 = L.marker([13.671722124901507, -89.30147041290189], {
    icon: greenIcon
}).bindPopup("<h4>Route 101-A</h4><buttton class='btnrt' onclick='makeRoute7()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 1011)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta101A_n2 = L.marker([13.699603732323908, -89.19686213263637], {
    icon: greenIcon
}).bindPopup("<h4>Route 101-A</h4><buttton class='btnrt' onclick='makeRoute7()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 1011)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 101A-2 **************/
var ruta101A2_n1 = L.marker([13.700655380879496, -89.21046566721955], {
    icon: greenIcon
}).bindPopup("<h4>Route 101A-2</h4><buttton class='btnrt' onclick='makeRoute8()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 10112)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta101A2_n2 = L.marker([13.671710878593773, -89.30122025828777], {
    icon: greenIcon
}).bindPopup("<h4>Route 101A-2</h4><buttton class='btnrt' onclick='makeRoute8()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 10112)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 101B-1 **************/
var ruta101B_n1 = L.marker([13.699797036414756, -89.19681412891606], {
    icon: greenIcon
}).bindPopup("<h4>Route 101B-1</h4><buttton class='btnrt' onclick='makeRoute9()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 10121)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta101B_n2 = L.marker([13.681333504290398, -89.31198326976241], {
    icon: greenIcon
}).bindPopup("<h4>Route 101B-1</h4><buttton class='btnrt' onclick='makeRoute9()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 10121)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 101B-2 **************/
var ruta101B2_n1 = L.marker([13.6978314288765, -89.19696087074924], {
    icon: greenIcon
}).bindPopup("<h4>Route 101B-2</h4><buttton class='btnrt' onclick='makeRoute10()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 10122)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta101B2_n2 = L.marker([13.680885066699249, -89.31231026303205], {
    icon: greenIcon
}).bindPopup("<h4>Route 101B-2</h4><buttton class='btnrt' onclick='makeRoute10()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 10122)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/

//************ Ruta 101D **************/
var ruta101D_n1 = L.marker([13.719228690260174,-89.35578716689339], {
    icon: greenIcon
}).bindPopup("<h4>Route 101D</h4><buttton class='btnrt' onclick='makeRoute11()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 1013)'>Pay for a bus in this route</button>").addTo(mapa);

var ruta101D_n2 = L.marker([13.707183563365385, -89.19271049293407], {
    icon: greenIcon
}).bindPopup("<h4>Route 101D</h4><buttton class='btnrt' onclick='makeRoute11()'>View Route</button></br></br><button class='payment btnrt' onclick='paymentf(rt = 1013)'>Pay for a bus in this route</button>").addTo(mapa);
//****************************************/


function paymentf(rt) {
    var rute = rt;
    console.log(rute);
    window.location = 'payment.php' + "?var=" + rute;
}