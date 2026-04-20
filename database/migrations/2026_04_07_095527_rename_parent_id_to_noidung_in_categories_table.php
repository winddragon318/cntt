<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('categories', function (Blueprint $table) {
        // Đổi tên cột và chuyển kiểu dữ liệu sang TEXT để chứa được nhiều nội dung
        $table->text('noidung')->nullable()->after('slug');
        $table->dropColumn('parent_id');
    });
}

public function down()
{
    Schema::table('categories', function (Blueprint $table) {
        $table->integer('parent_id')->default(0);
        $table->dropColumn('noidung');
    });
}
};
