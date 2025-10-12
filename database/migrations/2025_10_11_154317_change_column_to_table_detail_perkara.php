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
        Schema::connection('mediasiapp_conn')->table('detail_perkara', function (Blueprint $table) {
            $table->dateTime('diinput_tanggal')->nullable()->change();
            $table->dateTime('diperbaharui_tanggal')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_perkara', function (Blueprint $table) {
            //
        });
    }
};
