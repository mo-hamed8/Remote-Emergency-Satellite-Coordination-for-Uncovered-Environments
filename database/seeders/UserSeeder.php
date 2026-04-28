<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hotel.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'user@hotel.com',
            'password' => Hash::make('12345678'),
        ]);

        User::factory(5)->create();
    }
}
