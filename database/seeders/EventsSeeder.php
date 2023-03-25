<?php

namespace Database\Seeders;

use App\Models\Events;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $events = DB::connection('mysql_old')->table('events')->get();
        foreach ($events as $event) {
            $ev = Events::create([
                'id'                => $event->id,
                'exhibition_id'     => $event->exhibition_id,
                'name_uk'           => $event->name_ua,
                'name_ru'           => $event->name_ru,
                'name_en'           => $event->name_en,
                'description_uk'    => $event->description_ua,
                'description_ru'    => $event->description_ru,
                'description_en'    => $event->description_en,
                'location_uk'       => $event->location_ua,
                'location_ru'       => $event->location_ru,
                'location_en'       => $event->location_en,
                'logo_path'         => $event->logo_path,
                'logo_name'         => $event->logo_name,
                'ticket_temp_path'  => $event->ticket_temp_path,
                'ticket_temp_name'  => $event->ticket_temp_name,
                'start'             => $event->start,
                'stop'              => $event->stop,
                'can_promo'         => 1,
                'can_card'          => 1,
                'can_invoice'       => 0,
                'pay_uah'           => 1,
                'pay_euro'          => 0,
                'pay_usd'           => 0,
                'price_uah'         => $event->price,
                'price_euro'        => 0,
                'price_usd'         => 0,
                'template'          => $event->template,
                'created_at'        => $event->created_at,
                'updated_at'        => $event->updated_at,
            ]);
        }
    }
}
