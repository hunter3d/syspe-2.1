<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vvv = DB::connection('mysql_old')->table('permissions')->get();

        foreach ($vvv as $v) {
            DB::connection('mysql')->table('permissions')->insert(get_object_vars($v));
        }
    }
}
