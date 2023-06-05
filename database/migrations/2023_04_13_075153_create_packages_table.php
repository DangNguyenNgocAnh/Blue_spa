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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->enum('level_applied', ['level 1', 'level 2', 'level 3', 'level 4', 'level 5']);
            $table->unsignedInteger('code')->unique();
            $table->integer('price');
            $table->enum('status', ['Coming', 'Closed', 'Pending'])->nullable();
            $table->enum('types', ['Basic', 'Standard', 'Premium', 'Trial', 'Special'])->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
