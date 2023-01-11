<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
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

        $this->call(RoleSeeder::class);
        $user = User::create([
            'name' => 'Admin',
            'email' => 'demo@admin.com',
            'password' => Hash::make(12345689),
            'type' => 2

        ]);
        $user->assignRole("admin");

    }
}
