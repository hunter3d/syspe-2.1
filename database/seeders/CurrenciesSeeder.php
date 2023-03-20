<?php

namespace Database\Seeders;

use App\Models\Currencies;
use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = Currencies::create([
            'name_ru' => 'грн',
            'name_uk' => 'грн',
            'name_en' => 'uah'
        ]);
        $c = Currencies::create([
            'name_ru' => 'евро',
            'name_uk' => 'євро',
            'name_en' => 'euro'
        ]);
        $c = Currencies::create([
            'name_ru' => 'us долл',
            'name_uk' => 'us дол',
            'name_en' => 'usd'
        ]);
    }
}
