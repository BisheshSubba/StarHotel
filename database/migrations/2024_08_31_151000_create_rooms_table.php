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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_title')->nullable();
            $table->string('image')->nullable();
            $table->string('room_type')->nullable();
            $table->boolean('wifi')->default(0);
            $table->enum('bed_type', ['single', 'double'])->default('single');
            $table->longText('description')->nullable();
            $table->string('price')->nullable();
            $table->integer('total_rooms')->default(1);
            $table->string('room_view')->nullable();
            $table->integer('total_occupancy')->default(1); 
            $table->boolean('breakfast')->default(false); 
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
