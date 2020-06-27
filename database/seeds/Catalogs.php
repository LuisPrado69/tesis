<?php

use Illuminate\Database\Seeder;
use App\Models\Business\Category;
use App\Models\Business\Location;

class Catalogs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category
        $categoryJson = json_decode('[    
         {
           "id": 1,
           "name": "CHARLAS"
         },
         {
           "id": 2,
           "name": "CINE"      
         },
         {
           "id": 3,
           "name": "CONVOCATORIAS"
         },
         {
           "id": 4,
           "name": "CULTURA EN CASA"
         },
         {
           "id": 5,
           "name": "DANZA"
         },
         {
           "id": 6,
           "name": "DEPORTE"
         },
         {
           "id": 7,
           "name": "ENTRADA LIBRE"
         },
         {
           "id": 8,
           "name": "EXPOSICIONES"
         },
         {
           "id": 9,
           "name": "FERIAS"
         },
         {
           "id": 10,
           "name": " LA MARISCAL"
         },
         {
           "id": 11,
           "name": "LITERATURA"
         },
         {
           "id": 12,
           "name": "MUSEOS"
         },
         {
           "id": 13,
           "name": "MÚSICA"
         },
         {
           "id": 14,
           "name": "NIÑOS"
         },
         {
           "id": 15,
           "name": "PATRIMONIO"
         },
         {
           "id": 16,
           "name": "TALLER"
         },
         {
           "id": 17,
           "name": "TEATRO"
         }
        ]'
        );
        foreach ($categoryJson as $data) {
            Category::create([
                'id' => $data->id,
                'name' => $data->name
            ]);
        }

        // Location
        $locationJson = json_decode('[    
         {
           "id": 1,
           "name": "ESTADIO OLIMPICO ATAHUALPA",
           "latitude": "-0.177854",
           "longitude": "-78.476393"
         },
         {
           "id": 2,
           "name": "COLISEO GRAL RUMIÑAHUI",     
           "latitude": "-0.213505", 
           "longitude": "-78.490096"     
         },
         {
           "id": 3,
           "name": "CASA DE LA CULTURA ECUATORIANA - BENJAMÍN CARRIÓN",
           "latitude": "-0.210054",
           "longitude": "-78.495470"
         },
         {
           "id": 4,
           "name": "PLAZA DE TOROS QUITO",
           "latitude": "-0.163235",
           "longitude": "-78.483939"
         },
         {
           "id": 5,
           "name": "TRIBUNA DE LOS SHYRIS",
           "latitude": "-0.182651",
           "longitude": "-78.482284"
         }
        ]'
        );
        foreach ($locationJson as $data) {
            Location::create([
                'id' => $data->id,
                'name' => $data->name,
                'latitude' => $data->latitude,
                'longitude' => $data->longitude
            ]);
        }
    }
}