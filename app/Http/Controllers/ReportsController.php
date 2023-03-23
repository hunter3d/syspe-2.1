<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Exhibition;
use App\Models\Visitor;
use Illuminate\Http\Request;

class ReportsController extends Controller {
    public function notickets(Request $request) {
        $visitors = Visitor::doesntHave('tickets')->get();
        $data['visitors'] = $visitors;
        if ( $request->exhb ) $data['fexhb'] = $request->exhb;
        else $data['fexhb'] = NULL;
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        return view('reports.notickets',$data);
    }
}
