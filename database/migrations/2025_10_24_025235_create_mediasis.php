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
        Schema::connection('mediasiapp_conn')->create('mediasis', function (Blueprint $table) {
            $table->id();
            $table->date('penetapan_penunjukan_mediator');
            $table->date('dimulai_mediasi');
            $table->date('keputusan_mediasi');
            $table->date('tgl_kesepakatan_perdamaian');
            $table->string('hasil_mediasi');
            $table->string('isi_kesepakatan_perdamaian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mediasis', function (Blueprint $table) {
            //
        });
    }
};
