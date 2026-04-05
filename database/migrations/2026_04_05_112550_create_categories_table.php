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
        Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // Tên danh mục: Thông báo, Sự kiện...
    $table->string('slug')->unique(); // Để làm đường dẫn đẹp: tin-tuc-su-kien
    $table->integer('parent_id')->default(0); // Nếu muốn làm danh mục đa cấp
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
