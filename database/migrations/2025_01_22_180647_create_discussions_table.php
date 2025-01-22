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
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->char('content', 500);

            $table->boolean('cultural_event');
            $table->boolean('sport_event');
            $table->boolean('movie_night');
            $table->boolean('party');
            $table->boolean('show');
            $table->boolean('concert');
            $table->boolean('other');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};
