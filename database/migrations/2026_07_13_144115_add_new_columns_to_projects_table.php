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
    Schema::table('projects', function (Blueprint $table) {

        if (!Schema::hasColumn('projects','technology_stack')) {
            $table->string('technology_stack')->nullable();
        }

        if (!Schema::hasColumn('projects','guru_pengampu')) {
            $table->string('guru_pengampu')->nullable();
        }

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};
