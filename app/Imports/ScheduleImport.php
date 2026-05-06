<?php

namespace App\Imports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class ScheduleImport implements ToModel
{
    // 1. Khai báo thuộc tính ở đây
    private $course_id;

    // 2. Tạo hàm khởi tạo để nhận ID từ Controller truyền sang
    public function __construct($course_id)
    {
        $this->course_id = $course_id;
    }

    public function model(array $row)
    {
        // Bỏ qua dòng tiêu đề nếu STT (cột 0) không phải là số
        if (!isset($row[0]) || !is_numeric($row[0])) {
            return null;
        }

        return new Schedule([
            'course_id'      => $this->course_id, // Bây giờ biến này đã tồn tại
            'stt'            => $row[0],
            // Xử lý ngày tháng từ Excel (Cột B trong Untitled_7.png)
            'date_on_class'  => is_numeric($row[1])
                                ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])
                                : Carbon::createFromFormat('d/m/Y', $row[1]),
            'theory_hours'   => $row[2] ?? 0,
            'practice_hours' => $row[3] ?? 0,
            'test_hours'     => $row[4] ?? 0,
            'content'        => $row[5] ?? '',
        ]);
    }
}
