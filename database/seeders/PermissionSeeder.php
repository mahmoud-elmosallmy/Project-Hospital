<?php

namespace Database\Seeders;

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
            // Contact Message
            [
                "name" => "setting.view",
                "description" => "view Setting",
            ],
            [
                "name" => "setting.update",
                "description" => "Update Setting",
            ],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
