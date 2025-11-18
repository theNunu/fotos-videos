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
        Schema::create('news_files', function (Blueprint $table) {
            $table->id('news_file_id');
            $table->string('new_id');
            $table->string('file_id');

            $table->foreign('new_id')->references('new_id')->on('news')->cascadeOnDelete();
            $table->foreign('file_id')->references('file_id')->on('files')->cascadeOnDelete();

            // $table->primary(['news_id', 'file_id']); // clave compuesta
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_files');
    }
};
