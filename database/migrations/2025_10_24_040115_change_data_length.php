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
        Schema::connection('mediasiapp_conn')->table('mediasis', function (Blueprint $table) {
            $table->date('penetapan_penunjukan_mediator')->nullable()->change();
            $table->date('dimulai_mediasi')->nullable()->change();
            $table->date('keputusan_mediasi')->nullable()->change();
            $table->date('tgl_kesepakatan_perdamaian')->nullable()->change();
            $table->string('hasil_mediasi')->nullable()->change();
            $table->string('isi_kesepakatan_perdamaian', 1500)->nullable()->change();
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
