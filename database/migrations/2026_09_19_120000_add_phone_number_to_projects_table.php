<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Menambah nomor telepon / WhatsApp untuk karya jurusan TKJ (TJKT) dan TSM.
     * Kolom nullable karena jurusan lain (PPLG, DKV, TOI) tidak memakainya.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('phone_number', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('phone_number');
        });
    }
};