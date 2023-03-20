<?php

namespace Database\Seeders;

use App\Models\Countries;
use App\Models\Promocodes;
use App\Models\Regions;
use App\Models\Topics;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PromocodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $topics = DB::connection('mysql_old')->table('promocodes')->get();
        foreach ($topics as $r) {
            $c = Promocodes::create([
                'id'                => $r->id,
                'event_id'          => $r->event_id,
                'code'              => $r->code,
                'description'       => $r->description,
                'price_uah'         => $r->price,
                'price_euro'        => 0,
                'price_usd'         => 0,
            ]);
        }
    }
}
