const rutas = [{
    nombre: 'Ruta 35',
    paradas: [
        'Avenida Cuscatlan',
        'Calle Modelo',
        'Calle A, 212',
        'Avenida Irazu, 166',
        'Avenida Irazu',
        'Pasaje San Rafel',
        'Boulevard San Patricio',
        'Iglesia Catolica San Patricio'
    ]
},
{
    nombre: 'Ruta 97',
    paradas: [
        'Calle Real',
        '5 Calle Poniente, 3',
        'Paseo Concepcion',
        'Paseo El Carmen',
        '7 Avenida Norte',
        '7 Calle Oriente Bis, 18',
        '9 Calle Oriente',
        'Calle Chiltiupan',
        'Bulevar Merliot',
        'Carretera Santa Tecla',
        'Bulevar Sur',
        '14 Avenida Sur, 12y',
        'Carretera Panamericana, 5'
    ]
},
{
    nombre: 'Ruta 42-A',
    paradas: [
        '13 Calle Oriente',
        'Calle El Jabali, 5',
        'Calle El Jabali',
        'Bulevar Merliot',
        'Calle La Cañada',
        'Calle El Pedregal, 13',
        'Calle El Pedregal',
        'Bulevar Merliot',
        'Carretera Panamericana',
        'Acceso a La Laguna',
        'Calle Circunvalacion',
        'Calle Cuscatlan Oriente',
        'Parada de Palo De Hule',
        'Avenue Rio Amazonas, 3',
        'Calle Del Mediterraneo',
        'Carretera Panamericana',
        'Alameda Manuel Enrique Araujo, 211',
        'Alameda Manuel Enrique Araujo',
        'Parque de Pelota',
        'Avenida Las Camelias, 140',
        'Calle Lorena, 138',
        'Alameda Manuel Enrique Araujo, 1066',
        'Alameda Manuel Enrique Araujo, 1100',
        'Alameda Franklin Delano Roosevelt, 2731',
        'Alameda Franklin Delano Roosevelt',
        '37 Avenida Norte, 120',
        '21 Avenida Sur, 113',
        'Calle Arce, 1114',
        '13 Avenida Norte, 231',
        '3a Calle Poniente Shafik Handal, 318',
        'Avenida España, 312',
        '3 Calle Oriente, 333',
        '12 Avenida Norte, 219',
        '20 Avenida Norte, 220',
        'Parada Terminal De Oriente',
    ]
},
{
    nombre: 'Ruta 42-B',
    paradas: [
        '9 Calle Oriente Bis, 33',
        '11 Calle Oriente',
        '9 Calle Oriente',
        'Calle Chiltiupán',
        'Calle Chiltiupan, 1',
        'Calle El Pedregal 26',
        'Calle El Pedregal',
        'Calle Antigua Ferrocarril, 29',
        'Carretera Panamericana',
        'Alameda Manuel Enrique Araujo, 211',
        'Parque e Pelota',
        'Avenida Las Camelias, 140',
        'Calle Lorena, 138',
        'Alameda Manuel Enrique Araujo, 1066',
        'Alameda Manuel Enrique Araujo, 1100',
        'Alameda Franklin Delano Roosevelt, 4',
        'Alameda Franklin Delano Roosevelt',
        '37 Avenida Norte, 120',
        '21 Avenida Sur, 113',
        'Calle Arce, 1114',
        '13 Avenida Norte, 231',
        '3a Calle Poniente Shafik Handal, 318',
        '3 Calle Oriente, 333',
        'Calle Concepción, 241',
        '12a Avenida Norte'
    ]
},
{
    nombre: 'Ruta 42-C',
    paradas: [
        'Calle B',
        'Avenida A',
        'Calle El Jabali',
        'Calle La Cañada',
        'Avenida La Quebrada',
        'Calle El Pedregal',
        'Bulevar Merliot',
        'Calle Siemens, 50',
        'Carretera Panamericana',
        'Bulevar Monseñor Romero',
        'Boulevard Los Próceres',
        '49 Avenida Sur',
        '12 Calle Poniente, 2517',
        'Alameda Franklin Delano Roosevelt',
        '37 Avenida Norte, 120',
        '21 Avenida Sur, 113',
        'Calle Arce, 1114',
        '9 Avenida Norte, 535'
    ]
},
{
    nombre: 'Ruta 101-1',
    paradas: [
        'Avenida Francia',
        'Carretera Panamericana',
        'Calle Ruben Dario, 58'
    ]
},
{
    nombre: 'Ruta 101-A',
    paradas: [
        '11 Avenida Norte, 116',
        'Calle Arce, 1114',
        'Calle Arce, 1278',
        'Alameda Franklin Delano Roosevelt',
        'Alameda Franklin Delano Roosevelt, 4',
        'Alameda Manuel Enrique Araujo',
        'Carretera Panamericana',
        'Carretera Panamericana, 14',
        '2 Calle Oriente',
        'Carretera Panamericana, 2',
        '5 Avenida Norte, 2',
        '4 Avenida Sur, 2',
        '6 Avenida Sur, 1',
        '2 Calle Poniente, 7',
        '2 Calle Oriente',
        'Avenida El Cipres',
        'Avenida La Ceiba',
        'Calle El Cedro'
    ]
},
{
    nombre: 'Ruta 101A-2',
    paradas: [
        '37 Avenida Norte, 120',
        'Alameda Franklin Delano Roosevel',
        'Alameda Franklin Delano Roosevelt, 2731',
        '67 Avenida Sur, 255a',
        'Avenida Las Camelias, 140',
        'Alameda Manuel Enrique Araujo',
        'Carretera Panamericana',
        'Carretera Panamericana, 14',
        'Bulevar Merliot',
        'Carretera Puerto La Libertad',
        'Carretera Santa Tecla',
        'Carretera Puerto La Libertad, 11',
        'Bulevar Sur',
        '5 Avenida Sur',
        '6 Calle Oriente 6',
        '2 Calle Oriente',
        '4 Avenida Sur, 2',
        '6 Avenida Sur, 1',
        '2 Calle Poniente, 7',
        'Avenida El Cipres',
        'Avenida La Ceiba'
    ]
},
{
    nombre: 'Ruta 101B-1',
    paradas: [
        '11 Avenida Norte, 116',
        'Calle Arce, 1114',
        'Calle Arce, 1278',
        'Alameda Franklin Delano Roosevelt',
        '37 Avenida Norte, 120',
        'Alameda Franklin Delano Roosevelt',
        'Alameda Franklin Delano Roosevelt, 2731',
        'Alameda Manuel Enrique Araujo, 1066',
        'Carretera Panamericana',
        'Alameda Manuel Enrique Araujo',
        'Carretera Panamericana, 14',
        '2 Calle Oriente',
        'Carretera Panamericana, 2',
        '3 Avenida Norte',
        '3 Calle Oriente, 8',
        'Avenida Dr. Manuel Gallardo, 4',
        '4 Avenida Norte, 2',
        '3 Calle Poniente',
        '10 Avenida Norte',
        'Calle Real',
        'Avenida Pdre Segundo Montes',
        'Terminal 101b',
    ]
},
{
    nombre: 'Ruta 101B-2',
    paradas: [
        '4a Calle Poniente, 729',
        '4 Calle Poniente',
        '21 Avenida Sur, 113',
        'Alameda Franklin Delano Roosevelt',
        '37 Avenida Norte, 120',
        'Alameda Franklin Delano Roosevelt',
        'Alameda Franklin Delano Roosevelt, 2731',
        'Alameda Manuel Enrique Araujo, 1066',
        'Avenida Las Camelias, 140',
        'Alameda Manuel Enrique Araujo',
        'Carretera Panamericana',
        'Carretera Panamericana, 14',
        '2 Calle Oriente',
        'Carretera Panamericana, 2',
        '3 Avenida Norte',
        '3 Calle Oriente, 8',
        'Avenida Dr. Manuel Gallardo, 2b',
        '3 Calle Poniente',
        '4 Avenida Norte, 2',
        '3 Calle Poniente',
        '12 Avenida Norte',
        'Calle Real, 16',
        'Avenida Pdre Segundo Montes',
        'Avenida 2',
        'Calle Real',
        'Calle Real, 91',
        'Avenida Francia'
    ]
},
{
    nombre: 'Ruta 101D',
    paradas: [
        'Calle El Poliedro',
        'Calle Madre Mariá Mazarello',
        'Calle San Miguel',
        'Avenida San Francisco',
        'Calle San José',
        '6 Avenida Norte',
        '10 Avenida Norte',
        'Calle Daniel Hernández',
        '7 Calle Oriente Bis, 18',
        '9 Calle Oriente',
        'Calle Chiltiupan',
        'Calle Chiltiupan, 1',
        'Calle El Pedregal',
        'Avenida Jerusalen, 13',
        'Avenida Jerusalen',
        'Calle La Mascota, 928',
        'Calle La Mascota, 718',
        'Calle La Mascota, 444',
        '75 Avenida Sur',
        '3a Calle Poniente, 3970',
        '9a Calle Poniente, 3843',
        '75 Avenida Norte',
        'Alameda Juan Pablo II, 21',
        'Prolongación Juan Pablo II',
        'Avenida Los Andes',
        '25 Avenida Norte, 340',
        'Boulevard Tutunichapa',
        'Prolongación Boulevard Tutunichapa, 808',
        '5 Avenida Norte, 17',
    ]
}
];