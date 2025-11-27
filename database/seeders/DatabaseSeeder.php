<?php

namespace Database\Seeders;

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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::updateOrCreate(
            ['email' => 'vortech@vortech.com'], // cek kalau sudah ada email ini
            [
                'card_number' => '00000001',
                'name'        => 'Admin Vortech',
                'class'       => 'Admin',
                'telephone'   => '082225662984',
                'is_admin'    => true,
                'password'    => bcrypt('1234'),
            ]
        );
    }
}
