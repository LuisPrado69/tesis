<?php

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
           "name": "CONCIERTO BASCA",
           "description": "CONCIERTO POR LAS FIESTAS DE QUITO",
           "date": "2020/07/11",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7126&nombreEvento=BASCA&ciudad=Quito_",
           "category_id": 9,
           "location_id": 1
         },
         {
           "name": "FESTIVAL DE CUMBIA Y CHICHA",
           "description": "FESTIVAL DE CUMBIA Y CHICHA",
           "date": "2020/07/18",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7148&nombreEvento=FESTIVAL_DE_CUMBIA_Y_CHICHA&ciudad=Guayaquil",
           "category_id": 9,
           "location_id": 2
         },
         {
           "name": "ONCE SENTIDOS",
           "description": "ONCE SENTIDOS",
           "date": "2020/07/20",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7150&nombreEvento=ONCE_SENTIDOS_&ciudad=Cali",
           "category_id": 9,
           "location_id": 3
         },
         {
           "name": "VAN MOZART - CONCIERTO",
           "description": "VAN MOZART - CONCIERTO",
           "date": "2020/07/25",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7099&nombreEvento=VAN_MOZART_-_CONCIERTO_VIRTUAL&ciudad=Guayaquil",
           "category_id": 9,
           "location_id": 4
         },
         {
           "name": "SUMMER ARTS",
           "description": "SUMMER ARTS",
           "date": "2020/07/08",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7147&nombreEvento=SUMMER_ARTS_&ciudad=Quito_",
           "category_id": 2,
           "location_id": 5
         },
         {
           "name": "CIRCUITO ATLÉTICO NUESTROS HÉROES",
           "description": "CIRCUITO ATLÉTICO NUESTROS HÉROES",
           "date": "2020/07/26",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7120&nombreEvento=CIRCUITO_ATL%C3%89TICO_NUESTROS_H%C3%89ROES_5K_VIRTUAL_EDICI%C3%93N_ESPECIAL&ciudad=Quito_",
           "category_id": 2,
           "location_id": 1
         },
         {
           "name": "Taller de felicidad productiva: Mantenerse Motivado en tiempos de pandemia",
           "description": "Taller de felicidad productiva: Mantenerse Motivado en tiempos de pandemia",
           "date": "2020/07/07",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7142&nombreEvento=Taller_de_felicidad_productiva:_Mantenerse_Motivado_en_tiempos_de_pandemia&ciudad=Guayaquil",
           "category_id": 2,
           "location_id": 2
         },
         {
           "name": "EL MUERTO AL HOYO, EL VIVO AL POLLO",
           "description": "EL MUERTO AL HOYO, EL VIVO AL POLLO",
           "date": "2020/07/10",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7123&nombreEvento=EL_MUERTO_AL_HOYO,_EL_VIVO_AL_POLLO&ciudad=Guayaquil",
           "category_id": 10,
           "location_id": 3
         },
         {
           "name": "¿Y SI FUERAMOS VIEJITAS?",
           "description": "¿Y SI FUERAMOS VIEJITAS?",
           "date": "2020/07/10",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7135&nombreEvento=%C2%BFY_SI_FUERAMOS_VIEJITAS?_10_DE_JULIO&ciudad=Guayaquil",
           "category_id": 10,
           "location_id": 4
         },
         {
           "name": "EL PRIMER BAR ONLINE - LA VECINA SIN CENSURA",
           "description": "EL PRIMER BAR ONLINE - LA VECINA SIN CENSURA",
           "date": "2020/07/10",
           "date_start": "2020/01/01",
           "date_end": "2020/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7146&nombreEvento=EL_PRIMER_BAR_ONLINE_-_LA_VECINA_SIN_CENSURA&ciudad=Guayaquil",
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
    }
}