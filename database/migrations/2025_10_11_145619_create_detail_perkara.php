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

        Schema::connection('mediasiapp_conn')->create('detail_perkara', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perkara_id');
            $table->foreign('perkara_id')->references('id')->on('perkaras')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('pihak_id');
            $table->foreign('pihak_id')->references('id')->on('paboyo_masterapp.users')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('diinput_tanggal');
            $table->dateTime('diperbaharui_tanggal');
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
