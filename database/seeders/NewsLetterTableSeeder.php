<?php

namespace Database\Seeders;

use App\Models\NewsLetter;
use Illuminate\Database\Seeder;

class NewsLetterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $news_letters =[ 
            [
                
                'email' => 'manouadjanor@gmail.com',
                'slug' => str_replace(' ', '-', 'manouadjanor@gmail.com'),
                'status' => 1, 
            ],

            [
                
                'email' => 'nonojack@yahoo.fr',
                'slug' => str_replace(' ', '-', 'nonojack@yahoo.fr'),
                'status' => 1, 
            ]
        ];

        foreach ($news_letters as $news_letter) {

           NewsLetter::create($news_letter);
           
        }
    }
}
