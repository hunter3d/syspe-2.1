<?php

namespace Database\Seeders;

use App\Models\Countries;
use App\Models\Regions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $regions = DB::connection('mysql_old')->table('cardregions')->get();
        foreach ($regions as $r) {
            $c = Regions::create([
                'id'        => $r->id,
                'name_uk'   => $r->name_ua,
                'name_ru'   => $r->name_ru,
                'name_en'   => $r->name_en,
                'created_at' => $r->created_at,
            ]);
        }
    }
}
