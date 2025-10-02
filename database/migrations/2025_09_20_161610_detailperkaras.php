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
        Schema::create('detailperkaras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perkara_id');
            $table->foreign('perkara_id')->references('id')->on('perkaras')->onUpdate('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('status_id'); //penggugat/tergugat/pemohon
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
