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
        Schema::create('damaged_materials', function (Blueprint $table) {
            $table->id('damaged_material_id');

            $table->unsignedBigInteger('semi_finished_batch_id')->nullable();
            $table->unsignedBigInteger('product_batch_id')->nullable();
            $table->unsignedBigInteger('raw_material_batch_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->text('notes')->nullable();
            $table->decimal('quantity', 10, 2);
            $table->enum('material_type', ['raw', 'semi', 'product']);
            $table->decimal('lost_cost', 10, 2);

            $table->timestamps();

            $table->foreign('semi_finished_batch_id')->references('semi_finished_batch_id')->on('semi_finished_batches')->onDelete('set null');
            $table->foreign('product_batch_id')->references('product_batch_id')->on('product_batches')->onDelete('set null');
            $table->foreign('raw_material_batch_id')->references('raw_material_batch_id')->on('raw_material_batches')->onDelete('set null');
            $table->foreign('user_id')->references(columns: 'id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damaged_materials');
    }
};
