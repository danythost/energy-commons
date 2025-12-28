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
        Schema::table('zones', function (Blueprint $table) {
            $table->string('leader_name')->nullable();
            $table->string('leader_email')->nullable();
            $table->string('leader_phone')->nullable();
            $table->text('leader_home_address')->nullable();
            $table->string('leader_ada_wallet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->dropColumn(['leader_name', 'leader_email', 'leader_phone', 'leader_home_address', 'leader_ada_wallet']);
        });
    }
};
