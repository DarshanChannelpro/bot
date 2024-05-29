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
        Schema::table('flowtable', function (Blueprint $table) {
            $table->integer('type')->default(1)->comment('1- Just a quick reply, 2-on exact match, 3-on contains');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flowtable', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
