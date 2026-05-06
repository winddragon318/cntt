<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('scores')) {
            return;
        }

        // Compatibility for legacy schema: old required columns break new import flow.
        if (Schema::hasColumn('scores', 'score')) {
            DB::statement('ALTER TABLE `scores` MODIFY `score` DECIMAL(4,2) NULL');
        }

        if (Schema::hasColumn('scores', 'semester')) {
            DB::statement('ALTER TABLE `scores` MODIFY `semester` TINYINT NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('scores')) {
            return;
        }

        if (Schema::hasColumn('scores', 'score')) {
            DB::statement('ALTER TABLE `scores` MODIFY `score` DECIMAL(4,2) NOT NULL');
        }

        if (Schema::hasColumn('scores', 'semester')) {
            DB::statement('ALTER TABLE `scores` MODIFY `semester` TINYINT NOT NULL');
        }
    }
};

