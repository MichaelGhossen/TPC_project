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
        Schema::create('profit_loss_reports', function (Blueprint $table) {
            $table->id('report_id');

            $table->unsignedBigInteger('product_sale_id');
            $table->unsignedBigInteger('damaged_material_id');

            $table->enum('type', ['loss', 'profit']);
            $table->decimal('net_profit_loss', 10, 2);
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('product_sale_id')->references('product_sale_id')->on('product_sales')->onDelete('cascade');
            $table->foreign('damaged_material_id')->references('damaged_material_id')->on('damaged_materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profit_loss_reports');
    }
};
