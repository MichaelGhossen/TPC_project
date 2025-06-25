<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('production_settings', function (Blueprint $table) {
            $table->id('production_settings_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->decimal('total_production', 10, 2); // e.g., 5000.00 kg or tons
            $table->enum('type', ['real', 'estimated'])->default('estimated');
            $table->decimal('profit_ratio', 5, 4)->default(0.10); // e.g., 0.1000 = 10%
            $table->text('notes')->nullable();
            $table->unsignedTinyInteger('month');
            $table->year('year');
            $table->unique(['month', 'year','type']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('production_settings');
    }
};
