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
        Schema::connection('mediasiapp_conn')->create('perkaras', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pendaftaran')->nullable();
            $table->string('nomor_perkara')->nullable();
            $table->timestamp('diinput_tgl');
            $table->timestamp('diperbaharui_tgl');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkaras');
    }
};
