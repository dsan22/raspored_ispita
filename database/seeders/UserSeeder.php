<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "email"=>"user@email.com",
            "password"=>Hash::make('password'),
            "is_admin"=>0
        ]);
        User::factory()->create([
            "email"=>"admin@email.com",
            "password"=>Hash::make('password'),
            "is_admin"=>1
        ]);
        User::factory(10)->create();
    }
}
