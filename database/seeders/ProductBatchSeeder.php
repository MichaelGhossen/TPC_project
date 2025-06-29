<?php

namespace Database\Seeders;

use App\Models\ProductBatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductBatch::insert([
            // Product 1 (Entries 1-3)
            [
                'user_id' => 1,
                'product_id' => 1,
                'quantity_in' => 100, // 0 + 100
                'quantity_out' => 0,
                'quantity_remaining' => 100,
                'real_cost' => 100.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-01 10:00:00',
                'updated_at' => '2025-01-01 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 1,
                'quantity_in' => 150, // 10 + 140
                'quantity_out' => 10,
                'quantity_remaining' => 140,
                'real_cost' => 50.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-11 10:00:00',
                'updated_at' => '2025-01-11 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 1,
                'quantity_in' => 170, // 5 + 165
                'quantity_out' => 5,
                'quantity_remaining' => 165,
                'real_cost' => 30.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-21 10:00:00',
                'updated_at' => '2025-01-21 10:00:00',
            ],

            // Product 2 (Entries 4-6)
            [
                'user_id' => 1,
                'product_id' => 2,
                'quantity_in' => 110, // 0 + 110
                'quantity_out' => 0,
                'quantity_remaining' => 110,
                'real_cost' => 220.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-04 10:00:00',
                'updated_at' => '2025-01-04 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
                'quantity_in' => 160, // 10 + 150
                'quantity_out' => 10,
                'quantity_remaining' => 150,
                'real_cost' => 100.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-14 10:00:00',
                'updated_at' => '2025-01-14 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 2,
                'quantity_in' => 180, // 5 + 175
                'quantity_out' => 5,
                'quantity_remaining' => 175,
                'real_cost' => 60.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-24 10:00:00',
                'updated_at' => '2025-01-24 10:00:00',
            ],

            // Product 3 (Entries 7-9)
            [
                'user_id' => 1,
                'product_id' => 3,
                'quantity_in' => 120, // 0 + 120
                'quantity_out' => 0,
                'quantity_remaining' => 120,
                'real_cost' => 360.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-07 10:00:00',
                'updated_at' => '2025-01-07 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 3,
                'quantity_in' => 170, // 10 + 160
                'quantity_out' => 10,
                'quantity_remaining' => 160,
                'real_cost' => 150.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-17 10:00:00',
                'updated_at' => '2025-01-17 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 3,
                'quantity_in' => 190, // 5 + 185
                'quantity_out' => 5,
                'quantity_remaining' => 185,
                'real_cost' => 90.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-27 10:00:00',
                'updated_at' => '2025-01-27 10:00:00',
            ],

            // Product 4 (Entries 10-12)
            [
                'user_id' => 1,
                'product_id' => 4,
                'quantity_in' => 130, // 0 + 130
                'quantity_out' => 0,
                'quantity_remaining' => 130,
                'real_cost' => 520.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-10 10:00:00',
                'updated_at' => '2025-01-10 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 4,
                'quantity_in' => 180, // 10 + 170
                'quantity_out' => 10,
                'quantity_remaining' => 170,
                'real_cost' => 200.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-20 10:00:00',
                'updated_at' => '2025-01-20 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 4,
                'quantity_in' => 200, // 5 + 195
                'quantity_out' => 5,
                'quantity_remaining' => 195,
                'real_cost' => 120.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-30 10:00:00',
                'updated_at' => '2025-01-30 10:00:00',
            ],

            // Product 5 (Entries 13-15)
            [
                'user_id' => 1,
                'product_id' => 5,
                'quantity_in' => 140, // 0 + 140
                'quantity_out' => 0,
                'quantity_remaining' => 140,
                'real_cost' => 700.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-13 10:00:00',
                'updated_at' => '2025-01-13 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 5,
                'quantity_in' => 190, // 10 + 180
                'quantity_out' => 10,
                'quantity_remaining' => 180,
                'real_cost' => 250.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-23 10:00:00',
                'updated_at' => '2025-01-23 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 5,
                'quantity_in' => 210, // 5 + 205
                'quantity_out' => 5,
                'quantity_remaining' => 205,
                'real_cost' => 150.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-02 10:00:00',
                'updated_at' => '2025-02-02 10:00:00',
            ],

            // Product 6 (Entries 16-18)
            [
                'user_id' => 1,
                'product_id' => 6,
                'quantity_in' => 150, // 0 + 150
                'quantity_out' => 0,
                'quantity_remaining' => 150,
                'real_cost' => 900.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-16 10:00:00',
                'updated_at' => '2025-01-16 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 6,
                'quantity_in' => 200, // 10 + 190
                'quantity_out' => 10,
                'quantity_remaining' => 190,
                'real_cost' => 300.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-26 10:00:00',
                'updated_at' => '2025-01-26 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 6,
                'quantity_in' => 220, // 5 + 215
                'quantity_out' => 5,
                'quantity_remaining' => 215,
                'real_cost' => 180.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-05 10:00:00',
                'updated_at' => '2025-02-05 10:00:00',
            ],

            // Product 7 (Entries 19-21)
            [
                'user_id' => 1,
                'product_id' => 7,
                'quantity_in' => 160, // 0 + 160
                'quantity_out' => 0,
                'quantity_remaining' => 160,
                'real_cost' => 1120.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-19 10:00:00',
                'updated_at' => '2025-01-19 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 7,
                'quantity_in' => 210, // 10 + 200
                'quantity_out' => 10,
                'quantity_remaining' => 200,
                'real_cost' => 350.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-29 10:00:00',
                'updated_at' => '2025-01-29 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 7,
                'quantity_in' => 230, // 5 + 225
                'quantity_out' => 5,
                'quantity_remaining' => 225,
                'real_cost' => 210.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-08 10:00:00',
                'updated_at' => '2025-02-08 10:00:00',
            ],

            // Product 8 (Entries 22-24)
            [
                'user_id' => 1,
                'product_id' => 8,
                'quantity_in' => 170, // 0 + 170
                'quantity_out' => 0,
                'quantity_remaining' => 170,
                'real_cost' => 1360.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-22 10:00:00',
                'updated_at' => '2025-01-22 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 8,
                'quantity_in' => 220, // 10 + 210
                'quantity_out' => 10,
                'quantity_remaining' => 210,
                'real_cost' => 400.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-01 10:00:00',
                'updated_at' => '2025-02-01 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 8,
                'quantity_in' => 240, // 5 + 235
                'quantity_out' => 5,
                'quantity_remaining' => 235,
                'real_cost' => 240.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-11 10:00:00',
                'updated_at' => '2025-02-11 10:00:00',
            ],

            // Product 9 (Entries 25-27)
            [
                'user_id' => 1,
                'product_id' => 9,
                'quantity_in' => 180, // 0 + 180
                'quantity_out' => 0,
                'quantity_remaining' => 180,
                'real_cost' => 1620.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-25 10:00:00',
                'updated_at' => '2025-01-25 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 9,
                'quantity_in' => 230, // 10 + 220
                'quantity_out' => 10,
                'quantity_remaining' => 220,
                'real_cost' => 450.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-04 10:00:00',
                'updated_at' => '2025-02-04 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 9,
                'quantity_in' => 250, // 5 + 245
                'quantity_out' => 5,
                'quantity_remaining' => 245,
                'real_cost' => 270.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-14 10:00:00',
                'updated_at' => '2025-02-14 10:00:00',
            ],

            // Product 10 (Entries 28-30)
            [
                'user_id' => 1,
                'product_id' => 10,
                'quantity_in' => 190, // 0 + 190
                'quantity_out' => 0,
                'quantity_remaining' => 190,
                'real_cost' => 1900.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-28 10:00:00',
                'updated_at' => '2025-01-28 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 10,
                'quantity_in' => 240, // 10 + 230
                'quantity_out' => 10,
                'quantity_remaining' => 230,
                'real_cost' => 500.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-07 10:00:00',
                'updated_at' => '2025-02-07 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 10,
                'quantity_in' => 260, // 5 + 255
                'quantity_out' => 5,
                'quantity_remaining' => 255,
                'real_cost' => 300.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-17 10:00:00',
                'updated_at' => '2025-02-17 10:00:00',
            ],

            // Product 11 (Entries 31-33)
            [
                'user_id' => 1,
                'product_id' => 11,
                'quantity_in' => 200, // 0 + 200
                'quantity_out' => 0,
                'quantity_remaining' => 200,
                'real_cost' => 2200.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-01-31 10:00:00',
                'updated_at' => '2025-01-31 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 11,
                'quantity_in' => 250, // 10 + 240
                'quantity_out' => 10,
                'quantity_remaining' => 240,
                'real_cost' => 550.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-10 10:00:00',
                'updated_at' => '2025-02-10 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 11,
                'quantity_in' => 270, // 5 + 265
                'quantity_out' => 5,
                'quantity_remaining' => 265,
                'real_cost' => 330.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-20 10:00:00',
                'updated_at' => '2025-02-20 10:00:00',
            ],

            // Product 12 (Entries 34-36)
            [
                'user_id' => 1,
                'product_id' => 12,
                'quantity_in' => 210, // 0 + 210
                'quantity_out' => 0,
                'quantity_remaining' => 210,
                'real_cost' => 2520.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-03 10:00:00',
                'updated_at' => '2025-02-03 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 12,
                'quantity_in' => 260, // 10 + 250
                'quantity_out' => 10,
                'quantity_remaining' => 250,
                'real_cost' => 600.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-13 10:00:00',
                'updated_at' => '2025-02-13 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 12,
                'quantity_in' => 280, // 5 + 275
                'quantity_out' => 5,
                'quantity_remaining' => 275,
                'real_cost' => 360.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-23 10:00:00',
                'updated_at' => '2025-02-23 10:00:00',
            ],

            // Product 13 (Entries 37-39)
            [
                'user_id' => 1,
                'product_id' => 13,
                'quantity_in' => 220, // 0 + 220
                'quantity_out' => 0,
                'quantity_remaining' => 220,
                'real_cost' => 2860.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-06 10:00:00',
                'updated_at' => '2025-02-06 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 13,
                'quantity_in' => 270, // 10 + 260
                'quantity_out' => 10,
                'quantity_remaining' => 260,
                'real_cost' => 650.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-16 10:00:00',
                'updated_at' => '2025-02-16 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 13,
                'quantity_in' => 290, // 5 + 285
                'quantity_out' => 5,
                'quantity_remaining' => 285,
                'real_cost' => 390.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-26 10:00:00',
                'updated_at' => '2025-02-26 10:00:00',
            ],

            // Product 14 (Entries 40-42)
            [
                'user_id' => 1,
                'product_id' => 14,
                'quantity_in' => 230, // 0 + 230
                'quantity_out' => 0,
                'quantity_remaining' => 230,
                'real_cost' => 3220.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-09 10:00:00',
                'updated_at' => '2025-02-09 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 14,
                'quantity_in' => 280, // 10 + 270
                'quantity_out' => 10,
                'quantity_remaining' => 270,
                'real_cost' => 700.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-19 10:00:00',
                'updated_at' => '2025-02-19 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 14,
                'quantity_in' => 300, // 5 + 295
                'quantity_out' => 5,
                'quantity_remaining' => 295,
                'real_cost' => 420.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-01 10:00:00',
                'updated_at' => '2025-03-01 10:00:00',
            ],

            // Product 15 (Entries 43-45)
            [
                'user_id' => 1,
                'product_id' => 15,
                'quantity_in' => 240, // 0 + 240
                'quantity_out' => 0,
                'quantity_remaining' => 240,
                'real_cost' => 3600.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-12 10:00:00',
                'updated_at' => '2025-02-12 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 15,
                'quantity_in' => 290, // 10 + 280
                'quantity_out' => 10,
                'quantity_remaining' => 280,
                'real_cost' => 750.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-22 10:00:00',
                'updated_at' => '2025-02-22 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 15,
                'quantity_in' => 310, // 5 + 305
                'quantity_out' => 5,
                'quantity_remaining' => 305,
                'real_cost' => 450.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-04 10:00:00',
                'updated_at' => '2025-03-04 10:00:00',
            ],

            // Product 16 (Entries 46-48)
            [
                'user_id' => 1,
                'product_id' => 16,
                'quantity_in' => 250, // 0 + 250
                'quantity_out' => 0,
                'quantity_remaining' => 250,
                'real_cost' => 4000.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-15 10:00:00',
                'updated_at' => '2025-02-15 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 16,
                'quantity_in' => 300, // 10 + 290
                'quantity_out' => 10,
                'quantity_remaining' => 290,
                'real_cost' => 800.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-25 10:00:00',
                'updated_at' => '2025-02-25 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 16,
                'quantity_in' => 320, // 5 + 315
                'quantity_out' => 5,
                'quantity_remaining' => 315,
                'real_cost' => 480.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-07 10:00:00',
                'updated_at' => '2025-03-07 10:00:00',
            ],

            // Product 17 (Entries 49-51)
            [
                'user_id' => 1,
                'product_id' => 17,
                'quantity_in' => 260, // 0 + 260
                'quantity_out' => 0,
                'quantity_remaining' => 260,
                'real_cost' => 4420.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-18 10:00:00',
                'updated_at' => '2025-02-18 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 17,
                'quantity_in' => 310, // 10 + 300
                'quantity_out' => 10,
                'quantity_remaining' => 300,
                'real_cost' => 850.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-28 10:00:00',
                'updated_at' => '2025-02-28 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 17,
                'quantity_in' => 330, // 5 + 325
                'quantity_out' => 5,
                'quantity_remaining' => 325,
                'real_cost' => 510.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-10 10:00:00',
                'updated_at' => '2025-03-10 10:00:00',
            ],

            // Product 18 (Entries 52-54)
            [
                'user_id' => 1,
                'product_id' => 18,
                'quantity_in' => 270, // 0 + 270
                'quantity_out' => 0,
                'quantity_remaining' => 270,
                'real_cost' => 4860.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-21 10:00:00',
                'updated_at' => '2025-02-21 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 18,
                'quantity_in' => 320, // 10 + 310
                'quantity_out' => 10,
                'quantity_remaining' => 310,
                'real_cost' => 900.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-03 10:00:00',
                'updated_at' => '2025-03-03 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 18,
                'quantity_in' => 340, // 5 + 335
                'quantity_out' => 5,
                'quantity_remaining' => 335,
                'real_cost' => 540.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-13 10:00:00',
                'updated_at' => '2025-03-13 10:00:00',
            ],

            // Product 19 (Entries 55-57)
            [
                'user_id' => 1,
                'product_id' => 19,
                'quantity_in' => 280, // 0 + 280
                'quantity_out' => 0,
                'quantity_remaining' => 280,
                'real_cost' => 5320.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-24 10:00:00',
                'updated_at' => '2025-02-24 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 19,
                'quantity_in' => 330, // 10 + 320
                'quantity_out' => 10,
                'quantity_remaining' => 320,
                'real_cost' => 950.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-06 10:00:00',
                'updated_at' => '2025-03-06 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 19,
                'quantity_in' => 350, // 5 + 345
                'quantity_out' => 5,
                'quantity_remaining' => 345,
                'real_cost' => 570.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-16 10:00:00',
                'updated_at' => '2025-03-16 10:00:00',
            ],

            // Product 20 (Entries 58-60)
            [
                'user_id' => 1,
                'product_id' => 20,
                'quantity_in' => 290, // 0 + 290
                'quantity_out' => 0,
                'quantity_remaining' => 290,
                'real_cost' => 5800.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-02-27 10:00:00',
                'updated_at' => '2025-02-27 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 20,
                'quantity_in' => 340, // 10 + 330
                'quantity_out' => 10,
                'quantity_remaining' => 330,
                'real_cost' => 1000.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-09 10:00:00',
                'updated_at' => '2025-03-09 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 20,
                'quantity_in' => 360, // 5 + 355
                'quantity_out' => 5,
                'quantity_remaining' => 355,
                'real_cost' => 600.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-19 10:00:00',
                'updated_at' => '2025-03-19 10:00:00',
            ],

            // Product 21 (Entries 61-63)
            [
                'user_id' => 1,
                'product_id' => 21,
                'quantity_in' => 300, // 0 + 300
                'quantity_out' => 0,
                'quantity_remaining' => 300,
                'real_cost' => 6300.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-02 10:00:00',
                'updated_at' => '2025-03-02 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 21,
                'quantity_in' => 350, // 10 + 340
                'quantity_out' => 10,
                'quantity_remaining' => 340,
                'real_cost' => 1050.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-12 10:00:00',
                'updated_at' => '2025-03-12 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 21,
                'quantity_in' => 370, // 5 + 365
                'quantity_out' => 5,
                'quantity_remaining' => 365,
                'real_cost' => 630.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-22 10:00:00',
                'updated_at' => '2025-03-22 10:00:00',
            ],

            // Product 22 (Entries 64-66)
            [
                'user_id' => 1,
                'product_id' => 22,
                'quantity_in' => 200, // 0 + 200
                'quantity_out' => 0,
                'quantity_remaining' => 200,
                'real_cost' => 4400.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-05 10:00:00',
                'updated_at' => '2025-03-05 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 22,
                'quantity_in' => 250, // 10 + 240
                'quantity_out' => 10,
                'quantity_remaining' => 240,
                'real_cost' => 1100.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-15 10:00:00',
                'updated_at' => '2025-03-15 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 22,
                'quantity_in' => 270, // 5 + 265
                'quantity_out' => 5,
                'quantity_remaining' => 265,
                'real_cost' => 660.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-25 10:00:00',
                'updated_at' => '2025-03-25 10:00:00',
            ],

            // Product 23 (Entries 67-69)
            [
                'user_id' => 1,
                'product_id' => 23,
                'quantity_in' => 210, // 0 + 210
                'quantity_out' => 0,
                'quantity_remaining' => 210,
                'real_cost' => 4830.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-08 10:00:00',
                'updated_at' => '2025-03-08 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 23,
                'quantity_in' => 260, // 10 + 250
                'quantity_out' => 10,
                'quantity_remaining' => 250,
                'real_cost' => 1150.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-18 10:00:00',
                'updated_at' => '2025-03-18 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 23,
                'quantity_in' => 280, // 5 + 275
                'quantity_out' => 5,
                'quantity_remaining' => 275,
                'real_cost' => 690.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-28 10:00:00',
                'updated_at' => '2025-03-28 10:00:00',
            ],

            // Product 24 (Entries 70-72)
            [
                'user_id' => 1,
                'product_id' => 24,
                'quantity_in' => 220, // 0 + 220
                'quantity_out' => 0,
                'quantity_remaining' => 220,
                'real_cost' => 5280.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-11 10:00:00',
                'updated_at' => '2025-03-11 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 24,
                'quantity_in' => 270, // 10 + 260
                'quantity_out' => 10,
                'quantity_remaining' => 260,
                'real_cost' => 1200.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-21 10:00:00',
                'updated_at' => '2025-03-21 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 24,
                'quantity_in' => 290, // 5 + 285
                'quantity_out' => 5,
                'quantity_remaining' => 285,
                'real_cost' => 720.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-31 10:00:00',
                'updated_at' => '2025-03-31 10:00:00',
            ],

            // Product 25 (Entries 73-75)
            [
                'user_id' => 1,
                'product_id' => 25,
                'quantity_in' => 230, // 0 + 230
                'quantity_out' => 0,
                'quantity_remaining' => 230,
                'real_cost' => 5750.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-14 10:00:00',
                'updated_at' => '2025-03-14 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 25,
                'quantity_in' => 280, // 10 + 270
                'quantity_out' => 10,
                'quantity_remaining' => 270,
                'real_cost' => 1250.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-24 10:00:00',
                'updated_at' => '2025-03-24 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 25,
                'quantity_in' => 300, // 5 + 295
                'quantity_out' => 5,
                'quantity_remaining' => 295,
                'real_cost' => 750.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-03 10:00:00',
                'updated_at' => '2025-04-03 10:00:00',
            ],

            // Product 26 (Entries 76-78)
            [
                'user_id' => 1,
                'product_id' => 26,
                'quantity_in' => 240, // 0 + 240
                'quantity_out' => 0,
                'quantity_remaining' => 240,
                'real_cost' => 6240.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-17 10:00:00',
                'updated_at' => '2025-03-17 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 26,
                'quantity_in' => 290, // 10 + 280
                'quantity_out' => 10,
                'quantity_remaining' => 280,
                'real_cost' => 1300.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-27 10:00:00',
                'updated_at' => '2025-03-27 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 26,
                'quantity_in' => 310, // 5 + 305
                'quantity_out' => 5,
                'quantity_remaining' => 305,
                'real_cost' => 780.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-06 10:00:00',
                'updated_at' => '2025-04-06 10:00:00',
            ],

            // Product 27 (Entries 79-81)
            [
                'user_id' => 1,
                'product_id' => 27,
                'quantity_in' => 250, // 0 + 250
                'quantity_out' => 0,
                'quantity_remaining' => 250,
                'real_cost' => 6750.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-20 10:00:00',
                'updated_at' => '2025-03-20 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 27,
                'quantity_in' => 300, // 10 + 290
                'quantity_out' => 10,
                'quantity_remaining' => 290,
                'real_cost' => 1350.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-30 10:00:00',
                'updated_at' => '2025-03-30 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 27,
                'quantity_in' => 320, // 5 + 315
                'quantity_out' => 5,
                'quantity_remaining' => 315,
                'real_cost' => 810.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-09 10:00:00',
                'updated_at' => '2025-04-09 10:00:00',
            ],

            // Product 28 (Entries 82-84)
            [
                'user_id' => 1,
                'product_id' => 28,
                'quantity_in' => 260, // 0 + 260
                'quantity_out' => 0,
                'quantity_remaining' => 260,
                'real_cost' => 7280.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-23 10:00:00',
                'updated_at' => '2025-03-23 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 28,
                'quantity_in' => 310, // 10 + 300
                'quantity_out' => 10,
                'quantity_remaining' => 300,
                'real_cost' => 1400.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-02 10:00:00',
                'updated_at' => '2025-04-02 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 28,
                'quantity_in' => 330, // 5 + 325
                'quantity_out' => 5,
                'quantity_remaining' => 325,
                'real_cost' => 840.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-12 10:00:00',
                'updated_at' => '2025-04-12 10:00:00',
            ],

            // Product 29 (Entries 85-87)
            [
                'user_id' => 1,
                'product_id' => 29,
                'quantity_in' => 270, // 0 + 270
                'quantity_out' => 0,
                'quantity_remaining' => 270,
                'real_cost' => 7830.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-26 10:00:00',
                'updated_at' => '2025-03-26 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 29,
                'quantity_in' => 320, // 10 + 310
                'quantity_out' => 10,
                'quantity_remaining' => 310,
                'real_cost' => 1450.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-05 10:00:00',
                'updated_at' => '2025-04-05 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 29,
                'quantity_in' => 340, // 5 + 335
                'quantity_out' => 5,
                'quantity_remaining' => 335,
                'real_cost' => 870.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-15 10:00:00',
                'updated_at' => '2025-04-15 10:00:00',
            ],

            // Product 30 (Entries 88-90)
            [
                'user_id' => 1,
                'product_id' => 30,
                'quantity_in' => 280, // 0 + 280
                'quantity_out' => 0,
                'quantity_remaining' => 280,
                'real_cost' => 8400.00,
                'notes' => 'cash',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-03-29 10:00:00',
                'updated_at' => '2025-03-29 10:00:00',
            ],
            [
                'user_id' => 2,
                'product_id' => 30,
                'quantity_in' => 330, // 10 + 320
                'quantity_out' => 10,
                'quantity_remaining' => 320,
                'real_cost' => 1500.00,
                'notes' => 'bank transfer',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-08 10:00:00',
                'updated_at' => '2025-04-08 10:00:00',
            ],
            [
                'user_id' => 3,
                'product_id' => 30,
                'quantity_in' => 350, // 5 + 345
                'quantity_out' => 5,
                'quantity_remaining' => 345,
                'real_cost' => 900.00,
                'notes' => 'credit card',
                'status' => 'ready',
                'reproduction_count' => 0,
                'created_at' => '2025-04-18 10:00:00',
                'updated_at' => '2025-04-18 10:00:00',
            ]
        ]);
    }
}
