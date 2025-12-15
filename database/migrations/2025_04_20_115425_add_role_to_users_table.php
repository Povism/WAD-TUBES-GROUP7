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
        // ===============1==============
        // Add 'role' column to 'users' table with enum type having values 'admin' and 'mahasiswa', default 'mahasiswa'.
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'mahasiswa'])->default('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
