<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Bước 1: Xóa khóa ngoại và đổi tên cột
        Schema::table('posts', function (Blueprint $table) {
            // Tên khóa ngoại mặc định thường là: posts_category_id_foreign
            $table->dropForeign(['category_id']);
            $table->renameColumn('category_id', 'categories');
        });

        // Bước 2: Thay đổi kiểu dữ liệu thành String để lưu tên danh mục
        Schema::table('posts', function (Blueprint $table) {
            $table->string('categories')->nullable()->change();
        });

        // Bước 3: Xóa bảng categories
        Schema::dropIfExists('categories');
    }

    public function down(): void
    {
        // Thường không cần thiết nếu bạn đã xác định xóa hẳn bảng
    }
};
