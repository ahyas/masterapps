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
        Schema::connection('mediasiapp_conn')->table('mediasi_perkara', function(Blueprint $table){
            $table->dropForeign(['perkara_id']);
            $table->dropForeign(['mediasi_id']);
        });

        Schema::connection('mediasiapp_conn')->dropIfExists('mediasi_perkara');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
