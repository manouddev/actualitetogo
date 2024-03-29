<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'nom' => 'DENANYOH', 
                'prenoms' => 'Alexandre', 
                'nom_complet' => 'DENANYOH Alexandre',
                'email' => 'nonojack@yahoo.fr',
                'telephone' => '+33 6 27 38 75 14',
                'authorName' => 'Info du pays', 
                'slug' => 'info-du-pays', 
                'wp_author_id' => 1  
            ], // 1
            [
                'nom' => 'MIKANDO', 
                'prenoms' => 'Eric', 
                'nom_complet' => 'MIKANDO Eric',
                'email' => 'ericmakondo@gmail.com',
                'telephone' => '+228 91 91 91 91',
                'authorName' => 'dutogoactu', 
                'slug' => 'dutogoactu', 
                'wp_author_id' => 2 
            ], // 0

            [
                'nom' => 'ADJANOR', 
                'prenoms' => 'Emmanuel', 
                'nom_complet' => 'ADJANOR Emmanuel',
                'slug' => 'emmanuel', 
                'wp_author_id' => 3 
            ], // 0
        ];

        foreach ($datas as $data){
           Author::create($data);
        }
    }
}
