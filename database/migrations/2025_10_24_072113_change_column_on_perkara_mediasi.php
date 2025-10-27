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
        Schema::connection('mediasiapp_conn')->table('mediasi_perkara', function (Blueprint $table) {
            $table->date('diinput_tanggal')->nullable()->change();
            $table->date('diperbaharui_tanggal')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mediasi_perkara', function (Blueprint $table) {
            //
        });
    }
};
