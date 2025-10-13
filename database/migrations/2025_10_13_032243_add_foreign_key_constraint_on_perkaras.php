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
        Schema::connection('mediasiapp_conn')->table('mediators', function (Blueprint $table) {
            $table->integer('id')->change();
        });

        Schema::connection('mediasiapp_conn')->table('perkaras', function (Blueprint $table) {
            $table->integer('mediator_id')->nullable()->change();
            $table->foreign('mediator_id')->references('id')->on('mediators');
        });


        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
