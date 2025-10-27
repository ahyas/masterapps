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
        Schema::connection('mediasiapp_conn')->dropIfExists('mediasi_perkara');

        Schema::connection('mediasiapp_conn')->create('mediasi_perkara', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perkara_id');
            $table->foreign('perkara_id')->references('id')->on('perkaras')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('mediasi_id');
            $table->foreign('mediasi_id')->references('id')->on('mediasis')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('diinput_tanggal');
            $table->dateTime('diperbaharui_tanggal');
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
