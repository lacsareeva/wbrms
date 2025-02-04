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
        Schema::create('archivedBlotter', function (Blueprint $table) {
            $table->id();
            $table->string('incident_report');
            $table->string('address');
            $table->string('datetimes');
            $table->string('nameofcomplainant');
            $table->string('witness1')->nullable();
            $table->string('witness2')->nullable();
            $table->longtext('narrative');
            $table->string('sender');
            $table->dateTime('settled_at');
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
