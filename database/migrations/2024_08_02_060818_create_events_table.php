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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //title to give to the event
            $table->string('description'); //description of the event
            $table->dateTime('date_time'); //date of the event
            $table->string('location'); //location of the event
            $table->integer('capacity')->nullable(); //maximum number of people allowed to participate to the event
            $table->string('cover_image')->nullable(); //cover image of the event
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //delete the event if the user/owner of the event is deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
