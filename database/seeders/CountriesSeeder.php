<?php

namespace Database\Seeders;

use App\Models\Countries;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $countries = DB::connection('mysql_old')->table('cardcountries')->get();
        foreach ($countries as $country) {
            $c = Countries::create([
                'id'        => $country->id,
                'code'      => $country->code,
                'name_uk'   => $country->name_ua,
                'name_ru'   => $country->name_ru,
                'name_en'   => $country->name_en,
                'created_at' => $country->created_at,
            ]);
        }
    }
}
