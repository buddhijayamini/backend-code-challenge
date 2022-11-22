<?php

namespace App\Repositories\Attendance;

interface AttendanceInterface
{
    public function getAll() : object;
    public function getById(int $id) : object;
    public function store(array $data) : object;
    public function update(int $id, array $data) : bool;
    public function destroy(int $id) : bool;
}
