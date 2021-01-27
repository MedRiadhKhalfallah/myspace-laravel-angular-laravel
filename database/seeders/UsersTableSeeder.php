<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $admin */
        $admin = User::create([
            'nom' => 'mohamed Riadh',
            'prenom' => 'khalfallah',
            'telephone' => '26678826',
            'email' => 'mrk19933@gmail.com',
            'password' => 'riadh123'
        ]);

        /** @var User $admin */
        $auteur = User::create([
            'nom' => 'ameni',
            'prenom' => 'meddeb',
            'telephone' => '26678826',
            'email' => 'meddebameni@gmail.com',
            'password' => 'ameni123'
        ]);

        /** @var User $admin */
        $utilisateur = User::create([
            'nom' => 'client',
            'prenom' => 'client',
            'telephone' => '26678826',
            'email' => 'med.riadh.khalfallah@gmail.com',
            'password' => 'client123'
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $auteurRole = Role::where('name', 'auteur')->first();
        $utilisateurRole = Role::where('name', 'utilisateur')->first();
        $admin_societe = Role::where('name', 'admin_societe')->first();

        $admin->roles()->attach($adminRole);
        $auteur->roles()->attach($auteurRole);
        $auteur->roles()->attach($adminRole);
        $utilisateur->roles()->attach($utilisateurRole);
        $utilisateur->roles()->attach($admin_societe);
    }
}
