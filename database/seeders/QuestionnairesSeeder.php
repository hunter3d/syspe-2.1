<?php

namespace Database\Seeders;

use App\Models\Countries;
use App\Models\Questionnaires;
use App\Models\Regions;
use App\Models\Topics;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class QuestionnairesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $q = DB::connection('mysql_old')->table('questionnaires')->get();
        foreach ($q as $r) {
            $c = Questionnaires::create([
                'id'                => $r->id,
                'exhibition_id'     => $r->exhibition_id,
                'type'              => $r->type,
                'question_uk'       => $r->name_ua,
                'question_ru'       => $r->name_ru,
                'question_en'       => $r->name_en,
                'template'          => $r->template,
            ]);
        }
    }
}
