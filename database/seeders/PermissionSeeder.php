<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AuditLog;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Notification;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Departments
            [
                "name" => "departments.view",
                "description" => "view Departments",
            ],
            [
                "name" => "departments.create",
                "description" => "Create Departments",
            ],
            [
                "name" => "departments.update",
                "description" => "Update Departments",
            ],
            [
                "name" => "departments.delete",
                "description" => "Delete Departments",
            ],
            // Doctor Departments
            [
                "name" => "doctor_departments.view",
                "description" => "view Doctor Departments",
            ],
            [
                "name" => "doctor_departments.create",
                "description" => "Create Doctor Departments",
            ],
            [
                "name" => "doctor_departments.update",
                "description" => "Update Doctor Departments",
            ],
            [
                "name" => "doctor_departments.delete",
                "description" => "Delete Doctor Departments",
            ],
            // Contact Message
            [
                "name" => "messages.view",
                "description" => "view Contact messages",
            ],
            [
                "name" => "messages.create",
                "description" => "Create Contact messages",
            ],
            [
                "name" => "messages.update",
                "description" => "Update Contact messages",
            ],
            [
                "name" => "messages.delete",
                "description" => "Delete Contact messages",
            ],
            // Setting
            [
                "name" => "settings.view",
                "description" => "view Setting",
            ],
            [
                "name" => "settings.update",
                "description" => "Update Setting",
            ],
            // Users
            [
                "name" => "users.view",
                "description" => "view Users",
            ],
            [
                "name" => "users.create",
                "description" => "Create Users",
            ],
            [
                "name" => "users.update",
                "description" => "Update Users",
            ],
            [
                "name" => "users.delete",
                "description" => "Delete Users",
            ],
            // Services
            [
                "name"=>"services.view",
                "description" => "view Services",
            ],
            [
                "name"=>"services.create",
                "description" => "Create Services",
            ],
            [
                "name"=>"services.update",
                "description" => "Update Services",
            ],
            [
                "name"=>"services.delete",
                "description" => "Delete Services",
            ],
            // Roles
            [
                "name"=>"roles.view",
                "description" => "view Roles",
            ],
            [
                "name"=>"roles.create",
                "description" => "Create Roles",
            ],
            [
                "name"=>"roles.update",
                "description" => "Update Roles",
            ],
            [
                "name"=>"roles.delete",
                "description" => "Delete Roles",
            ],
            // patient 
            [
                "name"=>"patients.view",
                "description" => "view Patients",
            ],
            [
                "name"=>"patients.create",
                "description" => "Create Patients",
            ],
            [
                "name"=>"patients.update",
                "description" => "Update Patients",
            ],
            [
                "name"=>"patients.delete",
                "description" => "Delete Patients",
            ],
            // Notification 
            [
                "name"=>"notifications.view",
                "description" => "view Notifications",
            ],
            [
                "name"=>"notifications.create",
                "description" => "Create Notifications",
            ],
            [
                "name"=>"notifications.update",
                "description" => "Update Notifications",
            ],
            [
                "name"=>"notifications.delete",
                "description" => "Delete Notifications",
            ],
            // MedicalRecord 
            [
                "name"=>"medical_records.view",
                "description" => "view Medical Records",
            ],
            [
                "name"=>"medical_records.create",
                "description" => "Create Medical Records",
            ],
            [
                "name"=>"medical_records.update",
                "description" => "Update Medical Records",
            ],
            [
                "name"=>"medical_records.delete",
                "description" => "Delete Medical Records",
            ],
            // doctor_schedules 
            [
                "name"=>"doctor_schedules.view",
                "description" => "view Doctor Schedules",
            ],
            [
                "name"=>"doctor_schedules.create",
                "description" => "Create Doctor Schedules",
            ],
            [
                "name"=>"doctor_schedules.update",
                "description" => "Update Doctor Schedules",
            ],
            [
                "name"=>"doctor_schedules.delete",
                "description" => "Delete Doctor Schedules",
            ],
            // Doctor 
            [
                "name"=>"doctors.view",
                "description" => "view Doctors",
            ],
            [
                "name"=>"doctors.create",
                "description" => "Create Doctors",
            ],
            [
                "name"=>"doctors.update",
                "description" => "Update Doctors",
            ],
            [
                "name"=>"doctors.delete",
                "description" => "Delete Doctors",
            ],
            // AuditLog 
            [
                "name"=>"audit_logs.view",
                "description" => "view Audit Logs",
            ],
            [
                "name"=>"audit_logs.create",
                "description" => "Create Audit Logs",
            ],
            [
                "name"=>"audit_logs.update",
                "description" => "Update Audit Logs",
            ],
            [
                "name"=>"audit_logs.delete",
                "description" => "Delete Audit Logs",
            ],
            // Appointment 
            [
                "name"=>"appointments.view",
                "description" => "view Appointments",
            ],
            [
                "name"=>"appointments.create",
                "description" => "Create Appointments",
            ],
            [
                "name"=>"appointments.update",
                "description" => "Update Appointments",
            ],
            [
                "name"=>"appointments.delete",
                "description" => "Delete Appointments",
            ]
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
