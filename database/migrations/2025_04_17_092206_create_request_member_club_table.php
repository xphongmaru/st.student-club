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
        Schema::create('request_member_clubs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruitment_club_id');
            $table->unsignedBigInteger('club_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('gender')->nullable();
            $table->string('faculty_id')->nullable();
            $table->string('class')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('advantage_and_disadvantage')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->nullable();
            $table->string('dateTime')->nullable();
            $table->string('address')->nullable();
            $table->string('content')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_member_club');
    }
};
