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
        $admin = Role::firstOrCreate(["name" => "Admin"] , ["description" => "Admin role"]);
        $doctor = Role::firstOrCreate(["name" => "Doctor"] , ["description" => "Doctor role"]);
        $reception = Role::firstOrCreate(["name" => "Reception"] , ["description" => "Reception role"]);
        $patient = Role::firstOrCreate(["name" => "Patient"] , ["description" => "Patient role"]);

        // Permissions
        $permissions = Permission::all()->keyBy("name");

        // Admin
        $admin->permissions()->sync(Permission::pluck("id")->toArray());
        // Doctor
        $doctor->permissions()->sync([
            $permissions['departments.view']->id,
            $permissions['doctor_departments.view']->id,
            $permissions['services.view']->id,
            $permissions['doctors.view']->id,
            $permissions['doctor_schedules.view']->id,
            $permissions['doctor_schedules.update']->id,
            $permissions['appointments.view']->id,
            $permissions['appointments.update']->id,
            $permissions['patients.view']->id,
            $permissions['medical_records.view']->id,
            $permissions['medical_records.create']->id,
            $permissions['medical_records.update']->id,
            $permissions['notifications.view']->id,
        ]);

        // Reception
        $reception->permissions()->sync([
            $permissions['departments.view']->id,
            $permissions['doctor_departments.view']->id,
            $permissions['messages.view']->id,
             $permissions['messages.update']->id,
            $permissions['services.view']->id,
            $permissions['doctors.view']->id,
            $permissions['doctor_schedules.view']->id,
            $permissions['patients.view']->id,
            $permissions['patients.create']->id,
            $permissions['patients.update']->id,
            $permissions['appointments.view']->id,
            $permissions['appointments.create']->id,
            $permissions['appointments.update']->id,
            $permissions['appointments.delete']->id,
            $permissions['notifications.view']->id,
        ]);

         // Patient
        $patient->permissions()->sync([
            $permissions['departments.view']->id,
            $permissions['services.view']->id,
            $permissions['doctors.view']->id,
            $permissions['doctor_schedules.view']->id,
            $permissions['appointments.view']->id,
            $permissions['appointments.create']->id,
            $permissions['medical_records.view']->id,
            $permissions['notifications.view']->id,

            ]);
    }
}
