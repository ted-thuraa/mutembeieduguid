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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('category');
            $table->string('description')->nullable();
            $table->unsignedInteger('year')->nullable();
            $table->string('unit')->nullable();
            $table->text('thumbnailimage')->nullable();
            $table->text('url')->nullable();            
            $table->unsignedInteger('price')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
