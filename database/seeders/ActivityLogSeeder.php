<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vvv = DB::connection('mysql_old')->table('activity_log')->get();

        DB::connection('mysql')->table('activity_log')->delete();
        foreach ($vvv as $v) {
            DB::connection('mysql')->table('activity_log')->insert(get_object_vars($v));
        }
    }
}
