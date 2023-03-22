<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Exhibition;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index() {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Events::where('template',0)->get();
        $data['orders'] = Orders::sortable()->orderBy('id','DESC')->paginate(50);
        $data['total'] = $data['orders']->total();
        return view('orders.index',$data);
    }

    public function exhibition( $id ) {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Events::where('template',0)->get();
        $data['exhb'] = Exhibition::query()->find($id);
        $data['orders'] = Orders::sortable()->where('exhibition_id', $id)->paginate(50);
        $data['total'] = $data['orders']->total();
        return view('orders.exhibition',$data);
    }

    public function event($id) {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Events::where('template',0)->get();
        $data['evnt'] = Events::query()->find($id);
        $data['orders'] = Orders::sortable()->where('event_id',$id)->paginate(50);
        $data['total'] = $data['orders']->total();
        return view('orders.event',$data);
    }
}
