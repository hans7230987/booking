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
        Schema::table('venues', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('name'); // 新增 phone 欄位
            $table->dropColumn('capacity');                     // 刪除 capacity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venues', function (Blueprint $table) {
            $table->integer('capacity')->default(0)->after('name'); // 回復 capacity
            $table->dropColumn('phone');
        });
    }
};
