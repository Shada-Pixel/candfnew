<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IF there is no permission
        if (Permission::count() <=0) {
            // Permission list in array
            $permissions = [
                'admin-dash', 'user-list', 'user-create', 'user-edit', 'user-delete',
                'permission-list', 'permission-create', 'permission-edit', 'permission-delete',
                'role-list', 'role-create', 'role-edit', 'role-delete',
                'category-list', 'category-create', 'category-edit', 'category-delete',
                'enrollment-list', 'enrollment-create', 'enrollment-edit', 'enrollment-delete',
                'service-list', 'service-create', 'service-edit', 'service-delete',
                'album-list', 'album-create', 'album-edit', 'album-delete',
                'photo-list', 'photo-create', 'photo-edit', 'photo-delete',
                'subscriber-list', 'subscriber-create', 'subscriber-edit', 'subscriber-delete',
                'newsletter-list', 'newsletter-create', 'newsletter-edit', 'newsletter-delete',
                'queries-list', 'queries-create', 'queries-edit', 'queries-delete',
                'batch-list', 'batch-create', 'batch-edit', 'batch-delete',
                'quotation-list', 'quotation-create', 'quotation-edit', 'quotation-delete',
                'course-list', 'course-create', 'course-edit', 'course-delete',
                'agent-list', 'agent-create', 'agent-edit', 'agent-delete',
            ];
            // Creating permissions
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
