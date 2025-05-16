<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RawMaterial;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            RawMaterial::create([
                'name_id' => 1,
                'status' => 'used',
                'quantity' => 100,
                'price' => 25.00,
                'real_cost' => 26.00,
                'estimated_cost' => 24.50,
                'added_date' => now(),
                'user_id' => 1
            ]);

            RawMaterial::create([
                'name_id' => 2,
                'status' => 'unused',
                'quantity' => 50,
                'price' => 15.00,
                'real_cost' => 15.50,
                'estimated_cost' => 14.80,
                'added_date' => now(),
                'user_id' => 1
            ]);
        }
    }

