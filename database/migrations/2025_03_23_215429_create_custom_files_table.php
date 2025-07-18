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
        Schema::create('custom_files', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('be_number')->nullable();
            $table->string('fees')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('agent_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_files');
    }
};
