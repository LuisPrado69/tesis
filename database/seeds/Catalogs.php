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
           "name": "Por que estoy sola, si soy un cuerazo?",
           "description": "POR QUE ESTOY SOLA, SI SOY UN CUERAZO?",
           "date": "2022/02/14 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7723&nombreEvento=Por_que_estoy_sola,_si_soy_un_cuerazo?&ciudad=Quito_",
           "category_id": 9,
           "location_id": 1
         },
         {
           "name": "FRANCO ESCAMILLA",
           "description": "PAYASO WORLD TOUR - QUITO",
           "date": "2022/02/20 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=6892&nombreEvento=FRANCO_ESCAMILLA_-_PAYASO_WORLD_TOUR_-_QUITO&ciudad=Quito_",
           "category_id": 9,
           "location_id": 2
         },
         {
           "name": "MASTER OF ROCK",
           "description": "MASTER OF ROCK - LOS MEJORES TRIBUTOS ROCKEROS DEL MUNDO",
           "date": "2022/04/30 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7721&nombreEvento=MASTER_OF_ROCK_-_LOS_MEJORES_TRIBUTOS_ROCKEROS_DEL_MUNDO_&ciudad=Quito_",
           "category_id": 9,
           "location_id": 3
         },
         {
           "name": "Andrés Cepeda",
           "description": "ANDRÉS CEPEDA",
           "date": "2022/04/13 16:00:00",
           "date_start": "2022/02/27",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7703&nombreEvento=Andr%C3%A9s_Cepeda&ciudad=Quito_",
           "category_id": 9,
           "location_id": 4
         },
         {
           "name": "Bronco",
           "description": "BRONCO - TOUR SE SOLTARON LOS CABALLOS",
           "date": "2022/03/04 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7720&nombreEvento=Bronco_-_Tour_Se_soltaron_los_caballos_&ciudad=Quito_",
           "category_id": 2,
           "location_id": 5
         },
         {
           "name": "MORAT",
           "description": "MORAT - QUITO",
           "date": "2022/03/10 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7705&nombreEvento=MORAT_-_QUITO_&ciudad=Quito_",
           "category_id": 2,
           "location_id": 1
         },
         {
           "name": "José Luis Perales",
           "description": "JOSÉ LUIS PERALES - BALADAS PARA UNA DESPEDIDA",
           "date": "2022/03/19 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7710&nombreEvento=Jos%C3%A9_Luis_Perales_-_Baladas_para_una_despedida&ciudad=Quito_",
           "category_id": 2,
           "location_id": 2
         },
         {
           "name": "Noche de Bohemia y guitarras",
           "description": "NOCHE DE BOHEMIA Y GUITARRAS",
           "date": "2022/01/10 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7718&nombreEvento=Noche_de_Bohemia_y_guitarras&ciudad=Quito_",
           "category_id": 10,
           "location_id": 3
         },
         {
           "name": "UIO Festival de la Cultura Erótica",
           "description": "UIO FESTIVAL DE LA CULTURA ERÓTICA",
           "date": "2022/04/08 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7700&nombreEvento=UIO_Festival_de_la_Cultura_Er%C3%B3tica&ciudad=Quito_",
           "category_id": 10,
           "location_id": 4
         },
         {
           "name": "Mega festival de Orquestas",
           "description": "MEGA FESTIVAL DE ORQUESTAS",
           "date": "2022/05/23 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/24",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7722&nombreEvento=Mega_festival_de_Orquestas&ciudad=Quito_",
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