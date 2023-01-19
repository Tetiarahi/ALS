<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'employee_create',
            ],
            [
                'id'    => 18,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 19,
                'title' => 'employee_show',
            ],
            [
                'id'    => 20,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 21,
                'title' => 'employee_access',
            ],
            [
                'id'    => 22,
                'title' => 'qualification_create',
            ],
            [
                'id'    => 23,
                'title' => 'qualification_edit',
            ],
            [
                'id'    => 24,
                'title' => 'qualification_show',
            ],
            [
                'id'    => 25,
                'title' => 'qualification_delete',
            ],
            [
                'id'    => 26,
                'title' => 'qualification_access',
            ],
            [
                'id'    => 27,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 28,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 29,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 30,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 31,
                'title' => 'spa_create',
            ],
            [
                'id'    => 32,
                'title' => 'spa_edit',
            ],
            [
                'id'    => 33,
                'title' => 'spa_show',
            ],
            [
                'id'    => 34,
                'title' => 'spa_delete',
            ],
            [
                'id'    => 35,
                'title' => 'spa_access',
            ],
            [
                'id'    => 36,
                'title' => 'emp_work_status_create',
            ],
            [
                'id'    => 37,
                'title' => 'emp_work_status_edit',
            ],
            [
                'id'    => 38,
                'title' => 'emp_work_status_show',
            ],
            [
                'id'    => 39,
                'title' => 'emp_work_status_delete',
            ],
            [
                'id'    => 40,
                'title' => 'emp_work_status_access',
            ],
            [
                'id'    => 41,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
