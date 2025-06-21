<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Employee Salaries',
                'description' => 'Salaries and wages for employees'
            ],
            [
                'name' => 'Transportation',
                'description' => 'Vehicle expenses, fuel, and transportation costs'
            ],
            [
                'name' => 'Taxes',
                'description' => 'Business taxes and government payments'
            ],
            [
                'name' => 'Utility Bills',
                'description' => 'Electricity, water, and other utilities'
            ],
            [
                'name' => 'Phone Bills',
                'description' => 'Telecommunication and internet services'
            ],
            [
                'name' => 'Maintenance',
                'description' => 'Equipment and property maintenance'
            ],
            [
                'name' => 'Administrative Costs',
                'description' => 'Office supplies and administrative expenses'
            ],
            [
                'name' => 'Other Costs',
                'description' => 'Miscellaneous business expenses'
            ]
        ];

        foreach ($categories as $category) {
            ExpenseCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }

    }
}
