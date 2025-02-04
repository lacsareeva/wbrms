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
        Schema::create('archivedBorrowed', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('equipment');
            $table->string('quantity');
            $table->string('purpose');
            $table->string('contact');
            $table->dateTime('borrow-date');
            $table->dateTime('return-date');
            $table->string('sender');
            $table->string('status')->nullable();
            $table->longtext('response')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->string('personIncharge');
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
