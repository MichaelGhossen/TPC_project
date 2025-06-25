<?php

namespace Database\Seeders;

use App\Models\ProductionSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProductionSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 1; // Change if you want to rotate users
        $settings = [];

        $startDate = Carbon::now()->subYear()->startOfMonth();

        for ($i = 0; $i < 13; $i++) {
            $date = $startDate->copy()->addMonths($i);
            $year = $date->year;
            $month = $date->month;

            foreach (['real', 'estimated'] as $type) {
                // Random profit ratio between 5% and 15% → e.g., 0.0500 to 0.1500
                $profitRatio = round(mt_rand(50, 150) / 1000, 4);

                // Timestamp within this specific month
                $createdAt = $date->copy()->addDays(rand(1, 25))->setTime(rand(8, 18), rand(0, 59));

                $settings[] = [
                    'user_id' => $userId,
                    'total_production' => round(mt_rand(400000, 800000) / 100, 2), // e.g. 4000.00 to 8000.00
                    'type' => $type,
                    'profit_ratio' => $profitRatio,
                    'notes' => ucfirst($type) . " production data for {$month}/{$year}",
                    'month' => $month,
                    'year' => $year,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
            }
        }

        ProductionSetting::insert($settings);
    }
}
