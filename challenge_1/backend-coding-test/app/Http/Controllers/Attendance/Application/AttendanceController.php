<?php

namespace App\Http\Controllers\Attendance\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    public function index(AttendanceService $attendanceService)
    {
        $this->attendanceService->getAll();

    }

    public function store(AttendanceRequest $request, AttendanceService $attendanceService)
    {
       $attendanceService->importExcel($request->validated());
    }
}
