<?php

namespace App\Repositories\Attendance;

use App\Models\Attendance;

/**
 * Class AttendanceRepository.
 */
class AttendanceRepository implements AttendanceInterface
{
    public function getAll() : object
    {
        $query = Attendance::query();
        return $query->paginate(10);
    }

    public function getById(int $id) : object
    {
        return Attendance::find($id);
    }

    public function store(array $data) : object
    {
        return Attendance::create($data);
    }

    public function update(int $id, array $data) : bool
    {
        return Attendance::whereId($id)->update($data);
    }

    public function destroy(int $id) : bool
    {
        return Attendance::destroy($id);
    }

    public function getByEmployeeId(int $empId) : object
    {
        
        return Attendance::where('employee_id',$empId)
        ->groupBy('employee_id')
        ->count();
    }
}
