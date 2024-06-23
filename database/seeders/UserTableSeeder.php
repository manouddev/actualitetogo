<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =[
            [
                'nom' => 'DENANYOH',
                'nom_complet' => 'Alexandre DENANYOH',
                'prenoms' => 'Alexandre',
                'telephone' => '+33 6 27 38 75 14',
                'est_auteur' => 1,
                'author_id' => 1,
                'username' => 'MawuwonamTG',
                'slug' => Str::slug('Alexandre DENANYOH'),
                'role_id' => 1,
                'status' => 1,
                'email' => 'nonojack@yahoo.fr',
                'password' =>  Hash::make('040567Ionos'),
            ],

            [
                'nom' => 'MIKANDO',
                'prenoms' => 'Eric',
                'nom_complet' => 'Eric MIKANDO',
                'telephone' => '+228 91 91 91 91',
                'est_auteur' => 1,
                'author_id' => 2,
                'username' => 'delomepub',
                'slug' => Str::slug('Eric MIKANDO'),
                'role_id' => 2,
                'status' => 1,
                'email' => 'ericmakondo@gmail.com',
                'password' =>  Hash::make('delomepub92'),
            ],

            [
                'nom' => 'ADJANOR',
                'prenoms' => 'Emmanuel',
                'nom_complet' => 'Emmanuel ADJANOR',
                'telephone' => '+228 92 92 92 92',
                'est_auteur' => 0,
                'username' => 'manoudev',
                'slug' => Str::slug('Emmanuel ADJANOR'),
                'role_id' => 3,
                'status' => 2,
                'email' => 'manouadjanor@gmail.com',
                'password' =>  Hash::make('manoudev7038'),
            ]
        ];

        foreach ($users as $user) {

           User::create($user);

        }
    }
}
