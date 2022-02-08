<?php

namespace Database\Seeders;

use App\Models\Partie;
use App\Models\TypeElection;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $admin = User::create([
            "name"         =>"admin",
            "email"        =>"admin@gmail.com",
            "password"     =>Hash::make("admin@gmail.com"),
            "role"         =>"admin"
        ]);

        $candidat = User::create([
            "name"         =>"candidat",
            "email"        =>"candidat@gmail.com",
            "password"     =>Hash::make("candidat@gmail.com"),
            "role"         =>"candidat"
        ]);

        $typeElection1 = TypeElection::create([
            'name' => "National",
        ]);
        $typeElection2 = TypeElection::create([
            'name' => "Régionale",
        ]);
        $libre = Partie::create([
            'name'  => "Libre",
            'email' => '----------',
            'phone' => '----------',
            'image' => '----------',
            'description' => '----------', 
        ]);
      
    }
}
