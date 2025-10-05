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
        Schema::dropIfExists('app_permission');
        Schema::dropIfExists('app_role');
        Schema::dropIfExists('app_user');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permission_role');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
