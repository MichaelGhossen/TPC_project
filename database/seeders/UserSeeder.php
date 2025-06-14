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

        User::updateOrCreate(
            ['email' => 'michael@gmail.com'],
            [
                'name' => 'Michael',
                'password' => Hash::make('michael123'),
                'phone' => '0999999999',
                'user_role' => 'admin',
                'flag' => true,
            ]
        );

        // 🟨 Accountant
        User::updateOrCreate(
            ['email' => 'layth@gmail.com'],
            [
                'name' => 'Layth',
                'password' => Hash::make('layth123'),
                'phone' => '0988888888',
                'user_role' => 'accountant',
                'flag' => true,
            ]
        );

        // 🟦 Warehouse Keeper
        User::updateOrCreate(
            ['email' => 'ameer@gmail.com'],
            [
                'name' => 'Ameer',
                'password' => Hash::make('ameer123'),
                'phone' => '0977777777',
                'user_role' => 'warehouse_keeper',
                'flag' => true,
            ]
        );
    }
}
