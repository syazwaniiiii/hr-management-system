<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\EmployeeSalary;
use App\Models\EmployeeShift;
use App\Models\Globals;
use App\Models\Manager;
use App\Models\Position;
use App\Models\Shift;
use Spatie\Permission\Models\Role;

class StarterSeeder extends Seeder
{
    public function run(): void
    {
        Globals::create([
            'organization_name' => 'MY Solutions Sdn Bhd',
            'organization_address' => 'Lot 88, Jalan Ampang, Kuala Lumpur, Malaysia',
            'absence_limit' => 30,
            'email' => 'admin@mysolutions.my',
        ]);

        $branch = Branch::factory()->create([
            'name' => 'Ibu Pejabat Kuala Lumpur',
        ]);

        $department = Department::create([
            'name' => 'Sumber Manusia',
        ]);

        Position::create([
            'name' => 'Pengurus HR',
            'description' => 'Bertanggungjawab atas semua aktiviti sumber manusia',
        ]);

        Shift::create([
            'name' => "Syif Pagi",
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
        ]);

        $root = Employee::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@mysolutions.my',
            'phone' => '0123456789',
            'national_id' => '900101145512',
            'hired_on' => '2023-01-25',
            'password' => bcrypt('password'),
            'branch_id' => 1,
            'department_id' => 1,
        ]);

        EmployeePosition::create([
            'employee_id' => 1,
            'position_id' => 1,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => null,
        ]);

        EmployeeShift::create([
            'employee_id' => 1,
            'shift_id' => 1,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => null,
        ]);

        EmployeeSalary::create([
            'employee_id' => 1,
            'currency' => 'MYR',
            'salary' => 8000,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => null,
        ]);

        Manager::create([
            'employee_id' => 1,
            'branch_id' => 1,
            'department_id' => null,
        ]);
        Manager::create([
            'employee_id' => 1,
            'branch_id' => null,
            'department_id' => 1,
        ]);

        $roles = ['admin', 'employee'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $knighthood = Role::findByName('admin');
        $root->assignRole($knighthood);
    }
}