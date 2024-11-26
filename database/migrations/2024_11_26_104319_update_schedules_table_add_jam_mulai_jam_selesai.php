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
        Schema::table('schedules', function (Blueprint $table) {
            $table->time('jam_mulai')->nullable()->after('program_id');
            $table->time('jam_selesai')->nullable()->after('jam_mulai');

            $table->dropColumn('jam_program');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('jam_program', 255)->nullable()->after('program_id');

            $table->dropColumn(['jam_mulai', 'jam_selesai']);
        });
    }
};
