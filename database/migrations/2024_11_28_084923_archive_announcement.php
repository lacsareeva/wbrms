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
        Schema::create('archivedAnnouncements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('what');
            $table->string('when');
            $table->string('where');
            $table->longtext('otherInfo');
            $table->dateTime('deleted_at')->nullable();
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
