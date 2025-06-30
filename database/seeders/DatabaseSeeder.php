<?php

namespace Database\Seeders;

use App\Models\ProductBatch;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Activitylog\Traits\LogsActivity;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            ExpenseCategoriesSeeder::class,
            RawMaterialSeeder::class,
            ExpenseSeeder::class,
            ProductSeeder::class,
            ProductMaterialSeeder::class,
            RawMaterialBatchSeeder::class,
            ProductionSettingsSeeder::class,
            ProductBatchSeeder::class,


        ]);

    }
}
