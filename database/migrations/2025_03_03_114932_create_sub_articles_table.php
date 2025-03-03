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
        Schema::create('sub_articles', function (Blueprint $table) {
            $table->id();
            $table->integer('article_id');
            $table->string('title')->nullable(true);
            $table->string('sub_title')->nullable(true);
            $table->text('description_ar')->nullable(true);
            $table->string('image')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_articles');
    }
};
