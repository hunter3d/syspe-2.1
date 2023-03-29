<?php
# (c) PremierExpo 2022
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Exhibition;
use Illuminate\Support\Facades\App;

//use Illuminate\Support\Facades\App;

class ExhibitionsController extends Controller
{
    public function index()
    {
        $lang = App::currentLocale();
        $exhibitions = Exhibition::where('template',0)->orderBy('name','ASC')->get();
        return response()->json([
            'status' => true,
            'exhibitions' => $exhibitions
        ]);
    }

//    public function show($id)
//    {
//        //$lang = App::currentLocale();
//        $exhibition = Exhibition::findorfail($id);
//        return response()->json($exhibition);
//    }
}
