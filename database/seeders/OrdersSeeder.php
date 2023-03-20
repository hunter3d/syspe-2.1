<?php

namespace Database\Seeders;

use App\Models\Countries;
use App\Models\Orders;
use App\Models\Regions;
use App\Models\Topics;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $topics = DB::connection('mysql_old')->table('orders')->get();
        foreach ($topics as $r) {
            $c = Orders::create([
                'id'            => $r->id,
                'visitor_id'    => $r->visitor_id,
                'exhibition_id' => $r->exhibition_id,
                'event_id'      => $r->event_id,
                'promocode_id'  => $r->promocode_id,
                'number'        => $r->number,
                'pay_method'    => 'promocode',
                'price'         => $r->price,
                'currency_id'      => 1,
                'status'        => $r->status,
            ]);
        }
    }
}
