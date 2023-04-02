<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Support\Facades\App;

class EventsController extends Controller
{
    public function index() {
        $lang = App::currentLocale();
        $events = Events::select('id','exhibition_id','name_'.$lang.' AS name','description_'.$lang.' AS description','location_'.$lang.' AS location','logo_path','logo_name','start','stop')->where('template',0)->orderBy('start','ASC')->limit(12)->get();
        return response()->json([
            'status' => true,
            'events' => $events,
        ]);
    }
//    public function show($id)
//    {
//        $lang = App::currentLocale();
//        $event = Events::select('id','exhibition_id','name_'.$lang.' AS name','description_'.$lang.' AS description','location_'.$lang.' AS location','logo_path','logo_name','start','stop','price')->where('id',$id)->first();
//        if ( $event ) {
//            return response()->json([
//                'status' => true,
//                'event' => $event,
//            ],200);
//        } else {
//            return response()->json([
//                'status' => false,
//            ],200);
//        }
//    }

//    public function status( $event_id ) {
//        // check QA+O+T
//        $qa     = Answers::where('visitor_id', Auth::guard('api')->id())->where('event_id', $event_id)->first();
//        $order  = Orders::where('visitor_id', Auth::guard('api')->id())->where('event_id', $event_id)->first();
//        $ticket = Tickets::where('visitor_id', Auth::guard('api')->id())->where('event_id', $event_id)->first();
//
//        // corrector 1 ticket not generated
//        if ( $qa && $order && $order->status == 'complete' && !$ticket) {
//            // clear $order
//            $order->delete();
//            // clear $qa
//            $qa->delete();
//            return request()->json([
//                'status' => true // new QA->O->T
//            ], 200);
//        }
//
//        if ( $qa ) {
//            return request()->json([
//                'status' => false // QA->O->T
//            ], 200);
//        } else {
//            return request()->json([
//                'status' => true // QA exist
//            ], 200);
//        }
//    }
}
