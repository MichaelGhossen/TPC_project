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
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id('product_sale_id');

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('semi_finished_batch_id')->nullable();
            $table->unsignedBigInteger('product_batch_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->decimal('quantity_sold', 10, 2)->default(0);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->string('customer')->nullable();
            $table->decimal('net_profit', 10, 2)->nullable();

            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('semi_finished_batch_id')->references('semi_finished_batch_id')->on('semi_finished_batches')->onDelete('set null');
            $table->foreign('product_batch_id')->references('product_batch_id')->on('product_batches')->onDelete('set null');
            $table->foreign('user_id')->references(columns: 'id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sales');
    }
};
