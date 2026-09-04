<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     $this->call([
           PermissionSeeder::class,
           RolePermissionSeeder::class,]); 

        User::create([
            'first_name' => 'Test User',
            'last_name' => 'Last Name',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1, 
            'phone' => '1234567890',
        ]);
    }
}
