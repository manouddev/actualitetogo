<?php

namespace Database\Seeders;

use App\Models\InfosMonthYear;
use App\Models\InfosMonthYearTags;
use App\Models\Tags;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 8 ; $i++){

            //Exporter les Tags 01
            $tags = Http::get('https://www.togoactualite.com/wp-json/wp/v2/tags?per_page=100&page='.$i)->json();

            foreach ($tags as  $value) {

                $date = Carbon::parse(now());

                $mois_id = $date->format('m');

                $year = $date->format('Y');

                $mois = InfosMonthYear::where('visible', 1)->where('month_id', $mois_id)->first();

                $date_name = $mois->month.' '.$year;

                $verify_date_name = InfosMonthYearTags::where('visible', 1)->where('date_name', $date_name)->first();

                if(!$verify_date_name){

                    InfosMonthYearTags::create(['date_name' => $date_name]);

                }

                $post =  Tags::create([
                    'name' =>  $value['name'],
                    'date_name' => $date_name,
                    'slug' => $value['slug'],
                    'count_publications' => 0,
                    'date_publish' =>  now(),
                    'wp_tag_id' => intval($value['id']),
                ]);

            }

        }
    }
}
