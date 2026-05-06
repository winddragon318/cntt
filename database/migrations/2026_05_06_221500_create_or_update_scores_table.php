<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            Schema::create('scores', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
                $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();

                $table->decimal('tx1', 4, 2)->nullable();
                $table->decimal('tx2', 4, 2)->nullable();
                $table->decimal('tx3', 4, 2)->nullable();
                $table->decimal('tx4', 4, 2)->nullable();
                $table->decimal('tx5', 4, 2)->nullable();
                $table->decimal('tx6', 4, 2)->nullable();
                $table->decimal('exam1', 4, 2)->nullable();
                $table->decimal('exam2', 4, 2)->nullable();
                $table->decimal('final1', 4, 2)->nullable();
                $table->decimal('final2', 4, 2)->nullable();
                $table->string('rank', 50)->nullable();
                $table->text('note')->nullable();
                $table->timestamps();

                $table->unique(['course_id', 'student_id']);
            });

            return;
        }

        Schema::table('scores', function (Blueprint $table) {
            if (!Schema::hasColumn('scores', 'course_id')) {
                $table->foreignId('course_id')->nullable()->after('id')->constrained('courses')->cascadeOnDelete();
            }
            if (!Schema::hasColumn('scores', 'student_id')) {
                $table->foreignId('student_id')->nullable()->after('course_id')->constrained('users')->cascadeOnDelete();
            }

            foreach (['tx1', 'tx2', 'tx3', 'tx4', 'tx5', 'tx6', 'exam1', 'exam2', 'final1', 'final2'] as $column) {
                if (!Schema::hasColumn('scores', $column)) {
                    $table->decimal($column, 4, 2)->nullable();
                }
            }

            if (!Schema::hasColumn('scores', 'rank')) {
                $table->string('rank', 50)->nullable();
            }
            if (!Schema::hasColumn('scores', 'note')) {
                $table->text('note')->nullable();
            }
        });

        foreach (['teacher_id', 'class_id', 'subject_id'] as $legacyFk) {
            if (!Schema::hasColumn('scores', $legacyFk)) {
                continue;
            }

            $constraint = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->select('CONSTRAINT_NAME')
                ->whereRaw('TABLE_SCHEMA = DATABASE()')
                ->where('TABLE_NAME', 'scores')
                ->where('COLUMN_NAME', $legacyFk)
                ->whereNotNull('REFERENCED_TABLE_NAME')
                ->value('CONSTRAINT_NAME');

            if ($constraint) {
                DB::statement("ALTER TABLE `scores` DROP FOREIGN KEY `{$constraint}`");
            }

            Schema::table('scores', function (Blueprint $table) use ($legacyFk) {
                $table->dropColumn($legacyFk);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('scores')) {
            Schema::dropIfExists('scores');
        }
    }
};

