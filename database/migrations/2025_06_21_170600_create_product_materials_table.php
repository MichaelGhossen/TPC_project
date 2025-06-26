<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_materials', function (Blueprint $table) {
            $table->id('product_material_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('cascade');
            $table->unsignedBigInteger('semi_product_id')->nullable();
            $table->foreign('semi_product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('cascade');
            $table->unsignedBigInteger('raw_material_id')->nullable();
            $table->foreign('raw_material_id')
                ->references('raw_material_id')
                ->on('raw_materials')
                ->onDelete('cascade');
            $table->enum('component_type', ['raw_material', 'semi_product']);

            $table->decimal('quantity_required_per_unit', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_materials');
    }
};
