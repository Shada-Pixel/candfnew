<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Global uniqueness on be_number prevented reusing the same B/E number in a new calendar year.
     * Uniqueness per year is enforced in application validation (created_at year).
     */
    public function up(): void
    {
        Schema::table('file_datas', function (Blueprint $table) {
            $table->dropUnique(['be_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_datas', function (Blueprint $table) {
            $table->unique('be_number');
        });
    }
};
