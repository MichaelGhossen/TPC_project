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
        Schema::create('semi_finished_batches', function (Blueprint $table) {
            $table->id('semi_finished_batch_id');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id');

            $table->decimal('quantity_in', 10, 2)->default(0);
            $table->decimal('quantity_out', 10, 2)->default(0);
            $table->decimal('quantity_remaining', 10, 2)->default(0);
            $table->decimal('real_cost', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['ready', 'needs_reproduction'])->default('ready');
            $table->integer('reproduction_count')->default(0);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semi_finished_batches');
    }
};
