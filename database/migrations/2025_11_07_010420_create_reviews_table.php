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
        Schema::connection('mediasiapp_conn')->create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perkara_id');
            $table->integer('mediator_id');
            $table->foreign('mediator_id')->references('id')->on('mediators')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('perkara_id')->references('id')->on('perkaras')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('rating')->comment('1-5 stars');
            $table->text('testimony')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
