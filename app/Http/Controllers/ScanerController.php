<?php

namespace App\Http\Controllers;

use App\Models\Events;

class ScanerController extends Controller {
    public function index() {
//        $data['events'] = Event::where('template',0)->get();
        $data['events'] = Events::where('template',0)->where('stop','>',now())->get();

        return view('scaner.index',$data);
    }
}
