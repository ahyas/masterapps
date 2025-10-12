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
            $table->foreign('perkara_id')->references('id')->on('perkaras')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['perkara_id', 'pihak_id']);
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
