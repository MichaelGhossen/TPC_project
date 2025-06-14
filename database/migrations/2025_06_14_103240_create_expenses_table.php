<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id('expense_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('employee_salaries', 10, 2)->default(0);
            $table->decimal('transportation', 10, 2)->default(0);
            $table->decimal('taxes', 10, 2)->default(0);
            $table->decimal('utility_bills', 10, 2)->default(0);
            $table->decimal('phone_bills', 10, 2)->default(0);
            $table->decimal('maintenance', 10, 2)->default(0);
            $table->decimal('administrative_costs', 10, 2)->default(0);
            $table->decimal('other_costs', 10, 2)->default(0);
            $table->enum('type', ['real', 'estimated']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
