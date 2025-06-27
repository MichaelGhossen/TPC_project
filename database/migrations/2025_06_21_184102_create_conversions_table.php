<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id('conversion_id');
            $table->foreignId('raw_material_batch_id')->nullable()->constrained('raw_material_batches', 'raw_material_batch_id')->onDelete('cascade');
            $table->foreignId('input_product_batch_id')->nullable()->constrained('product_batches', 'product_batch_id')->onDelete('cascade');
            $table->foreignId('output_product_batch_id')->constrained('product_batches', 'product_batch_id')->onDelete('cascade');
            $table->enum('batch_type', ['raw_material', 'semi_product']);
            $table->decimal('quantity_used', 10, 2);
            $table->decimal('cost', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
