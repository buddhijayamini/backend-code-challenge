<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Attendance\AttendanceInterface;
use App\Repositories\Attendance\AttendanceRepository;
use App\Repositories\Employee\EmployeeInterface;
use App\Repositories\Employee\EmployeeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);
        $this->app->bind(AttendanceInterface::class, AttendanceRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
