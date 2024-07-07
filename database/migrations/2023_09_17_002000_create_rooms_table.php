<?php

use App\Models\RoomType;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(RoomType::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('total_adult')->nullable();
            $table->string('total_child')->nullable();
            $table->string('room_capacity')->nullable();
            $table->text('image')->nullable();
            $table->string('price')->nullable();
            $table->string('size')->nullable();
            $table->enum('view', ['See View','Hill View'])->default('See View');
            $table->enum('bed_style' , ['Queen Bed' , 'Twin Bed' , 'King Bed'])->default('King Bed');
            $table->integer('discount')->default(0);
            $table->text('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
