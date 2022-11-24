<?php

namespace App\Services;

use App\Models\Attendance\Domain\Attendance;

class AttendanceService{

    public function getAll()
    {
        return Attendance::all();
    }

    public function importExcel(array $data) : Attendance
    {
        return Attendance::create([
            'employee_id' => $data['employee_id'],
            'date' => $data['date'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out']
        ]);
    }
}
