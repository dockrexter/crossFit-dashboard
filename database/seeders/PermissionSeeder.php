<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions =  [
            [
                'name' => 'Dashboard',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Users Management',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
            ],
        ];
        
        Permission::insert($permissions);
    }
}
