<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    public function index()
    {
        $data['visitors'] = Visitor::sortable()->orderBy('id','DESC')->paginate(50);
        $data['total'] = $data['visitors']->total();
        return view('visitors.index',$data);
    }
}
