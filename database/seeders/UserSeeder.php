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

         // 🟩 Admin: Michael
         User::create([
            'name' => 'Michael',
            'email' => 'michael@gmail.com',
            'password' => Hash::make('michael123'),
            'phone' => '0999999999',
            'user_role' => 'admin',
            'flag' => true,
        ]);

        // 🟨 Accountant
        User::create([
            'name' => 'Layth',
            'email' => 'layth@gmail.com',
            'password' => Hash::make('layth123'),
            'phone' => '0988888888',
            'user_role' => 'accountant',
            'flag' => true,
        ]);

        // 🟦 Warehouse Keeper
        User::create([
            'name' => 'Ameer',
            'email' => 'ameer@gmail.com',
            'password' => Hash::make('ameer123'),
            'phone' => '0977777777',
            'user_role' => 'warehouse_keeper',
            'flag' => true,
        ]);

    }
}
