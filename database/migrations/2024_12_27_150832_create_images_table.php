<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('entity_type')->nullable(); // Поліморфний тип
            $table->unsignedBigInteger('entity_id')->nullable(); // Поліморфний ідентифікатор
            $table->timestamps();

            $table->index(['entity_type', 'entity_id']); // Індекс для поліморфного зв'язку
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
