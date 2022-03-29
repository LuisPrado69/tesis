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
         },
         {
           "id": 11,
           "name": "SEMINARIOS/ CONGRESOS"
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
           "name": "ROCKSTALGIA",
           "description": "ROCKSTALGIA",
           "date": "2022/04/29 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsism.aspx?evento=7755&nombreEvento=Rockstalgia&ciudad=Quito",
           "category_id": 9,
           "location_id": 1
         },
         {
           "name": "IL DIVO",
           "description": "IL DIVO - GREATES HITS TOUR",
           "date": "2022/05/03 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsism.aspx?evento=7747&nombreEvento=IL_DIVO_-_Greates_Hits_Tour&ciudad=Quito_",
           "category_id": 9,
           "location_id": 2
         },
         {
           "name": "RICARDO MONTANER",
           "description": "RICARDO MONTANER",
           "date": "2022/05/27 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsism.aspx?evento=7030&nombreEvento=Ricardo_Montaner_QUITO&ciudad=Quito_",
           "category_id": 9,
           "location_id": 3
         },
         {
           "name": "ANDRÉS CEPEDA",
           "description": "ANDRÉS CEPEDA",
           "date": "2022/05/13 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7703&nombreEvento=Andr%C3%A9s_Cepeda&ciudad=Quito_",
           "category_id": 9,
           "location_id": 4
         },
         {
           "name": "EL JOKER",
           "description": "EL JOKER",
           "date": "2022/04/22 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7739&nombreEvento=El_Joker&ciudad=Quito",
           "category_id": 9,
           "location_id": 5
         },
         {
           "name": "SERVANDO Y FLORENTINO",
           "description": "SERVANDO Y FLORENTINO",
           "date": "2022/05/13 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsism.aspx?evento=7733&nombreEvento=Servando_y_Florentino&ciudad=Quito_",
           "category_id": 9,
           "location_id": 1
         },
         {
           "name": "CARLOS VIVES",
           "description": "CARLOS VIVES QUITO",
           "date": "2022/01/10 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsism.aspx?evento=7757&nombreEvento=Carlos_Vives_QUITO&ciudad=Quito_",
           "category_id": 9,
           "location_id": 3
         },
         {
           "name": "UIO FESTIVAL DE LA CULTURA ERÓTICA",
           "description": "UIO FESTIVAL DE LA CULTURA ERÓTICA",
           "date": "2022/04/08 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/pages/synopsis.aspx?evento=7700&nombreEvento=UIO_Festival_de_la_Cultura_Er%C3%B3tica&ciudad=Quito_",
           "category_id": 9,
           "location_id": 4
         },
         {
           "name": "LAST MUSIC FESTIVAL",
           "description": "LAST MUSIC FESTIVAL 2021",
           "date": "2022/05/21 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7679&nombreEvento=LAST_Music_Festival_2021&ciudad=Quito",
           "category_id": 9,
           "location_id": 4
         },
         {
           "name": "JORNADA INTERNACIONAL DE TEORÍA DE LAS RESTRICCIONES",
           "description": "JORNADA INTERNACIONAL DE TEORÍA DE LAS RESTRICCIONES TOC QUITO",
           "date": "2022/05/22 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/pages/inscripciones.aspx?evento=7760&nombreEvento=Jornada_Internacional_De_Teoria_De_Las_Restricciones_Toc_QUITO&ciudad=Quito_",
           "category_id": 11,
           "location_id": 4
         },
         {
           "name": "2DO CONGRESO INTERNACIONAL DE MEDICINA INTERNA",
           "description": "2DO CONGRESO INTERNACIONAL DE MEDICINA INTERNA Y MANEJO DEL PACIENTE CRÍTICO FUNESALUD 2022",
           "date": "2022/05/12 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7750&nombreEvento=2do_Congreso_internacional_de_medicina_interna_y_manejo_del_paciente_cr%C3%ADtico__%22Funesalud_2022%E2%80%9D&ciudad=Quito",
           "category_id": 11,
           "location_id": 4
         },
         {
           "name": "CONGRESO PANAMERICANO DE FLEBOLOGIA",
           "description": "CONGRESO PANAMERICANO DE FLEBOLOGIA",
           "date": "2022/07/16 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7719&nombreEvento=Congreso_Panamericano_de_Flebologia&ciudad=quito",
           "category_id": 11,
           "location_id": 4
         },
         {
           "name": "XVII DE REUMATOLOGÍA Y REHABILITACIÓN CERER",
           "description": "XVII DE REUMATOLOGÍA Y REHABILITACIÓN CERER",
           "date": "2022/06/30 16:00:00",
           "date_start": "2022/01/01",
           "date_end": "2022/12/31",
           "url": "https://www.ticketshow.com.ec/rps/synopsis.aspx?evento=7758&nombreEvento=XVII_de_Reumatolog%C3%ADa_y_Rehabilitaci%C3%B3n_Cerer&ciudad=Quito",
           "category_id": 11,
           "location_id": 4
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
           "category_id": 9,
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
           "category_id": 9,
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
           "category_id": 9,
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