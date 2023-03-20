<?php

namespace Database\Seeders;

use App\Models\Answeroptions;
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

class AnsweroptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $topics = DB::connection('mysql_old')->table('answeroptions')->get();
        foreach ($topics as $r) {
            $c = Answeroptions::create([
                'id'                => $r->id,
                'questionnaire_id'  => $r->questionnaire_id,
                'answer_uk'         => $r->answer_ua,
                'answer_ru'         => $r->answer_ru,
                'answer_en'         => $r->answer_en,
                'order'             => $r->order,
            ]);
        }
    }
}
