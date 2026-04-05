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
        Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title'); // Tiêu đề bài viết
    $table->string('slug')->unique();
    $table->text('summary')->nullable(); // Tóm tắt ngắn
    $table->longText('content'); // Nội dung (Dùng cho CKEditor)
    $table->string('thumbnail')->nullable(); // Ảnh đại diện bài viết
    $table->integer('views')->default(0); // Lượt xem
    $table->boolean('is_featured')->default(false); // Tin nổi bật hay không

    // Khóa ngoại
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Người đăng

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
