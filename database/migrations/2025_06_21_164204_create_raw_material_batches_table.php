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
    {        Schema::create('raw_material_batches', function (Blueprint $table) {

        $table->id('raw_material_batch_id');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('raw_material_id');

            $table->decimal('quantity_in', 10, 2)->default(0);
            $table->decimal('quantity_out', 10, 2)->default(0);
            $table->decimal('quantity_remaining', 10, 2)->default(0);
            $table->decimal('real_cost', 12, 2)->nullable();

            $table->string('payment_method')->nullable();
            $table->string('supplier')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references(columns: 'id')->on('users')->nullOnDelete();
            $table->foreign('raw_material_id')->references('raw_material_id')->on('raw_materials')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_material_batches');
    }
};
