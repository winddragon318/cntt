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
        if (!Schema::hasTable('courses')) {
            return;
        }

        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'classroom')) {
                $table->string('classroom', 100)->nullable()->after('code');
            }
            if (!Schema::hasColumn('courses', 'semester')) {
                $table->string('semester', 50)->nullable()->after('classroom');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('courses')) {
            return;
        }

        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'semester')) {
                $table->dropColumn('semester');
            }
            if (Schema::hasColumn('courses', 'classroom')) {
                $table->dropColumn('classroom');
            }
        });
    }
};

