<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dept = [
            'name' => 'N/A',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'IT',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'AUDIT',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'TEST',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'ADMIN',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'AP',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'AR',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'BT/RAYMOND',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'C&C',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'HR',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'INVOICING',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'PARTS',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'PDI/WARRANTY',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'PURCHASER',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'RENTAL',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'SALES',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'SALES SUPPORT',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'SCHENKER',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'SERVICE',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'TECHNICAL',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'TRAINING',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'TRANSPORT',
        ];
        Department::create($dept);

        $dept = [
            'name' => 'WORKSHOP',
        ];
        Department::create($dept);
    }
}
