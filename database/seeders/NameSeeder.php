<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Name;

class NameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            ['name' => 'Plastic Roll', 'description' => 'Half-finished raw material', 'type' => 'raw'],
            ['name' => 'Nylon Bag', 'description' => 'Final product', 'type' => 'product'],
            ['name' => 'Ink', 'description' => 'Used in printing', 'type' => 'raw'],
            ['name' => 'Packaging Box', 'description' => 'Final packing product', 'type' => 'product'],
            ['name' => 'Adhesive Glue', 'description' => 'Used in sealing bags', 'type' => 'raw'],
        ];

        foreach ($names as $item) {
            Name::create($item);
        }

    }
}
