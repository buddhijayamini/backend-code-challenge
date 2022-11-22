<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees =  [
            [
             'name' => 'aaa',
             'email' => 'aaa@gmail.com',
             'tel' => '0766667976',
             'address' => 'aaa,bbb,ccc',
             'status' => 1
            ],
            [
                'name' => 'bbb',
                'email' => 'bbb@gmail.com',
                'tel' => '076596455',
                'address' => 'bbb,ccc,ddd',
                'status' => 1
            ],
            [
                'name' => 'ccc',
                'email' => 'ccc@gmail.com',
                'tel' => '079563257',
                'address' => 'ddd,sss,qqq',
                'status' => 1
            ],
            [
                'name' => 'ddd',
                'email' => 'ddd@gmail.com',
                'tel' => '078563269',
                'address' => 'ccc,aaa,mmm',
                'status' => 1
            ],
            [
                'name' => 'sss',
                'email' => 'sss@gmail.com',
                'tel' => '074587632',
                'address' => 'mmm,ddd,www',
                'status' => 1
            ],
        ];

       Employee::insert($employees);
    }
}
