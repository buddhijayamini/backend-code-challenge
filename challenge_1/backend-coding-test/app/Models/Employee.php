<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'tbl_employees';
    protected $guarded = [];

    public function attendances(){
        return $this->hasMany(Attendance::class,'employee_id');
    }

}
