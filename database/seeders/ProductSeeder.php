<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name_id' => 3,
            'category' => 'factory',
            'quantity' => 200,
            'price' => 55.00,
            'real_cost' => 45.00,
            'estimated_cost' => 48.00,
            'bom' => [1, 2], // قائمة المواد الخام
            'production_date' => now(),
            'user_id' => 1
        ]);

        Product::create([
            'name_id' => 4,
            'category' => 'half_factory',
            'quantity' => 150,
            'price' => 35.00,
            'real_cost' => 28.00,
            'estimated_cost' => 30.00,
            'bom' => [2],
            'production_date' => now(),
            'user_id' => 1
        ]);
    }
}
