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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('categoryID');
            $table->unsignedBigInteger('authorID');
            $table->longText('content'); 
            $table->foreign('categoryID')->references('id')->on('categories')
            ->onDelete('restrict')
            ->onUpdate('cascade');
            $table->foreign('authorID')->references('id')->on('authors');
            $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
