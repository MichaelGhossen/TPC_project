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
        Schema::create('raw_material_patches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
                  $table->unsignedBigInteger('raw_material_id');
                  
                  $table->foreign('raw_material_id')
                  ->references('raw_material_id')
                  ->on('raw_materials')
                  ->onDelete('cascade');


            $table->decimal('quantity_in', 10, 2)->default(0);
            $table->decimal('quantity_out', 10, 2)->default(0);
            $table->decimal('quantity_remaining', 10, 2)->default(0);
            $table->decimal('real_cost', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('supplier')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_material_patches');
    }
};
