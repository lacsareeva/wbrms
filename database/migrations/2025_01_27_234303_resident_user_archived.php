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
        Schema::create('ResidentUserArchived', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('suffix')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('month')->nullable();
            $table->string('day')->nullable();
            $table->string('year')->nullable();
            $table->string('gender')->nullable();
            $table->string('usertype')->nullable();;
            $table->string('residenttype')->nullable();;
            $table->string('age')->nullable();
            $table->string('verificationInfo')->nullable();
            $table->string('verification_id')->nullable();
            $table->string('verification_id_number')->nullable();
            $table->string('verification_id_image')->nullable();
            $table->longtext('response')->nullable();
            $table->string('personIncharge')->nullable();
            $table->rememberToken();
            $table->dateTimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
