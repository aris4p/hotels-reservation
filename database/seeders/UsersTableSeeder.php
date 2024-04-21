<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Aris',
            'email' => 'arisanggara72@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        Pelanggan::factory()->count(10)->create();

    }
}
