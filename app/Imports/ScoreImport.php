<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Score;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ScoreImport implements ToCollection
{
    private int $courseId;

    public function __construct(int $courseId)
    {
        $this->courseId = $courseId;
    }

    public function collection(Collection $rows): void
    {
        $course = Course::find($this->courseId);
        if (!$course) {
            return;
        }

        foreach ($rows as $row) {
            $studentCode = trim((string) ($row[1] ?? ''));

            // Bỏ qua các dòng tiêu đề/ghi chú không phải dữ liệu sinh viên.
            if ($studentCode === '' || !preg_match('/^\d+$/', $studentCode)) {
                continue;
            }

            $student = User::where('login_code', $studentCode)->first();
            if (!$student) {
                continue;
            }

            $course->students()->syncWithoutDetaching([$student->id]);

            Score::updateOrCreate(
                [
                    'course_id' => $this->courseId,
                    'student_id' => $student->id,
                ],
                [
                    'tx1' => $this->toNullableNumber($row[8] ?? null),
                    'tx2' => $this->toNullableNumber($row[9] ?? null),
                    'tx3' => $this->toNullableNumber($row[10] ?? null),
                    'tx4' => $this->toNullableNumber($row[11] ?? null),
                    'tx5' => $this->toNullableNumber($row[12] ?? null),
                    'tx6' => $this->toNullableNumber($row[13] ?? null),
                    'exam1' => $this->toNullableNumber($row[15] ?? null),
                    'exam2' => $this->toNullableNumber($row[16] ?? null),
                    'final1' => $this->toNullableNumber($row[17] ?? null),
                    'final2' => $this->toNullableNumber($row[18] ?? null),
                    'rank' => $this->toNullableText($row[19] ?? null),
                    'note' => $this->toNullableText($row[20] ?? null),
                ]
            );
        }
    }

    private function toNullableNumber($value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        $normalized = str_replace(',', '.', (string) $value);
        return is_numeric($normalized) ? (float) $normalized : null;
    }

    private function toNullableText($value): ?string
    {
        $text = trim((string) $value);
        return $text === '' ? null : $text;
    }
}

