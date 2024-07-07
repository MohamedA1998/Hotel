<?php

use App\Models\Room;
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
        Schema::create('room_numbers', function (Blueprint $table) {
            $table->id();

            // $table->integer('room_id');
            $table->foreignIdFor(Room::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(RoomType::class);
            $table->string('room_number')->nullable();
            $table->enum('status' , ['active' ,'in_active'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_numbers');
    }
};
