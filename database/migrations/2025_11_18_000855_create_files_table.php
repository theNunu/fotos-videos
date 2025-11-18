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
        Schema::create('files', function (Blueprint $table) {
            // $table->id();
            $table->uuid('file_id')->primary();

            $table->string('original_name');       // Nombre original
            $table->string('stored_name');         // Nombre guardado en disco
            $table->string('mime_type');           // image/png, video/mp4, etc
            $table->bigInteger('size');            // Tamaño en bytes
            $table->string('path');                // Ruta relativa (ej: files/image001.png)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
