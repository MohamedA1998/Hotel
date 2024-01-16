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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            
            // $table->integer('blog_categorie_id');
            // $table->integer('user_id');
            // Morph Image
            // $table->string('post_image');

            // Short RelashenShep
            // $table->foreignId()->constrained()->cascadeOnDelete();
            $table->foreignId('blog_categorie_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('PostTitile');
            $table->string('PostSlug');            
            $table->text('ShortDesc');
            $table->text('LongDesc');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
