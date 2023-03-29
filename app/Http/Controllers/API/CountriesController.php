<?php
# (c) PremierExpo 2022
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cardcountry;
use App\Models\Countries;
use Illuminate\Support\Facades\App;

class CountriesController extends Controller
{
    public function index()
    {
        $lang = App::currentLocale();
        $countries = Countries::select('id','code','name_'.$lang.' AS name','created_at','updated_at')->orderBy('name_'.$lang,'ASC')->get();

        return response()->json([
            'status' => true,
            'countries' => $countries
        ]);
    }
}
