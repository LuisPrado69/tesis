<?php

use App\Models\Business\CategoryUser;
use App\Models\Business\Category;
use App\Models\Business\Location;
use Illuminate\Database\Seeder;
use App\Models\Business\Events;

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
           "name": "CINE"
         },
         {
           "id": 2,
           "name": "CULTURA EN CASA"
         },
         {
           "id": 3,
           "name": "DANZA"
         },
         {
           "id": 4,
           "name": "DEPORTE"
         },
         {
           "id": 5,
           "name": "EXPOSICIONES"
         },
         {
           "id": 6,
           "name": "FERIAS"
         },
         {
           "id": 7,
           "name": "LITERATURA"
         },
         {
           "id": 8,
           "name": "MUSEOS"
         },
         {
           "id": 9,
           "name": "MÚSICA"
         },
         {
           "id": 10,
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
        ]');
        foreach ($locationJson as $data) {
            Location::create([
                'id' => $data->id,
                'name' => $data->name,
                'latitude' => $data->latitude,
                'longitude' => $data->longitude
            ]);
        }

        // Events
        $eventsJson = json_decode('[    
         {
           "name": "CONCIERTO Katie Angel",
           "description": "Katie Angel EN VIVO ONLINE UN CONCIERTO INTIMO",
           "date": "2021/01/11 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7021&nombreEvento=Katie_Angel_Tour_Invencible_-_Quito&ciudad=Quito_",
           "category_id": 9,
           "location_id": 1
         },
         {
           "name": "CONCIERTO NACH + ZONA GANJAH",
           "description": "NACH + ZONA GANJAH DESDE CASA EN VIVO ONLINE UN CONCIERTO INTIMO",
           "date": "2021/01/13 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=6923&nombreEvento=NACH_+_ZONA_GANJAH_-_QUITO&ciudad=Quito_",
           "category_id": 9,
           "location_id": 2
         },
         {
           "name": "CONCIERTO LP",
           "description": "LP DESDE CASA EN VIVO ONLINE UN CONCIERTO INTIMO",
           "date": "2021/01/20 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=6884&nombreEvento=LP_-_QUITO&ciudad=Quito_",
           "category_id": 9,
           "location_id": 3
         },
         {
           "name": "CONCIERTO BARON ROJO",
           "description": "BARON ROJO EL ÚLTIMO VUELO DESDE CASA EN VIVO ONLINE UN CONCIERTO INTIMO",
           "date": "2021/01/06 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=6472&nombreEvento=BARON_ROJO_EL_ULTIMO_VUELO_-_QUITO&ciudad=Quito_",
           "category_id": 9,
           "location_id": 4
         },
         {
           "name": "SUMMER ARTS",
           "description": "SUMMER ARTS",
           "date": "2021/01/08 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7147&nombreEvento=SUMMER_ARTS_&ciudad=Quito_",
           "category_id": 2,
           "location_id": 5
         },
         {
           "name": "CONGRESO INTERNACIONAL CIENCIA DEL ÉXITO",
           "description": "CONGRESO INTERNACIONAL CIENCIA DEL ÉXITO PNL 2020",
           "date": "2021/01/01 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7097&nombreEvento=CONGRESO_INTERNACIONAL_CIENCIA_DEL_%C3%89XITO_PNL_2020&ciudad=Quito",
           "category_id": 2,
           "location_id": 1
         },
         {
           "name": "Empresas en Tiempo de Crisis",
           "description": "Comunicación Saludable Dentro de la Empresa en Tiempo de Crisis",
           "date": "2021/01/28 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7107&nombreEvento=Comunicaci%C3%B3n_Saludable_Dentro_de_la_Empresa_en_Tiempo_de_Crisis&ciudad=Quito",
           "category_id": 2,
           "location_id": 2
         },
         {
           "name": "EL MUERTO AL HOYO, EL VIVO AL POLLO",
           "description": "EL MUERTO AL HOYO, EL VIVO AL POLLO",
           "date": "2021/01/10 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7123&nombreEvento=EL_MUERTO_AL_HOYO,_EL_VIVO_AL_POLLO&ciudad=Quito",
           "category_id": 10,
           "location_id": 3
         },
         {
           "name": "¿Y SI FUERAMOS VIEJITAS?",
           "description": "¿Y SI FUERAMOS VIEJITAS?",
           "date": "2021/01/10 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7135&nombreEvento=%C2%BFY_SI_FUERAMOS_VIEJITAS?_10_DE_JULIO&ciudad=Quito",
           "category_id": 10,
           "location_id": 4
         },
         {
           "name": "EL PRIMER BAR ONLINE - LA VECINA SIN CENSURA",
           "description": "EL PRIMER BAR ONLINE - LA VECINA SIN CENSURA",
           "date": "2021/01/10 16:00:00",
           "date_start": "2021/01/01",
           "date_end": "2021/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7146&nombreEvento=EL_PRIMER_BAR_ONLINE_-_LA_VECINA_SIN_CENSURA&ciudad=Quito",
           "category_id": 10,
           "location_id": 5
         }
        ]');
        foreach ($eventsJson as $data) {
            Events::create([
                'name' => $data->name,
                'description' => $data->description,
                'date' => $data->date,
                'date_start' => $data->date_start,
                'date_end' => $data->date_end,
                'url' => $data->url,
                'category_id' => $data->category_id,
                'location_id' => $data->location_id
            ]);
        }

        // CategoryUser
        $categoryUserJson = json_decode('[    
         {
           "category_id": 1,
           "user_id": 4
         },
         {
           "category_id": 2,
           "user_id": 4
         },
         {
           "category_id": 3,
           "user_id": 4
         },
         {
           "category_id": 4,
           "user_id": 4
         },
         {
           "category_id": 10,
           "user_id": 4
         },
         {
           "category_id": 1,
           "user_id": 5
         },
         {
           "category_id": 2,
           "user_id": 5
         },
         {
           "category_id": 3,
           "user_id": 5
         },
         {
           "category_id": 4,
           "user_id": 5
         },
         {
           "category_id": 10,
           "user_id": 5
         },
         {
           "category_id": 1,
           "user_id": 6
         },
         {
           "category_id": 2,
           "user_id": 6
         },
         {
           "category_id": 3,
           "user_id": 6
         },
         {
           "category_id": 4,
           "user_id": 6
         },
         {
           "category_id": 10,
           "user_id": 6
         }
        ]');
        foreach ($categoryUserJson as $data) {
            CategoryUser::create([
                'category_id' => $data->category_id,
                'user_id' => $data->user_id
            ]);
        }
    }
}