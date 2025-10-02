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
        Schema::create('perkaras', function (Blueprint $table) {
            $table->id();
            $table->string('no_perkara');
            $table->string('tgl_register');
            $table->unsignedBigInteger('klasifikasiperkara_id');
            $table->foreign('klasifikasiperkara_id')->references('id')->on('klasifikasiperkaras')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('statusperkara_id');
            $table->foreign('statusperkara_id')->references('id')->on('statusperkaras')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkara');
    }
};
