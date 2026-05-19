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
            $table->boolean('is_updated_manualy')->default(false)->after('tahapan_deskripsi');
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
