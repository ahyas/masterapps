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
        Schema::connection('mediasiapp_conn')->table('perkaras', function (Blueprint $table) {
            $table->unsignedBigInteger('tahapan_id')->after('status_id')->nullable();
            $table->unsignedBigInteger('proses_id')->after('tahapan_id')->nullable();
            $table->string('proses_deskripsi')->after('proses_id')->nullable();
            $table->string('tahapan_deskripsi')->after('proses_deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perkaras', function (Blueprint $table) {
            //
        });
    }
};
