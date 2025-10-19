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
        Schema::table('users', function(Blueprint $table){
            $table->primary('id');
            $table->dropUnique('users_id_user_type_unique');
            $table->unsignedBigInteger('user_id')->after('id')->nullable();
            $table->string('user_type')->after('user_id')->nullable()->change();
            $table->unique(['user_id', 'user_type']);
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
