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
        Schema::create('archivedAccounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mname');
            $table->string('lname');
            $table->string('suffix')->nullable();
            $table->string('email')->unique();
            $table->string('usertype');
            $table->string('status')->nullable();
            $table->string('personIncharge')->nullable();
            $table->dateTime('remove_at')->nullable();
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
