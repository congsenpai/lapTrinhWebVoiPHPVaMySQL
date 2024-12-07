<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Factories;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(UserSeeder::class); 
    }
}
