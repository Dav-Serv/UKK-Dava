<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::UpdateOrCreate([
            'name' => 'pelanggan',
        ]
        );

        Role::UpdateOrCreate([
            'name' => 'admin',
        ]
        );
        // Role::UpdateOrCreate([
        //         'name' => 'writer',
        //     ],
        //     ['name' => 'writer']
        // );
        // Role::UpdateOrCreate([
        //     'name' => 'guest',
        // ],
        // ['name' => 'guest']
        // );

        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'writer']);
    }
}
