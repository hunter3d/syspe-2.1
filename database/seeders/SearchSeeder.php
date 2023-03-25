<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$role = Role::findByName('Developer');
        //$perm = Permission::create(['name'=>'search cards']);
        //$role->givePermissionTo($perm);
        //$perm = Permission::create(['name'=>'search logs']);
        //$role->givePermissionTo($perm);
    }
}
