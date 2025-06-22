<?php

namespace Database\Seeders;

use App\Models\RawMaterialBatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawMaterialBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RawMaterialBatch::insert([
            [
                'user_id' => 1,
                'raw_material_id' => 2,
                'quantity_in' => 100,
                'quantity_out' => 0,
                'quantity_remaining' => 100,
                'real_cost' => 250.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of polyethylene',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 1,
                'quantity_in' => 200,
                'quantity_out' => 50,
                'quantity_remaining' => 150,
                'real_cost' => 400.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Second batch of polypropylene',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
