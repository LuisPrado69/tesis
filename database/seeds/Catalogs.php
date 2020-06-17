<?php

use Illuminate\Database\Seeder;
use App\Models\System\Province;
use App\Models\System\Canton;

class Catalogs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Provinces
        $provinceJson = json_decode('[    
         {
           "id": 1,
           "name": " Azuay",
           "enabled": 1
         },
         {
           "id": 2,
           "name": " Bolívar",
           "enabled": 1           
         },
         {
           "id": 3,
           "name": " Cañar",
           "enabled": 1
         },
         {
           "id": 4,
           "name": " Carchi",
           "enabled": 1
         },
         {
           "id": 5,
           "name": " Cotopaxi",
           "enabled": 1
         },
         {
           "id": 6,
           "name": " Chimborazo",
           "enabled": 1
         },
         {
           "id": 7,
           "name": " El Oro",
           "enabled": 1
         },
         {
           "id": 8,
           "name": " Esmeraldas",
           "enabled": 1
         },
         {
           "id": 9,
           "name": " Guayas",
           "enabled": 1
         },
         {
           "id": 10,
           "name": " Imbabura",
           "enabled": 1
         },
         {
           "id": 11,
           "name": " Loja",
           "enabled": 1
         },
         {
           "id": 12,
           "name": " Los Ríos",
           "enabled": 1
         },
         {
           "id": 13,
           "name": " Manabí",
           "enabled": 1
         },
         {
           "id": 14,
           "name": " Morona Santiago",
           "enabled": 1
         },
         {
           "id": 15,
           "name": " Napo",
           "enabled": 1
         },
         {
           "id": 16,
           "name": " Pastaza",
           "enabled": 1
         },
         {
           "id": 17,
           "name": " Pichincha",
           "enabled": 1
         },
         {
           "id": 18,
           "name": " Tungurahua",
           "enabled": 1
         },
         {
           "id": 19,
           "name": " Zamora Chinchipe",
           "enabled": 1
         },
         {
           "id": 20,
           "name": " Galápagos",
           "enabled": 1
         },
         {
           "id": 21,
           "name": " Sucumbíos",
           "enabled": 1
         },
         {
           "id": 22,
           "name": " Orellana",
           "enabled": 1
         },
         {
           "id": 23,
           "name": " Santo Domingo de los Tsáchilas",
           "enabled": 1
         },
         {
           "id": 24,
           "name": " Santa Elena",
           "enabled": 1
         },
         {
           "id": 25,
           "name": " Zonas no delimitadas",
           "enabled": 1
         }
        ]'
        );

        foreach ($provinceJson as $data) {
            Province::create([
                'id' => $data->id,
                'name' => $data->name,
                'enabled' => $data->enabled
            ]);
        }

        //Cantons
        $cantonJson = json_decode('[
         {
           "id": 1,
           "id_province": 1,
           "name": " Cuenca",
           "enabled": 1
         },
         {
           "id": 2,
           "id_province": 1,
           "name": " Girón",
           "enabled": 1
         },
         {
           "id": 3,
           "id_province": 1,
           "name": " Gualaceo",
           "enabled": 1
         },
         {
           "id": 4,
           "id_province": 1,
           "name": " Nabón",
           "enabled": 1
         },
         {
           "id": 5,
           "id_province": 1,
           "name": " Paute",
           "enabled": 1
         },
         {
           "id": 6,
           "id_province": 1,
           "name": " Pucará",
           "enabled": 1
         },
         {
           "id": 7,
           "id_province": 1,
           "name": " San Fernando",
           "enabled": 1
         },
         {
           "id": 8,
           "id_province": 1,
           "name": " Santa Isabel",
           "enabled": 1
         },
         {
           "id": 9,
           "id_province": 1,
           "name": " Sigsig",
           "enabled": 1
         },
         {
           "id": 10,
           "id_province": 1,
           "name": " Oña",
           "enabled": 1
         },
         {
           "id": 11,
           "id_province": 1,
           "name": " Chordeleg",
           "enabled": 1
         },
         {
           "id": 12,
           "id_province": 1,
           "name": " El Pan",
           "enabled": 1
         },
         {
           "id": 13,
           "id_province": 1,
           "name": " Sevilla de Oro",
           "enabled": 1
         },
         {
           "id": 14,
           "id_province": 1,
           "name": " Camilo Ponce Enríquez",
           "enabled": 1
         },
         {
           "id": 15,
           "id_province": 1,
           "name": " Chaguarpamba",
           "enabled": 1
         },
         {
           "id": 16,
           "id_province": 2,
           "name": " Guaranda",
           "enabled": 1
         },
         {
           "id": 17,
           "id_province": 2,
           "name": " Chillanes",
           "enabled": 1
         },
         {
           "id": 18,
           "id_province": 2,
           "name": " Chimbo",
           "enabled": 1
         },
         {
           "id": 19,
           "id_province": 2,
           "name": " Echeandía",
           "enabled": 1
         },
         {
           "id": 20,
           "id_province": 2,
           "name": " San Miguel",
           "enabled": 1
         },
         {
           "id": 21,
           "id_province": 2,
           "name": " Caluma",
           "enabled": 1
         },
         {
           "id": 22,
           "id_province": 2,
           "name": " Las Naves",
           "enabled": 1
         },
         {
           "id": 23,
           "id_province": 3,
           "name": " Azogues",
           "enabled": 1
         },
         {
           "id": 24,
           "id_province": 3,
           "name": " Biblián",
           "enabled": 1
         },
         {
           "id": 25,
           "id_province": 3,
           "name": " Cañar",
           "enabled": 1
         },
         {
           "id": 26,
           "id_province": 3,
           "name": " La Troncal",
           "enabled": 1
         },
         {
           "id": 27,
           "id_province": 3,
           "name": " El Tambo",
           "enabled": 1
         },
         {
           "id": 28,
           "id_province": 3,
           "name": " Deleg",
           "enabled": 1
         },
         {
           "id": 29,
           "id_province": 3,
           "name": " Suscal",
           "enabled": 1
         },
         {
           "id": 30,
           "id_province": 4,
           "name": " Tulcán",
           "enabled": 1
         },
         {
           "id": 31,
           "id_province": 4,
           "name": " Bolívar",
           "enabled": 1
         },
         {
           "id": 32,
           "id_province": 4,
           "name": " Espejo",
           "enabled": 1
         },
         {
           "id": 33,
           "id_province": 4,
           "name": " Mira",
           "enabled": 1
         },
         {
           "id": 34,
           "id_province": 4,
           "name": " Montúfar",
           "enabled": 1
         },
         {
           "id": 35,
           "id_province": 4,
           "name": " San Pedro de Huaca",
           "enabled": 1
         },
         {
           "id": 36,
           "id_province": 5,
           "name": " Latacunga",
           "enabled": 1
         },
         {
           "id": 37,
           "id_province": 5,
           "name": " La Maná",
           "enabled": 1
         },
         {
           "id": 38,
           "id_province": 5,
           "name": " Pangua",
           "enabled": 1
         },
         {
           "id": 39,
           "id_province": 5,
           "name": " Pujilí",
           "enabled": 1
         },
         {
           "id": 40,
           "id_province": 5,
           "name": " Salcedo",
           "enabled": 1
         },
         {
           "id": 41,
           "id_province": 5,
           "name": " Saquisilí",
           "enabled": 1
         },
         {
           "id": 42,
           "id_province": 5,
           "name": " Sigchos",
           "enabled": 1
         },
         {
           "id": 43,
           "id_province": 6,
           "name": " Riobamba",
           "enabled": 1
         },
         {
           "id": 44,
           "id_province": 6,
           "name": " Alausí",
           "enabled": 1
         },
         {
           "id": 45,
           "id_province": 6,
           "name": " Colta",
           "enabled": 1
         },
         {
           "id": 46,
           "id_province": 6,
           "name": " Chambo",
           "enabled": 1
         },
         {
           "id": 47,
           "id_province": 6,
           "name": " Chunchi",
           "enabled": 1
         },
         {
           "id": 48,
           "id_province": 6,
           "name": " Guamote",
           "enabled": 1
         },
         {
           "id": 49,
           "id_province": 6,
           "name": " Guano",
           "enabled": 1
         },
         {
           "id": 50,
           "id_province": 6,
           "name": " Pallatanga",
           "enabled": 1
         },
         {
           "id": 51,
           "id_province": 6,
           "name": " Penipe",
           "enabled": 1
         },
         {
           "id": 52,
           "id_province": 6,
           "name": " Cumandá",
           "enabled": 1
         },
         {
           "id": 53,
           "id_province": 7,
           "name": " Machala",
           "enabled": 1
         },
         {
           "id": 54,
           "id_province": 7,
           "name": " Arenillas",
           "enabled": 1
         },
         {
           "id": 55,
           "id_province": 7,
           "name": " Atahualpa",
           "enabled": 1
         },
         {
           "id": 56,
           "id_province": 7,
           "name": " Balsas",
           "enabled": 1
         },
         {
           "id": 57,
           "id_province": 7,
           "name": " Chilla",
           "enabled": 1
         },
         {
           "id": 58,
           "id_province": 7,
           "name": " El Guabo",
           "enabled": 1
         },
         {
           "id": 59,
           "id_province": 7,
           "name": " Huaquillas",
           "enabled": 1
         },
         {
           "id": 60,
           "id_province": 7,
           "name": " Marcabelí",
           "enabled": 1
         },
         {
           "id": 61,
           "id_province": 7,
           "name": " Pasaje",
           "enabled": 1
         },
         {
           "id": 62,
           "id_province": 7,
           "name": " Piñas",
           "enabled": 1
         },
         {
           "id": 63,
           "id_province": 7,
           "name": " Portovelo",
           "enabled": 1
         },
         {
           "id": 64,
           "id_province": 7,
           "name": " Santa Rosa",
           "enabled": 1
         },
         {
           "id": 65,
           "id_province": 7,
           "name": " Zaruma",
           "enabled": 1
         },
         {
           "id": 66,
           "id_province": 7,
           "name": " Las Lajas",
           "enabled": 1
         },
         {
           "id": 67,
           "id_province": 8,
           "name": " Esmeraldas",
           "enabled": 1
         },
         {
           "id": 68,
           "id_province": 8,
           "name": " Eloy Alfaro",
           "enabled": 1
         },
         {
           "id": 69,
           "id_province": 8,
           "name": " Muisne",
           "enabled": 1
         },
         {
           "id": 70,
           "id_province": 8,
           "name": " Quininde",
           "enabled": 1
         },
         {
           "id": 71,
           "id_province": 8,
           "name": " San Lorenzo",
           "enabled": 1
         },
         {
           "id": 72,
           "id_province": 8,
           "name": " Atacames",
           "enabled": 1
         },
         {
           "id": 73,
           "id_province": 8,
           "name": " Rioverde",
           "enabled": 1
         },
         {
           "id": 74,
           "id_province": 8,
           "name": " La Concordia",
           "enabled": 1
         },
         {
           "id": 75,
           "id_province": 9,
           "name": " Guayaquil",
           "enabled": 1
         },
         {
           "id": 76,
           "id_province": 9,
           "name": " Alfredo Baquerizo Moreno Juján",
           "enabled": 1
         },
         {
           "id": 77,
           "id_province": 9,
           "name": " Balao",
           "enabled": 1
         },
         {
           "id": 78,
           "id_province": 9,
           "name": " Balzar",
           "enabled": 1
         },
         {
           "id": 79,
           "id_province": 9,
           "name": " Colimes",
           "enabled": 1
         },
         {
           "id": 80,
           "id_province": 9,
           "name": " Daule",
           "enabled": 1
         },
         {
           "id": 81,
           "id_province": 9,
           "name": " Durán",
           "enabled": 1
         },
         {
           "id": 82,
           "id_province": 9,
           "name": " El Empalme",
           "enabled": 1
         },
         {
           "id": 83,
           "id_province": 9,
           "name": " El Triunfo",
           "enabled": 1
         },
         {
           "id": 84,
           "id_province": 9,
           "name": " Milagro",
           "enabled": 1
         },
         {
           "id": 85,
           "id_province": 9,
           "name": " Naranjal",
           "enabled": 1
         },
         {
           "id": 86,
           "id_province": 9,
           "name": " Naranjito",
           "enabled": 1
         },
         {
           "id": 87,
           "id_province": 9,
           "name": " Palestina",
           "enabled": 1
         },
         {
           "id": 88,
           "id_province": 9,
           "name": " Pedro Carbo",
           "enabled": 1
         },
         {
           "id": 89,
           "id_province": 9,
           "name": " Samborondón",
           "enabled": 1
         },
         {
           "id": 90,
           "id_province": 9,
           "name": " Santa Lucía",
           "enabled": 1
         },
         {
           "id": 91,
           "id_province": 9,
           "name": " Salitre Urbina Jado",
           "enabled": 1
         },
         {
           "id": 92,
           "id_province": 9,
           "name": " San Jacinto de Yaguachi",
           "enabled": 1
         },
         {
           "id": 93,
           "id_province": 9,
           "name": " Playas",
           "enabled": 1
         },
         {
           "id": 94,
           "id_province": 9,
           "name": " Simón Bolívar",
           "enabled": 1
         },
         {
           "id": 95,
           "id_province": 9,
           "name": " Coronel Marcelino Maridueña",
           "enabled": 1
         },
         {
           "id": 96,
           "id_province": 9,
           "name": " Lomas de Sargentillo",
           "enabled": 1
         },
         {
           "id": 97,
           "id_province": 9,
           "name": " Nobol",
           "enabled": 1
         },
         {
           "id": 98,
           "id_province": 9,
           "name": " General Antonio Elizalde Bucay",
           "enabled": 1
         },
         {
           "id": 99,
           "id_province": 9,
           "name": " Isidro Ayora",
           "enabled": 1
         },
         {
           "id": 100,
           "id_province": 10,
           "name": " Ibarra",
           "enabled": 1
         },
         {
           "id": 101,
           "id_province": 10,
           "name": " Antonio Ante",
           "enabled": 1
         },
         {
           "id": 102,
           "id_province": 10,
           "name": " Cotacachi",
           "enabled": 1
         },
         {
           "id": 103,
           "id_province": 10,
           "name": " Otavalo",
           "enabled": 1
         },
         {
           "id": 104,
           "id_province": 10,
           "name": " Pimampiro",
           "enabled": 1
         },
         {
           "id": 105,
           "id_province": 10,
           "name": " San Miguel de Urcuquí",
           "enabled": 1
         },
         {
           "id": 106,
           "id_province": 11,
           "name": " Loja",
           "enabled": 1
         },
         {
           "id": 107,
           "id_province": 11,
           "name": " Calvas",
           "enabled": 1
         },
         {
           "id": 108,
           "id_province": 11,
           "name": " Catamayo",
           "enabled": 1
         },
         {
           "id": 109,
           "id_province": 11,
           "name": " Celica",
           "enabled": 1
         },
         {
           "id": 110,
           "id_province": 11,
           "name": " Chaguarpamba",
           "enabled": 1
         },
         {
           "id": 111,
           "id_province": 11,
           "name": " Espíndola",
           "enabled": 1
         },
         {
           "id": 112,
           "id_province": 11,
           "name": " Gonzanamá",
           "enabled": 1
         },
         {
           "id": 113,
           "id_province": 11,
           "name": " Macará",
           "enabled": 1
         },
         {
           "id": 114,
           "id_province": 11,
           "name": " Paltas",
           "enabled": 1
         },
         {
           "id": 115,
           "id_province": 11,
           "name": " Puyango",
           "enabled": 1
         },
         {
           "id": 116,
           "id_province": 11,
           "name": " Saraguro",
           "enabled": 1
         },
         {
           "id": 117,
           "id_province": 11,
           "name": " Sozoranga",
           "enabled": 1
         },
         {
           "id": 118,
           "id_province": 11,
           "name": " Zapotillo",
           "enabled": 1
         },
         {
           "id": 119,
           "id_province": 11,
           "name": " Pindal",
           "enabled": 1
         },
         {
           "id": 120,
           "id_province": 11,
           "name": " Quilanga",
           "enabled": 1
         },
         {
           "id": 121,
           "id_province": 11,
           "name": " Olmedo",
           "enabled": 1
         },
         {
           "id": 122,
           "id_province": 12,
           "name": " Babahoyo",
           "enabled": 1
         },
         {
           "id": 123,
           "id_province": 12,
           "name": " Baba",
           "enabled": 1
         },
         {
           "id": 124,
           "id_province": 12,
           "name": " Montalvo",
           "enabled": 1
         },
         {
           "id": 125,
           "id_province": 12,
           "name": " Puebloviejo",
           "enabled": 1
         },
         {
           "id": 126,
           "id_province": 12,
           "name": " Quevedo",
           "enabled": 1
         },
         {
           "id": 127,
           "id_province": 12,
           "name": " Urdaneta",
           "enabled": 1
         },
         {
           "id": 128,
           "id_province": 12,
           "name": " Ventanas",
           "enabled": 1
         },
         {
           "id": 129,
           "id_province": 12,
           "name": " Vinces",
           "enabled": 1
         },
         {
           "id": 130,
           "id_province": 12,
           "name": " Palanque",
           "enabled": 1
         },
         {
           "id": 131,
           "id_province": 12,
           "name": " Buena Fe",
           "enabled": 1
         },
         {
           "id": 132,
           "id_province": 12,
           "name": " Valencia",
           "enabled": 1
         },
         {
           "id": 133,
           "id_province": 12,
           "name": " Mocache",
           "enabled": 1
         },
         {
           "id": 134,
           "id_province": 12,
           "name": " Quinsaloma",
           "enabled": 1
         },
         {
           "id": 135,
           "id_province": 13,
           "name": " Portoviejo",
           "enabled": 1
         },
         {
           "id": 136,
           "id_province": 13,
           "name": " Bolívar",
           "enabled": 1
         },
         {
           "id": 137,
           "id_province": 13,
           "name": " Chone",
           "enabled": 1
         },
         {
           "id": 138,
           "id_province": 13,
           "name": " El Carmen",
           "enabled": 1
         },
         {
           "id": 139,
           "id_province": 13,
           "name": " Flavio Alfaro",
           "enabled": 1
         },
         {
           "id": 140,
           "id_province": 13,
           "name": " Jipijapa",
           "enabled": 1
         },
         {
           "id": 141,
           "id_province": 13,
           "name": " Junín",
           "enabled": 1
         },
         {
           "id": 142,
           "id_province": 13,
           "name": " Manta",
           "enabled": 1
         },
         {
           "id": 143,
           "id_province": 13,
           "name": " Montecristi",
           "enabled": 1
         },
         {
           "id": 144,
           "id_province": 13,
           "name": " Paján",
           "enabled": 1
         },
         {
           "id": 145,
           "id_province": 13,
           "name": " Pichincha",
           "enabled": 1
         },
         {
           "id": 146,
           "id_province": 13,
           "name": " Rocafuerte",
           "enabled": 1
         },
         {
           "id": 147,
           "id_province": 13,
           "name": " Santa Ana",
           "enabled": 1
         },
         {
           "id": 148,
           "id_province": 13,
           "name": " Sucre",
           "enabled": 1
         },
         {
           "id": 149,
           "id_province": 13,
           "name": " Tosagua",
           "enabled": 1
         },
         {
           "id": 150,
           "id_province": 13,
           "name": " 24 de Mayo",
           "enabled": 1
         },
         {
           "id": 151,
           "id_province": 13,
           "name": " Pedernales",
           "enabled": 1
         },
         {
           "id": 152,
           "id_province": 13,
           "name": " Olmedo",
           "enabled": 1
         },
         {
           "id": 153,
           "id_province": 13,
           "name": " Puerto López",
           "enabled": 1
         },
         {
           "id": 154,
           "id_province": 13,
           "name": " Jama",
           "enabled": 1
         },
         {
           "id": 155,
           "id_province": 13,
           "name": " Jaramijó",
           "enabled": 1
         },
         {
           "id": 156,
           "id_province": 13,
           "name": " San Vicente",
           "enabled": 1
         },
         {
           "id": 157,
           "id_province": 14,
           "name": " Morona",
           "enabled": 1
         },
         {
           "id": 158,
           "id_province": 14,
           "name": " Gualaquiza",
           "enabled": 1
         },
         {
           "id": 159,
           "id_province": 14,
           "name": " Limón Indanza",
           "enabled": 1
         },
         {
           "id": 160,
           "id_province": 14,
           "name": " Palora",
           "enabled": 1
         },
         {
           "id": 161,
           "id_province": 14,
           "name": " Santiago",
           "enabled": 1
         },
         {
           "id": 162,
           "id_province": 14,
           "name": " Sucúa",
           "enabled": 1
         },
         {
           "id": 163,
           "id_province": 14,
           "name": " Huamboya",
           "enabled": 1
         },
         {
           "id": 164,
           "id_province": 14,
           "name": " San Juan Bosco",
           "enabled": 1
         },
         {
           "id": 165,
           "id_province": 14,
           "name": " Taisha",
           "enabled": 1
         },
         {
           "id": 166,
           "id_province": 14,
           "name": " Logroño",
           "enabled": 1
         },
         {
           "id": 167,
           "id_province": 14,
           "name": " Pablo Sexto",
           "enabled": 1
         },
         {
           "id": 168,
           "id_province": 14,
           "name": " Tiwintza",
           "enabled": 1
         },
         {
           "id": 169,
           "id_province": 15,
           "name": " Tena",
           "enabled": 1
         },
         {
           "id": 170,
           "id_province": 15,
           "name": " Archidona",
           "enabled": 1
         },
         {
           "id": 171,
           "id_province": 15,
           "name": " El Chaco",
           "enabled": 1
         },
         {
           "id": 172,
           "id_province": 15,
           "name": " Quijos",
           "enabled": 1
         },
         {
           "id": 173,
           "id_province": 15,
           "name": " Carlos Julio Arosemena Tola",
           "enabled": 1
         },
         {
           "id": 174,
           "id_province": 16,
           "name": " Pastaza",
           "enabled": 1
         },
         {
           "id": 175,
           "id_province": 16,
           "name": " Mera",
           "enabled": 1
         },
         {
           "id": 176,
           "id_province": 16,
           "name": " Santa Clara",
           "enabled": 1
         },
         {
           "id": 177,
           "id_province": 16,
           "name": " Arajuno",
           "enabled": 1
         },
         {
           "id": 178,
           "id_province": 17,
           "name": " Quito",
           "enabled": 1
         },
         {
           "id": 179,
           "id_province": 17,
           "name": " Cayambe",
           "enabled": 1
         },
         {
           "id": 180,
           "id_province": 17,
           "name": " Mejía",
           "enabled": 1
         },
         {
           "id": 181,
           "id_province": 17,
           "name": " Pedro Moncayo",
           "enabled": 1
         },
         {
           "id": 182,
           "id_province": 17,
           "name": " Rumiñahui",
           "enabled": 1
         },
         {
           "id": 183,
           "id_province": 17,
           "name": " San Miguel de los Bancos",
           "enabled": 1
         },
         {
           "id": 184,
           "id_province": 17,
           "name": " Pedro Vicente Maldonado",
           "enabled": 1
         },
         {
           "id": 185,
           "id_province": 17,
           "name": " Puerto Quito",
           "enabled": 1
         },
         {
           "id": 186,
           "id_province": 18,
           "name": " Ambato",
           "enabled": 1
         },
         {
           "id": 187,
           "id_province": 18,
           "name": " Baños de Agua Santa",
           "enabled": 1
         },
         {
           "id": 188,
           "id_province": 18,
           "name": " Cevallos",
           "enabled": 1
         },
         {
           "id": 189,
           "id_province": 18,
           "name": " Mocha",
           "enabled": 1
         },
         {
           "id": 190,
           "id_province": 18,
           "name": " Patate",
           "enabled": 1
         },
         {
           "id": 191,
           "id_province": 18,
           "name": " Quero",
           "enabled": 1
         },
         {
           "id": 192,
           "id_province": 18,
           "name": " San Pedro de Pelileo",
           "enabled": 1
         },
         {
           "id": 193,
           "id_province": 18,
           "name": " Santiago de Píllaro",
           "enabled": 1
         },
         {
           "id": 194,
           "id_province": 18,
           "name": " Tisaleo",
           "enabled": 1
         },
         {
           "id": 195,
           "id_province": 19,
           "name": " Zamora",
           "enabled": 1
         },
         {
           "id": 196,
           "id_province": 19,
           "name": " Chinchipe",
           "enabled": 1
         },
         {
           "id": 197,
           "id_province": 19,
           "name": " Nangaritza",
           "enabled": 1
         },
         {
           "id": 198,
           "id_province": 19,
           "name": " Yacuambi",
           "enabled": 1
         },
         {
           "id": 199,
           "id_province": 19,
           "name": " Yantzaza",
           "enabled": 1
         },
         {
           "id": 200,
           "id_province": 19,
           "name": " El Pangui",
           "enabled": 1
         },
         {
           "id": 201,
           "id_province": 19,
           "name": " Centinela del Cóndor",
           "enabled": 1
         },
         {
           "id": 202,
           "id_province": 19,
           "name": " Palanda",
           "enabled": 1
         },
         {
           "id": 203,
           "id_province": 19,
           "name": " Paquisha",
           "enabled": 1
         },
         {
           "id": 204,
           "id_province": 20,
           "name": " San Cristóbal",
           "enabled": 1
         },
         {
           "id": 205,
           "id_province": 20,
           "name": " Isabela",
           "enabled": 1
         },
         {
           "id": 206,
           "id_province": 20,
           "name": " Santa Cruz",
           "enabled": 1
         },
         {
           "id": 207,
           "id_province": 21,
           "name": " Lago Agrio",
           "enabled": 1
         },
         {
           "id": 208,
           "id_province": 21,
           "name": " Gonzalo Pizarro",
           "enabled": 1
         },
         {
           "id": 209,
           "id_province": 21,
           "name": " Putumayo",
           "enabled": 1
         },
         {
           "id": 210,
           "id_province": 21,
           "name": " Shushufindi",
           "enabled": 1
         },
         {
           "id": 211,
           "id_province": 21,
           "name": " Sucumbíos",
           "enabled": 1
         },
         {
           "id": 212,
           "id_province": 21,
           "name": " Cascales",
           "enabled": 1
         },
         {
           "id": 213,
           "id_province": 21,
           "name": " Cuyabeno",
           "enabled": 1
         },
         {
           "id": 214,
           "id_province": 22,
           "name": " Orellana",
           "enabled": 1
         },
         {
           "id": 215,
           "id_province": 22,
           "name": " Aguarico",
           "enabled": 1
         },
         {
           "id": 216,
           "id_province": 22,
           "name": " La Joya de los Sachas",
           "enabled": 1
         },
         {
           "id": 217,
           "id_province": 22,
           "name": " Loreto",
           "enabled": 1
         },
         {
           "id": 218,
           "id_province": 23,
           "name": " Santo Domingo",
           "enabled": 1
         },
         {
           "id": 219,
           "id_province": 24,
           "name": " Santa Elena",
           "enabled": 1
         },
         {
           "id": 220,
           "id_province": 24,
           "name": " La Libertad",
           "enabled": 1
         },
         {
           "id": 221,
           "id_province": 24,
           "name": " Salinas",
           "enabled": 1
         },
         {
           "id": 222,
           "id_province": 25,
           "name": " Las Golondrinas",
           "enabled": 1
         },
         {
           "id": 223,
           "id_province": 25,
           "name": " La Concordia",
           "enabled": 1
         },
         {
           "id": 224,
           "id_province": 25,
           "name": " Manga del Cura",
           "enabled": 1
         },
         {
           "id": 225,
           "id_province": 25,
           "name": " El Piedrero",
           "enabled": 1
         }
        ]'
        );

        foreach ($cantonJson as $data){
            Canton::create([
                'id' => $data->id,
                'province_id' => $data->id_province,
                'name' => $data->name,
                'enabled' => $data->enabled
            ]);
        }
    }
}