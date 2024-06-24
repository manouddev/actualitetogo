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
                'wp_author_id' => 1,
                'user_id' => 1,
                'date_publish' =>  now(),
                'description' => "<p>
                    Nous tenons à rappeler aux visiteurs du site que
                    sans partenariat avec togoactualite.com, la reprise des articles même partielle est strictement interdite.
                    Tout contrevenant s'expose à de graves poursuites.
                </p>"
            ], // 1
            [
                'nom' => 'MIKANDO',
                'prenoms' => 'Eric',
                'nom_complet' => 'MIKANDO Eric',
                'email' => 'ericmakondo@gmail.com',
                'telephone' => '+228 91 91 91 91',
                'authorName' => 'dutogoactu',
                'slug' => 'dutogoactu',
                'wp_author_id' => 2,
                'user_id' => 1,
                'date_publish' =>  now(),
                'description' => "<p>
                    Nous tenons à rappeler aux visiteurs du site que
                    sans partenariat avec togoactualite.com, la reprise des articles même partielle est strictement interdite.
                    Tout contrevenant s'expose à de graves poursuites.
                </p>"
            ], // 0
        ];

        foreach ($datas as $data){
           Author::create($data);
        }
    }
}
