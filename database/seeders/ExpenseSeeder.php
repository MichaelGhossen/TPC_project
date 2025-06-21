<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expense::insert([
            [
                'user_id' => 1,
                'expense_category_id' => 1,
                'type' => 'real',
                'amount' => 100.50,
                'notes' => 'Groceries for the week',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'expense_category_id' => 2,
                'type' => 'estimated',
                'amount' => 200,
                'notes' => 'Estimated rent for next month',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'expense_category_id' => 1,
                'type' => 'real',
                'amount' => 55.75,
                'notes' => 'Fuel charges',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
