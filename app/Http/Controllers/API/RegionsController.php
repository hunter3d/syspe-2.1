<?php
# (c) PremierExpo 2022
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Regions;
use Illuminate\Support\Facades\App;

class RegionsController extends Controller
{
    public function index()
    {
        $lang = App::currentLocale();
        $regions = Regions::select('id','name_'.$lang.' AS name','created_at','updated_at')->orderBy('name_'.$lang,'ASC')->get();

        return response()->json([
            'status' => true,
            'regions' => $regions
        ]);
    }
}
