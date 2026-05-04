<?php
namespace App\Imports;

use App\Models\User;
use App\Models\Role;
use App\Models\Classes;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class StudentImport implements ToModel, WithStartRow
{
    protected $classId;

    public function __construct($classId)
    {
        $this->classId = $classId;
    }

    // Bắt đầu đọc dữ liệu từ dòng số 5 (bỏ qua tiêu đề ở dòng 4)
    public function startRow(): int
    {
        return 5;
    }

    public function model(array $row)
    {
        // $row[0] -> STT
        // $row[1] -> Mã SV
        // $row[2] -> Họ đệm
        // $row[3] -> Tên
        // $row[4] -> Ngày sinh
        // $row[5] -> Giới tính (FALSE/TRUE)

        if (empty($row[1])) {
            return null;
        }

        // 1. Tạo User
        $student = User::create([
            'name'       => $row[2] . ' ' . $row[3],
            'login_code' => (string)$row[1],
            'email'      => $row[1] . '@gmail.com', // Hoặc domain của trường bạn
            'password'   => Hash::make('12345'),
            'birthday'   => $this->transformDate($row[4]),
            // Giới tính: FALSE là Nam (0), TRUE là Nữ (1)
            'gender'     => ($row[5] === true || strtoupper($row[5]) == 'TRUE') ? 1 : 0,
        ]);

        // 2. Gán quyền 'student'
        $role = Role::where('name', 'student')->first();
        if ($role) {
            $student->roles()->attach($role->id);
        }

        // 3. Liên kết lớp học
        $student->classes()->attach($this->classId);

        return $student;
    }

    // Hàm xử lý ngày tháng để không bị lỗi định dạng Excel
    private function transformDate($value)
    {
        try {
            if (is_numeric($value)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            }
            return Carbon::createFromFormat('d/m/Y', $value);
        } catch (\Exception $e) {
            return null; // Hoặc giá trị mặc định
        }
    }
}
