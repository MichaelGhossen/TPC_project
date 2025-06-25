<?php

namespace Database\Seeders;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templateEntries = [
            // Category ID 1: Employee Salaries
            [
                'user_id' => 1,
                'expense_category_id' => 1,
                'type' => 'real',
                'amount' => 110.50,
                'notes' => 'Actual Employee Salaries for this month',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 1,
                'type' => 'estimated',
                'amount' => 220,
                'notes' => 'Estimated Employee Salaries for next quarter',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category ID 2: Transportation
            [
                'user_id' => 1,
                'expense_category_id' => 2,
                'type' => 'real',
                'amount' => 125.75,
                'notes' => 'Actual Transportation costs for logistics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 2,
                'type' => 'estimated',
                'amount' => 240,
                'notes' => 'Estimated Transportation for raw materials',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category ID 3: Taxes
            [
                'user_id' => 1,
                'expense_category_id' => 3,
                'type' => 'real',
                'amount' => 135.25,
                'notes' => 'Actual Tax payment for Q1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 3,
                'type' => 'estimated',
                'amount' => 260,
                'notes' => 'Estimated Property taxes for next year',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category ID 4: Utility Bills
            [
                'user_id' => 1,
                'expense_category_id' => 4,
                'type' => 'real',
                'amount' => 145.90,
                'notes' => 'Actual Electricity and water bills',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 4,
                'type' => 'estimated',
                'amount' => 280,
                'notes' => 'Estimated Utility costs for summer',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category ID 5: Phone Bills
            [
                'user_id' => 1,
                'expense_category_id' => 5,
                'type' => 'real',
                'amount' => 155.30,
                'notes' => 'Actual Phone and internet services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 5,
                'type' => 'estimated',
                'amount' => 300,
                'notes' => 'Estimated Telecom upgrades for next cycle',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category ID 6: Maintenance
            [
                'user_id' => 1,
                'expense_category_id' => 6,
                'type' => 'real',
                'amount' => 165.45,
                'notes' => 'Actual Machinery repair costs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 6,
                'type' => 'estimated',
                'amount' => 320,
                'notes' => 'Estimated Facility maintenance budget',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category ID 7: Administrative Costs
            [
                'user_id' => 1,
                'expense_category_id' => 7,
                'type' => 'real',
                'amount' => 175.60,
                'notes' => 'Actual Office supplies purchase',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 7,
                'type' => 'estimated',
                'amount' => 340,
                'notes' => 'Estimated Administrative expenses for Q3',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category ID 8: Other Costs
            [
                'user_id' => 1,
                'expense_category_id' => 8,
                'type' => 'real',
                'amount' => 185.80,
                'notes' => 'Actual Miscellaneous factory expenses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 8,
                'type' => 'estimated',
                'amount' => 360,
                'notes' => 'Estimated Contingency funds allocation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $allEntries = [];
        $now = Carbon::now();

        // Generate data for the past 12 months
        for ($monthsAgo = 0; $monthsAgo <= 12; $monthsAgo++) {
            $monthDate = $now->copy()->subMonths($monthsAgo)->startOfMonth();

            foreach ($templateEntries as $entry) {
                $allEntries[] = [
                    'user_id' => $entry['user_id'],
                    'expense_category_id' => $entry['expense_category_id'],
                    'type' => $entry['type'],
                    'amount' => $entry['amount'],
                    'notes' => $entry['notes'],
                    'created_at' => $monthDate,
                    'updated_at' => $monthDate,
                ];
            }
        }

        // Insert all entries in batches
        foreach (array_chunk($allEntries, 50) as $batch) {
            Expense::insert($batch);
        }
    }
}
