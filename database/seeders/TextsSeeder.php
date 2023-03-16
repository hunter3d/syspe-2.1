<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::findByName('Developer');
        $perm = Permission::create(['name'=>'texts']);
        $role->givePermissionTo($perm);
        $perm = Permission::create(['name'=>'texts create']);
        $role->givePermissionTo($perm);
        $perm = Permission::create(['name'=>'texts update']);
        $role->givePermissionTo($perm);
        $perm = Permission::create(['name'=>'texts destroy']);
        $role->givePermissionTo($perm);
    }
}
