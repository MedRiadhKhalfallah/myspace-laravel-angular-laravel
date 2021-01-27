<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'admin','guard_name'=>'api']);
        Role::create(['name'=>'utilisateur','guard_name'=>'api']);
        Role::create(['name'=>'auteur','guard_name'=>'api']);
        Role::create(['name'=>'admin_societe','guard_name'=>'api']);
    }
}
