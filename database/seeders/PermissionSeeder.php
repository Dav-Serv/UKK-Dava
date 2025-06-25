<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::UpdateOrCreate([
            'name' => 'admin',
        ],
        ['name' => 'admin']
        );

        $role_writer = Role::UpdateOrCreate([
            'name' => 'writer',
        ],
        ['name' => 'writer']
        );

        $role_guest = Role::UpdateOrCreate([
            'name' => 'guest',
        ],
        ['name' => 'guest']
        );

        $permission = Permission::UpdateOrCreate([
            'name' => 'view_dashboard',
        ],
        ['name' => 'view_dashboard']
        );

        $permission2 = Permission::UpdateOrCreate([
            'name' => 'view_chart_on_dashboard',
        ],
        ['name' => 'view_chart_on_dashboard']
        );

    $role_admin->givePermissionTo($permission);
    $role_admin->givePermissionTo($permission2);
    $role_writer->givePermissionTo($permission2);  

    // $user = User::find(4);

    // $user->assignrole(['admin']);
    }
}
