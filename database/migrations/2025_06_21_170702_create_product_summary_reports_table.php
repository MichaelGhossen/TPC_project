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
        Schema::create('product_summary_reports', function (Blueprint $table) {
            $table->id('report_id');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');

            $table->decimal('quantity_produced', 10, 2)->default(0);
            $table->decimal('quantity_sold', 10, 2)->default(0);
            $table->decimal('total_costs', 12, 2)->default(0);
            $table->decimal('total_estimated_expenses', 12, 2)->default(0);
            $table->decimal('total_actual_expenses', 12, 2)->default(0);
            $table->decimal('total_income', 12, 2)->default(0);
            $table->decimal('net_profit', 12, 2)->default(0);

            $table->enum('type', ['yearly', 'monthly', 'daily']);
            $table->text('notes')->nullable();
            $table->unique(['product_id', 'type','created_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_summary_reports');
    }
};
