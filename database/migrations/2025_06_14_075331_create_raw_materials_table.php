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
        Schema::create('raw_materials', function (Blueprint $table) {
        $table->id('raw_material_id');
        $table->string('name')->unique();;
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2)->default(0);
        $table->enum('status', ['used', 'unused'])->default('used');
        $table->decimal('minimum_stock_alert', 10, 2)->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
