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
        Schema::create('archivedRecords', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('age')->nullable();
            $table->string('address');
            $table->string('purpose')->nullable();
            $table->string('sender')->nullable();
            $table->string('requirement')->nullable();
            $table->string('requesttype')->nullable();
            $table->string('status')->nullable();
            $table->longtext('response')->nullable();
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
