<?php

namespace App\Repositories\Employee;

use App\Models\Employee;

/**
 * Class EmployeeRepository.
 */
class EmployeeRepository implements EmployeeInterface
{
    public function getAll() : object
    {
        $query = Employee::query();
        return $query->paginate(10);
    }

    public function getById(int $id) : object
    {
        return Employee::find($id);
    }

    public function store(array $data) : object
    {
        return Employee::create($data);
    }

    public function update(int $id, array $data) : bool
    {
        return Employee::whereId($id)->update($data);
    }

    public function destroy(int $id) : bool
    {
        return Employee::destroy($id);
    }
}
