<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role
        $admin = Role::where("name","Admin")->FirstOrFail();
        $doctor = Role::where("name","Doctor")->FirstOrFail();
        $reception = Role::where("name","Reception")->FirstOrFail();
        $patient = Role::where("name","Patient")->FirstOrFail();

        // Permissions
        $permissions = Permission::all()->keyBy("name");

        // Admin
        $admin->permissions()->sync([
            $permissions['departments.veiw']->id,
            $permissions['departments.create']->id,
            $permissions['departments.update']->id,
            $permissions['departments.delete']->id,

            $permissions['doctor_departments.veiw']->id,
            $permissions['doctor_departments.create']->id,
            $permissions['doctor_departments.update']->id,
            $permissions['doctor_departments.delete']->id,

            $permissions['messages.veiw']->id,
            $permissions['messages.create']->id,
            $permissions['messages.update']->id,
            $permissions['messages.delete']->id,

            $permissions['setting.veiw']->id,
            $permissions['setting.update']->id,
        ]);
        // Doctor
        $doctor->permissions()->sync([
            $permissions['departments.veiw']->id,
            $permissions['doctor_departments.veiw']->id,
        ]);

        // Reception
        $reception->permissions()->sync([
            $permissions['departments.veiw']->id,
            $permissions['doctor_departments.veiw']->id,
            $permissions['messages.veiw']->id,
        ]);

         // Patient
        $patient->permissions()->sync([
            $permissions['departments.veiw']->id,

            ]);
    }
}
