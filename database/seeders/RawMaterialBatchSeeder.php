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
            // Material 1 (Entries 1-3)
            [
                'user_id' => 1,
                'raw_material_id' => 1,
                'quantity_in' => 100, // 0 + 100
                'quantity_out' => 0,
                'quantity_remaining' => 100,
                'real_cost' => 100.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 1',
                'created_at' => '2025-01-01 10:00:00',
                'updated_at' => '2025-01-01 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 1,
                'quantity_in' => 150, // 10 + 140
                'quantity_out' => 10,
                'quantity_remaining' => 140,
                'real_cost' => 50.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 1',
                'created_at' => '2025-01-11 10:00:00',
                'updated_at' => '2025-01-11 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 1,
                'quantity_in' => 170, // 5 + 165
                'quantity_out' => 5,
                'quantity_remaining' => 165,
                'real_cost' => 30.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 1',
                'created_at' => '2025-01-21 10:00:00',
                'updated_at' => '2025-01-21 10:00:00'
            ],

            // Material 2 (Entries 4-6)
            [
                'user_id' => 2,
                'raw_material_id' => 2,
                'quantity_in' => 110, // 0 + 110
                'quantity_out' => 0,
                'quantity_remaining' => 110,
                'real_cost' => 121.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 2',
                'created_at' => '2025-01-04 10:00:00',
                'updated_at' => '2025-01-04 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 2,
                'quantity_in' => 160, // 10 + 150
                'quantity_out' => 10,
                'quantity_remaining' => 150,
                'real_cost' => 55.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 2',
                'created_at' => '2025-01-14 10:00:00',
                'updated_at' => '2025-01-14 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 2,
                'quantity_in' => 180, // 5 + 175
                'quantity_out' => 5,
                'quantity_remaining' => 175,
                'real_cost' => 33.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 2',
                'created_at' => '2025-01-24 10:00:00',
                'updated_at' => '2025-01-24 10:00:00'
            ],

            // Material 3 (Entries 7-9)
            [
                'user_id' => 3,
                'raw_material_id' => 3,
                'quantity_in' => 120, // 0 + 120
                'quantity_out' => 0,
                'quantity_remaining' => 120,
                'real_cost' => 144.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 3',
                'created_at' => '2025-01-07 10:00:00',
                'updated_at' => '2025-01-07 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 3,
                'quantity_in' => 170, // 10 + 160
                'quantity_out' => 10,
                'quantity_remaining' => 160,
                'real_cost' => 60.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 3',
                'created_at' => '2025-01-17 10:00:00',
                'updated_at' => '2025-01-17 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 3,
                'quantity_in' => 190, // 5 + 185
                'quantity_out' => 5,
                'quantity_remaining' => 185,
                'real_cost' => 36.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 3',
                'created_at' => '2025-01-27 10:00:00',
                'updated_at' => '2025-01-27 10:00:00'
            ],

            // Material 4 (Entries 10-12)
            [
                'user_id' => 1,
                'raw_material_id' => 4,
                'quantity_in' => 130, // 0 + 130
                'quantity_out' => 0,
                'quantity_remaining' => 130,
                'real_cost' => 169.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 4',
                'created_at' => '2025-01-10 10:00:00',
                'updated_at' => '2025-01-10 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 4,
                'quantity_in' => 180, // 10 + 170
                'quantity_out' => 10,
                'quantity_remaining' => 170,
                'real_cost' => 65.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 4',
                'created_at' => '2025-01-20 10:00:00',
                'updated_at' => '2025-01-20 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 4,
                'quantity_in' => 200, // 5 + 195
                'quantity_out' => 5,
                'quantity_remaining' => 195,
                'real_cost' => 39.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 4',
                'created_at' => '2025-01-30 10:00:00',
                'updated_at' => '2025-01-30 10:00:00'
            ],

            // Material 5 (Entries 13-15)
            [
                'user_id' => 2,
                'raw_material_id' => 5,
                'quantity_in' => 140, // 0 + 140
                'quantity_out' => 0,
                'quantity_remaining' => 140,
                'real_cost' => 196.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 5',
                'created_at' => '2025-01-13 10:00:00',
                'updated_at' => '2025-01-13 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 5,
                'quantity_in' => 190, // 10 + 180
                'quantity_out' => 10,
                'quantity_remaining' => 180,
                'real_cost' => 70.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 5',
                'created_at' => '2025-01-23 10:00:00',
                'updated_at' => '2025-01-23 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 5,
                'quantity_in' => 210, // 5 + 205
                'quantity_out' => 5,
                'quantity_remaining' => 205,
                'real_cost' => 42.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 5',
                'created_at' => '2025-02-02 10:00:00',
                'updated_at' => '2025-02-02 10:00:00'
            ],

            // Material 6 (Entries 16-18)
            [
                'user_id' => 3,
                'raw_material_id' => 6,
                'quantity_in' => 150, // 0 + 150
                'quantity_out' => 0,
                'quantity_remaining' => 150,
                'real_cost' => 225.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 6',
                'created_at' => '2025-01-16 10:00:00',
                'updated_at' => '2025-01-16 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 6,
                'quantity_in' => 200, // 10 + 190
                'quantity_out' => 10,
                'quantity_remaining' => 190,
                'real_cost' => 75.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 6',
                'created_at' => '2025-01-26 10:00:00',
                'updated_at' => '2025-01-26 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 6,
                'quantity_in' => 220, // 5 + 215
                'quantity_out' => 5,
                'quantity_remaining' => 215,
                'real_cost' => 45.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 6',
                'created_at' => '2025-02-05 10:00:00',
                'updated_at' => '2025-02-05 10:00:00'
            ],

            // Material 7 (Entries 19-21)
            [
                'user_id' => 1,
                'raw_material_id' => 7,
                'quantity_in' => 160, // 0 + 160
                'quantity_out' => 0,
                'quantity_remaining' => 160,
                'real_cost' => 256.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 7',
                'created_at' => '2025-01-19 10:00:00',
                'updated_at' => '2025-01-19 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 7,
                'quantity_in' => 210, // 10 + 200
                'quantity_out' => 10,
                'quantity_remaining' => 200,
                'real_cost' => 80.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 7',
                'created_at' => '2025-01-29 10:00:00',
                'updated_at' => '2025-01-29 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 7,
                'quantity_in' => 230, // 5 + 225
                'quantity_out' => 5,
                'quantity_remaining' => 225,
                'real_cost' => 48.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 7',
                'created_at' => '2025-02-08 10:00:00',
                'updated_at' => '2025-02-08 10:00:00'
            ],

            // Material 8 (Entries 22-24)
            [
                'user_id' => 2,
                'raw_material_id' => 8,
                'quantity_in' => 170, // 0 + 170
                'quantity_out' => 0,
                'quantity_remaining' => 170,
                'real_cost' => 289.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 8',
                'created_at' => '2025-01-22 10:00:00',
                'updated_at' => '2025-01-22 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 8,
                'quantity_in' => 220, // 10 + 210
                'quantity_out' => 10,
                'quantity_remaining' => 210,
                'real_cost' => 85.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 8',
                'created_at' => '2025-02-01 10:00:00',
                'updated_at' => '2025-02-01 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 8,
                'quantity_in' => 240, // 5 + 235
                'quantity_out' => 5,
                'quantity_remaining' => 235,
                'real_cost' => 51.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 8',
                'created_at' => '2025-02-11 10:00:00',
                'updated_at' => '2025-02-11 10:00:00'
            ],

            // Material 9 (Entries 25-27)
            [
                'user_id' => 3,
                'raw_material_id' => 9,
                'quantity_in' => 180, // 0 + 180
                'quantity_out' => 0,
                'quantity_remaining' => 180,
                'real_cost' => 324.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 9',
                'created_at' => '2025-01-25 10:00:00',
                'updated_at' => '2025-01-25 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 9,
                'quantity_in' => 230, // 10 + 220
                'quantity_out' => 10,
                'quantity_remaining' => 220,
                'real_cost' => 90.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 9',
                'created_at' => '2025-02-04 10:00:00',
                'updated_at' => '2025-02-04 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 9,
                'quantity_in' => 250, // 5 + 245
                'quantity_out' => 5,
                'quantity_remaining' => 245,
                'real_cost' => 54.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 9',
                'created_at' => '2025-02-14 10:00:00',
                'updated_at' => '2025-02-14 10:00:00'
            ],

            // Material 10 (Entries 28-30)
            [
                'user_id' => 1,
                'raw_material_id' => 10,
                'quantity_in' => 190, // 0 + 190
                'quantity_out' => 0,
                'quantity_remaining' => 190,
                'real_cost' => 361.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 10',
                'created_at' => '2025-01-28 10:00:00',
                'updated_at' => '2025-01-28 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 10,
                'quantity_in' => 240, // 10 + 230
                'quantity_out' => 10,
                'quantity_remaining' => 230,
                'real_cost' => 95.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 10',
                'created_at' => '2025-02-07 10:00:00',
                'updated_at' => '2025-02-07 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 10,
                'quantity_in' => 260, // 5 + 255
                'quantity_out' => 5,
                'quantity_remaining' => 255,
                'real_cost' => 57.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 10',
                'created_at' => '2025-02-17 10:00:00',
                'updated_at' => '2025-02-17 10:00:00'
            ],

            // Material 11 (Entries 31-33)
            [
                'user_id' => 2,
                'raw_material_id' => 11,
                'quantity_in' => 200, // 0 + 200
                'quantity_out' => 0,
                'quantity_remaining' => 200,
                'real_cost' => 400.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 11',
                'created_at' => '2025-01-31 10:00:00',
                'updated_at' => '2025-01-31 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 11,
                'quantity_in' => 250, // 10 + 240
                'quantity_out' => 10,
                'quantity_remaining' => 240,
                'real_cost' => 100.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 11',
                'created_at' => '2025-02-10 10:00:00',
                'updated_at' => '2025-02-10 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 11,
                'quantity_in' => 270, // 5 + 265
                'quantity_out' => 5,
                'quantity_remaining' => 265,
                'real_cost' => 60.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 11',
                'created_at' => '2025-02-20 10:00:00',
                'updated_at' => '2025-02-20 10:00:00'
            ],

            // Material 12 (Entries 34-36)
            [
                'user_id' => 3,
                'raw_material_id' => 12,
                'quantity_in' => 210, // 0 + 210
                'quantity_out' => 0,
                'quantity_remaining' => 210,
                'real_cost' => 441.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 12',
                'created_at' => '2025-02-03 10:00:00',
                'updated_at' => '2025-02-03 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 12,
                'quantity_in' => 260, // 10 + 250
                'quantity_out' => 10,
                'quantity_remaining' => 250,
                'real_cost' => 105.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 12',
                'created_at' => '2025-02-13 10:00:00',
                'updated_at' => '2025-02-13 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 12,
                'quantity_in' => 280, // 5 + 275
                'quantity_out' => 5,
                'quantity_remaining' => 275,
                'real_cost' => 63.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 12',
                'created_at' => '2025-02-23 10:00:00',
                'updated_at' => '2025-02-23 10:00:00'
            ],

            // Material 13 (Entries 37-39)
            [
                'user_id' => 1,
                'raw_material_id' => 13,
                'quantity_in' => 220, // 0 + 220
                'quantity_out' => 0,
                'quantity_remaining' => 220,
                'real_cost' => 484.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 13',
                'created_at' => '2025-02-06 10:00:00',
                'updated_at' => '2025-02-06 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 13,
                'quantity_in' => 270, // 10 + 260
                'quantity_out' => 10,
                'quantity_remaining' => 260,
                'real_cost' => 110.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 13',
                'created_at' => '2025-02-16 10:00:00',
                'updated_at' => '2025-02-16 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 13,
                'quantity_in' => 290, // 5 + 285
                'quantity_out' => 5,
                'quantity_remaining' => 285,
                'real_cost' => 66.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 13',
                'created_at' => '2025-02-26 10:00:00',
                'updated_at' => '2025-02-26 10:00:00'
            ],

            // Material 14 (Entries 40-42)
            [
                'user_id' => 2,
                'raw_material_id' => 14,
                'quantity_in' => 230, // 0 + 230
                'quantity_out' => 0,
                'quantity_remaining' => 230,
                'real_cost' => 529.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 14',
                'created_at' => '2025-02-09 10:00:00',
                'updated_at' => '2025-02-09 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 14,
                'quantity_in' => 280, // 10 + 270
                'quantity_out' => 10,
                'quantity_remaining' => 270,
                'real_cost' => 115.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 14',
                'created_at' => '2025-02-19 10:00:00',
                'updated_at' => '2025-02-19 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 14,
                'quantity_in' => 300, // 5 + 295
                'quantity_out' => 5,
                'quantity_remaining' => 295,
                'real_cost' => 69.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 14',
                'created_at' => '2025-03-01 10:00:00',
                'updated_at' => '2025-03-01 10:00:00'
            ],

            // Material 15 (Entries 43-45)
            [
                'user_id' => 3,
                'raw_material_id' => 15,
                'quantity_in' => 240, // 0 + 240
                'quantity_out' => 0,
                'quantity_remaining' => 240,
                'real_cost' => 576.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 15',
                'created_at' => '2025-02-12 10:00:00',
                'updated_at' => '2025-02-12 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 15,
                'quantity_in' => 290, // 10 + 280
                'quantity_out' => 10,
                'quantity_remaining' => 280,
                'real_cost' => 120.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 15',
                'created_at' => '2025-02-22 10:00:00',
                'updated_at' => '2025-02-22 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 15,
                'quantity_in' => 310, // 5 + 305
                'quantity_out' => 5,
                'quantity_remaining' => 305,
                'real_cost' => 72.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 15',
                'created_at' => '2025-03-04 10:00:00',
                'updated_at' => '2025-03-04 10:00:00'
            ],

            // Material 16 (Entries 46-48)
            [
                'user_id' => 1,
                'raw_material_id' => 16,
                'quantity_in' => 250, // 0 + 250
                'quantity_out' => 0,
                'quantity_remaining' => 250,
                'real_cost' => 625.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 16',
                'created_at' => '2025-02-15 10:00:00',
                'updated_at' => '2025-02-15 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 16,
                'quantity_in' => 300, // 10 + 290
                'quantity_out' => 10,
                'quantity_remaining' => 290,
                'real_cost' => 125.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 16',
                'created_at' => '2025-02-25 10:00:00',
                'updated_at' => '2025-02-25 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 16,
                'quantity_in' => 320, // 5 + 315
                'quantity_out' => 5,
                'quantity_remaining' => 315,
                'real_cost' => 75.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 16',
                'created_at' => '2025-03-07 10:00:00',
                'updated_at' => '2025-03-07 10:00:00'
            ],

            // Material 17 (Entries 49-51)
            [
                'user_id' => 2,
                'raw_material_id' => 17,
                'quantity_in' => 260, // 0 + 260
                'quantity_out' => 0,
                'quantity_remaining' => 260,
                'real_cost' => 676.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 17',
                'created_at' => '2025-02-18 10:00:00',
                'updated_at' => '2025-02-18 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 17,
                'quantity_in' => 310, // 10 + 300
                'quantity_out' => 10,
                'quantity_remaining' => 300,
                'real_cost' => 130.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 17',
                'created_at' => '2025-02-28 10:00:00',
                'updated_at' => '2025-02-28 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 17,
                'quantity_in' => 330, // 5 + 325
                'quantity_out' => 5,
                'quantity_remaining' => 325,
                'real_cost' => 78.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 17',
                'created_at' => '2025-03-10 10:00:00',
                'updated_at' => '2025-03-10 10:00:00'
            ],

            // Material 18 (Entries 52-54)
            [
                'user_id' => 3,
                'raw_material_id' => 18,
                'quantity_in' => 270, // 0 + 270
                'quantity_out' => 0,
                'quantity_remaining' => 270,
                'real_cost' => 729.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 18',
                'created_at' => '2025-02-21 10:00:00',
                'updated_at' => '2025-02-21 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 18,
                'quantity_in' => 320, // 10 + 310
                'quantity_out' => 10,
                'quantity_remaining' => 310,
                'real_cost' => 135.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 18',
                'created_at' => '2025-03-03 10:00:00',
                'updated_at' => '2025-03-03 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 18,
                'quantity_in' => 340, // 5 + 335
                'quantity_out' => 5,
                'quantity_remaining' => 335,
                'real_cost' => 81.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 18',
                'created_at' => '2025-03-13 10:00:00',
                'updated_at' => '2025-03-13 10:00:00'
            ],

            // Material 19 (Entries 55-57)
            [
                'user_id' => 1,
                'raw_material_id' => 19,
                'quantity_in' => 280, // 0 + 280
                'quantity_out' => 0,
                'quantity_remaining' => 280,
                'real_cost' => 784.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 19',
                'created_at' => '2025-02-24 10:00:00',
                'updated_at' => '2025-02-24 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 19,
                'quantity_in' => 330, // 10 + 320
                'quantity_out' => 10,
                'quantity_remaining' => 320,
                'real_cost' => 140.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 19',
                'created_at' => '2025-03-06 10:00:00',
                'updated_at' => '2025-03-06 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 19,
                'quantity_in' => 350, // 5 + 345
                'quantity_out' => 5,
                'quantity_remaining' => 345,
                'real_cost' => 84.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 19',
                'created_at' => '2025-03-16 10:00:00',
                'updated_at' => '2025-03-16 10:00:00'
            ],

            // Material 20 (Entries 58-60)
            [
                'user_id' => 2,
                'raw_material_id' => 20,
                'quantity_in' => 290, // 0 + 290
                'quantity_out' => 0,
                'quantity_remaining' => 290,
                'real_cost' => 841.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 20',
                'created_at' => '2025-02-27 10:00:00',
                'updated_at' => '2025-02-27 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 20,
                'quantity_in' => 340, // 10 + 330
                'quantity_out' => 10,
                'quantity_remaining' => 330,
                'real_cost' => 145.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 20',
                'created_at' => '2025-03-09 10:00:00',
                'updated_at' => '2025-03-09 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 20,
                'quantity_in' => 360, // 5 + 355
                'quantity_out' => 5,
                'quantity_remaining' => 355,
                'real_cost' => 87.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 20',
                'created_at' => '2025-03-19 10:00:00',
                'updated_at' => '2025-03-19 10:00:00'
            ],

            // Material 21 (Entries 61-63)
            [
                'user_id' => 3,
                'raw_material_id' => 21,
                'quantity_in' => 300, // 0 + 300
                'quantity_out' => 0,
                'quantity_remaining' => 300,
                'real_cost' => 900.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 21',
                'created_at' => '2025-03-02 10:00:00',
                'updated_at' => '2025-03-02 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 21,
                'quantity_in' => 350, // 10 + 340
                'quantity_out' => 10,
                'quantity_remaining' => 340,
                'real_cost' => 150.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 21',
                'created_at' => '2025-03-12 10:00:00',
                'updated_at' => '2025-03-12 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 21,
                'quantity_in' => 370, // 5 + 365
                'quantity_out' => 5,
                'quantity_remaining' => 365,
                'real_cost' => 90.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 21',
                'created_at' => '2025-03-22 10:00:00',
                'updated_at' => '2025-03-22 10:00:00'
            ],

            // Material 22 (Entries 64-66)
            [
                'user_id' => 1,
                'raw_material_id' => 22,
                'quantity_in' => 200, // 0 + 200
                'quantity_out' => 0,
                'quantity_remaining' => 200,
                'real_cost' => 440.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 22',
                'created_at' => '2025-03-05 10:00:00',
                'updated_at' => '2025-03-05 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 22,
                'quantity_in' => 250, // 10 + 240
                'quantity_out' => 10,
                'quantity_remaining' => 240,
                'real_cost' => 110.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 22',
                'created_at' => '2025-03-15 10:00:00',
                'updated_at' => '2025-03-15 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 22,
                'quantity_in' => 270, // 5 + 265
                'quantity_out' => 5,
                'quantity_remaining' => 265,
                'real_cost' => 66.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 22',
                'created_at' => '2025-03-25 10:00:00',
                'updated_at' => '2025-03-25 10:00:00'
            ],

            // Material 23 (Entries 67-69)
            [
                'user_id' => 2,
                'raw_material_id' => 23,
                'quantity_in' => 210, // 0 + 210
                'quantity_out' => 0,
                'quantity_remaining' => 210,
                'real_cost' => 462.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 23',
                'created_at' => '2025-03-08 10:00:00',
                'updated_at' => '2025-03-08 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 23,
                'quantity_in' => 260, // 10 + 250
                'quantity_out' => 10,
                'quantity_remaining' => 250,
                'real_cost' => 110.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 23',
                'created_at' => '2025-03-18 10:00:00',
                'updated_at' => '2025-03-18 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 23,
                'quantity_in' => 280, // 5 + 275
                'quantity_out' => 5,
                'quantity_remaining' => 275,
                'real_cost' => 66.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 23',
                'created_at' => '2025-03-28 10:00:00',
                'updated_at' => '2025-03-28 10:00:00'
            ],

            // Material 24 (Entries 70-72)
            [
                'user_id' => 3,
                'raw_material_id' => 24,
                'quantity_in' => 220, // 0 + 220
                'quantity_out' => 0,
                'quantity_remaining' => 220,
                'real_cost' => 484.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 24',
                'created_at' => '2025-03-11 10:00:00',
                'updated_at' => '2025-03-11 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 24,
                'quantity_in' => 270, // 10 + 260
                'quantity_out' => 10,
                'quantity_remaining' => 260,
                'real_cost' => 110.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 24',
                'created_at' => '2025-03-21 10:00:00',
                'updated_at' => '2025-03-21 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 24,
                'quantity_in' => 290, // 5 + 285
                'quantity_out' => 5,
                'quantity_remaining' => 285,
                'real_cost' => 66.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 24',
                'created_at' => '2025-03-31 10:00:00',
                'updated_at' => '2025-03-31 10:00:00'
            ],

            // Material 25 (Entries 73-75)
            [
                'user_id' => 1,
                'raw_material_id' => 25,
                'quantity_in' => 230, // 0 + 230
                'quantity_out' => 0,
                'quantity_remaining' => 230,
                'real_cost' => 506.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 25',
                'created_at' => '2025-03-14 10:00:00',
                'updated_at' => '2025-03-14 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 25,
                'quantity_in' => 280, // 10 + 270
                'quantity_out' => 10,
                'quantity_remaining' => 270,
                'real_cost' => 110.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 25',
                'created_at' => '2025-03-24 10:00:00',
                'updated_at' => '2025-03-24 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 25,
                'quantity_in' => 300, // 5 + 295
                'quantity_out' => 5,
                'quantity_remaining' => 295,
                'real_cost' => 66.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 25',
                'created_at' => '2025-04-03 10:00:00',
                'updated_at' => '2025-04-03 10:00:00'
            ],

            // Material 26 (Entries 76-78)
            [
                'user_id' => 2,
                'raw_material_id' => 26,
                'quantity_in' => 240, // 0 + 240
                'quantity_out' => 0,
                'quantity_remaining' => 240,
                'real_cost' => 528.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 26',
                'created_at' => '2025-03-17 10:00:00',
                'updated_at' => '2025-03-17 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 26,
                'quantity_in' => 290, // 10 + 280
                'quantity_out' => 10,
                'quantity_remaining' => 280,
                'real_cost' => 110.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 26',
                'created_at' => '2025-03-27 10:00:00',
                'updated_at' => '2025-03-27 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 26,
                'quantity_in' => 310, // 5 + 305
                'quantity_out' => 5,
                'quantity_remaining' => 305,
                'real_cost' => 66.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 26',
                'created_at' => '2025-04-06 10:00:00',
                'updated_at' => '2025-04-06 10:00:00'
            ],

            // Material 27 (Entries 79-81)
            [
                'user_id' => 3,
                'raw_material_id' => 27,
                'quantity_in' => 250, // 0 + 250
                'quantity_out' => 0,
                'quantity_remaining' => 250,
                'real_cost' => 550.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 27',
                'created_at' => '2025-03-20 10:00:00',
                'updated_at' => '2025-03-20 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 27,
                'quantity_in' => 300, // 10 + 290
                'quantity_out' => 10,
                'quantity_remaining' => 290,
                'real_cost' => 110.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 27',
                'created_at' => '2025-03-30 10:00:00',
                'updated_at' => '2025-03-30 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 27,
                'quantity_in' => 320, // 5 + 315
                'quantity_out' => 5,
                'quantity_remaining' => 315,
                'real_cost' => 66.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 27',
                'created_at' => '2025-04-09 10:00:00',
                'updated_at' => '2025-04-09 10:00:00'
            ],

            // Material 28 (Entries 82-84)
            [
                'user_id' => 1,
                'raw_material_id' => 28,
                'quantity_in' => 260, // 0 + 260
                'quantity_out' => 0,
                'quantity_remaining' => 260,
                'real_cost' => 572.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Initial batch of raw material 28',
                'created_at' => '2025-03-23 10:00:00',
                'updated_at' => '2025-03-23 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 28,
                'quantity_in' => 310, // 10 + 300
                'quantity_out' => 10,
                'quantity_remaining' => 300,
                'real_cost' => 110.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Replenishment order for raw material 28',
                'created_at' => '2025-04-02 10:00:00',
                'updated_at' => '2025-04-02 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 28,
                'quantity_in' => 330, // 5 + 325
                'quantity_out' => 5,
                'quantity_remaining' => 325,
                'real_cost' => 66.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Additional supply of raw material 28',
                'created_at' => '2025-04-12 10:00:00',
                'updated_at' => '2025-04-12 10:00:00'
            ],

            // Material 29 (Entries 85-87)
            [
                'user_id' => 2,
                'raw_material_id' => 29,
                'quantity_in' => 270, // 0 + 270
                'quantity_out' => 0,
                'quantity_remaining' => 270,
                'real_cost' => 594.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Initial batch of raw material 29',
                'created_at' => '2025-03-26 10:00:00',
                'updated_at' => '2025-03-26 10:00:00'
            ],
            [
                'user_id' => 3,
                'raw_material_id' => 29,
                'quantity_in' => 320, // 10 + 310
                'quantity_out' => 10,
                'quantity_remaining' => 310,
                'real_cost' => 110.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Replenishment order for raw material 29',
                'created_at' => '2025-04-05 10:00:00',
                'updated_at' => '2025-04-05 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 29,
                'quantity_in' => 340, // 5 + 335
                'quantity_out' => 5,
                'quantity_remaining' => 335,
                'real_cost' => 66.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Additional supply of raw material 29',
                'created_at' => '2025-04-15 10:00:00',
                'updated_at' => '2025-04-15 10:00:00'
            ],

            // Material 30 (Entries 88-90)
            [
                'user_id' => 3,
                'raw_material_id' => 30,
                'quantity_in' => 280, // 0 + 280
                'quantity_out' => 0,
                'quantity_remaining' => 280,
                'real_cost' => 616.00,
                'payment_method' => 'credit card',
                'supplier' => 'Global Materials',
                'notes' => 'Initial batch of raw material 30',
                'created_at' => '2025-03-29 10:00:00',
                'updated_at' => '2025-03-29 10:00:00'
            ],
            [
                'user_id' => 1,
                'raw_material_id' => 30,
                'quantity_in' => 330, // 10 + 320
                'quantity_out' => 10,
                'quantity_remaining' => 320,
                'real_cost' => 110.00,
                'payment_method' => 'cash',
                'supplier' => 'Al Maha Co.',
                'notes' => 'Replenishment order for raw material 30',
                'created_at' => '2025-04-08 10:00:00',
                'updated_at' => '2025-04-08 10:00:00'
            ],
            [
                'user_id' => 2,
                'raw_material_id' => 30,
                'quantity_in' => 350, // 5 + 345
                'quantity_out' => 5,
                'quantity_remaining' => 345,
                'real_cost' => 66.00,
                'payment_method' => 'bank transfer',
                'supplier' => 'RawMat Supply Ltd.',
                'notes' => 'Additional supply of raw material 30',
                'created_at' => '2025-04-18 10:00:00',
                'updated_at' => '2025-04-18 10:00:00'
            ]
        ]);
    }
}
