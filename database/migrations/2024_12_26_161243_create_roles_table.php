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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');

            $table->boolean('news_creator');
            $table->boolean('news_moderator');

            $table->boolean('discussions_moderator');
            $table->boolean('discussions_creator');

            $table->boolean('users_moderator');

            $table->boolean('roles_moderator');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
