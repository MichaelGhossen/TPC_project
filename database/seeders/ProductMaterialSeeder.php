<?php

namespace Database\Seeders;

use App\Models\ProductMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductMaterial::insert([
            [
                'product_id' => 1,
                'raw_material_id' => 2,
                'quantity_required_per_unit' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'raw_material_id' => 3,
                'quantity_required_per_unit' => 0.75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'raw_material_id' => 2,
                'quantity_required_per_unit' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
