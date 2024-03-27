<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => "Administrateur", 'slug' => "administrateur", 'nbRsp' => '&nbtsd!?']);

        Role::create(['name' => "Publicateur d' articles", 'slug' => "publicateur-d-articles", 'nbRsp' => '&nbrsp?!']);

        Role::create(['name' => "Visiteur", 'slug' => "visiteur", 'nbRsp' => '&nbdfpo@!']);
    }
}
