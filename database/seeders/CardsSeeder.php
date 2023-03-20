<?php

namespace Database\Seeders;

use App\Models\Answeroptions;
use App\Models\Cards;
use App\Models\Countries;
use App\Models\Regions;
use App\Models\Topics;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $topics = DB::connection('mysql_old')->table('cards')->get();
        foreach ($topics as $r) {
            $c = Cards::create([
                'id'                => $r->id,
                'visitor_id'        => $r->visitor_id,
                'country_id'        => $r->cardcountry_id,
                'first_name'        => $r->first_name,
                'second_name'       => $r->second_name,
                'last_name'         => $r->last_name,
                'company'           => $r->company,
                'topic_id'          => $r->cardtopic_id,
                'position'          => $r->position,
                'post_code'         => $r->post_code,
                'region'            => $r->region,
                'district'          => $r->district,
                'city'              => $r->city,
                'street'            => $r->street,
                'house'             => $r->house,
                'office'            => $r->office,
                'status'            => $r->status,
                'created_at'        => $r->created_at,
            ]);
        }
    }
}
