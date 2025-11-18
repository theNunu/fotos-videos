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
        Schema::create('news', function (Blueprint $table) {
            $table->uuid('new_id')->primary();
            $table->string('title');      
            $table->string('description');   

                      // Definir la columna que será la llave foránea
            $table->foreignUuid('file_id');

            // Definir la restricción de llave foránea
            $table->foreign('file_id')->references('file_id')->on('files');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
