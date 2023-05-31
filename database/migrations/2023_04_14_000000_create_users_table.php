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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('code')->unique();
            $table->string('fullname', 50)->nullable();
            $table->string('phone_number', 20)->unique();
            $table->string('email', 50)->unique();
            $table->string('password', 255);
            $table->timestamp('day_of_birth')->nullable();
            $table->string('address', 100)->nullable();
            $table->enum('level', ['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5']);
            $table->string('note', 255)->nullable();
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
