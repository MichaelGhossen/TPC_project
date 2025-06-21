<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Plastic Bottle',
                'description' => 'Durable 500ml plastic bottle',
                'price' => 10.50,
                'category' => 'finished',
                'weight_per_unit' => 0.2,
                'minimum_stock_alert' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plastic Cap',
                'description' => 'Semi-finished cap for sealing bottles',
                'price' => 2.00,
                'category' => 'semi_finished',
                'weight_per_unit' => 0.05,
                'minimum_stock_alert' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bottle Label',
                'description' => 'Printed label for branding bottles',
                'price' => 1.25,
                'category' => 'semi_finished',
                'weight_per_unit' => 0.01,
                'minimum_stock_alert' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
