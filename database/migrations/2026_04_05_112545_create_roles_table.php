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
        // Bảng Roles
Schema::create('roles', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // admin, editor, teacher
    $table->string('display_name'); // Quản trị viên, Giảng viên
    $table->timestamps();
});

// Bảng trung gian liên kết User và Role
Schema::create('role_user', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('role_id')->constrained()->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
