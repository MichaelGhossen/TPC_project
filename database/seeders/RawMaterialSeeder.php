<?php

namespace Database\Seeders;

use App\Models\RawMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RawMaterial::insert([
            [
                'name' => 'Polyethylene',
                'description' => 'Used for packaging',
                'price' => 25.50,
                'status' => 'used',
                'minimum_stock_alert' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Polypropylene',
                'description' => 'Used in bottle caps',
                'price' => 30.00,
                'status' => 'unused',
                'minimum_stock_alert' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PVC',
                'description' => 'Used in pipes',
                'price' => 18.75,
                'status' => 'unused',
                'minimum_stock_alert' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

}
