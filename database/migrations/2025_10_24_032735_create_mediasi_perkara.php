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
        Schema::connection('mediasiapp_conn')->create('mediasi_perkara', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mediasi_id')->nullable();
            $table->foreign('mediasi_id')->references('id')->on('mediasis')->onDelete('cascade');
            $table->unsignedBigInteger('perkara_id')->nullable();
            $table->foreign('perkara_id')->references('id')->on('perkaras')->onDelete('cascade');
            $table->datetime('diinput_tanggal');
            $table->datetime('diperbaharui_tanggal');
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
