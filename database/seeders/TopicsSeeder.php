<?php

namespace Database\Seeders;

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

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $topics = DB::connection('mysql_old')->table('cardtopics')->get();
        foreach ($topics as $r) {
            $c = Topics::create([
                'id'            => $r->id,
                'exhibition_id' => $r->exhibition_id,
                'name_uk'       => $r->name_ua,
                'name_ru'       => $r->name_ru,
                'name_en'       => $r->name_en,
                'template'      => $r->template,
            ]);
        }
    }
}
