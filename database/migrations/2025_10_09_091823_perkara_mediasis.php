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
        Schema::connection('mediasiapp_conn')->create('perkara_mediasis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tahapan_id')->nullable();
            $table->unsignedBigInteger('perkara_id');
            $table->foreign('perkara_id')->references('id')->on('perkaras')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('jenis_mediasi')->nullable();
            $table->unsignedBigInteger('mediator_id');
            $table->foreign('mediator_id')->references('id')->on('mediators')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
