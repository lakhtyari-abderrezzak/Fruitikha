<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'username' => 'Abdo',
            'email' => 'lakhtyari.abderrazzak@gmail.com',
            'password' => bcrypt('123'),
            'status' => 'admin'
        ]);
    }
}
