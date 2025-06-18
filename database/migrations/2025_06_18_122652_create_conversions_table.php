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
            Schema::create('conversions', function (Blueprint $table) {
                $table->id('conversion_id');

                $table->unsignedBigInteger('semi_finished_batch_id');
                $table->unsignedBigInteger('product_batch_id');

                $table->decimal('quantity_used', 10, 2)->default(0);
                $table->decimal('additional_costs', 10, 2)->nullable();

                $table->timestamps();

                $table->foreign('semi_finished_batch_id')
                    ->references('semi_finished_batch_id')
                    ->on('semi_finished_batches')
                    ->onDelete('cascade');

                $table->foreign('product_batch_id')
                    ->references('product_batch_id')
                    ->on('product_batches')
                    ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
