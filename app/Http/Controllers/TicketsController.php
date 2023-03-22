<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Exhibition;
use App\Models\Tickets;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class TicketsController extends Controller
{
    public function index() {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Events::where('template',0)->get();
        $data['tickets'] = Tickets::sortable()->orderBy('id','DESC')->paginate(50);
        $data['total'] = $data['tickets']->total();
        return view('tickets.index', $data);
    }

    public function exhibition( $id ) {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Events::where('template',0)->get();
        $data['tickets'] = Tickets::sortable()->where('exhibition_id',$id)->orderBy('id','DESC')->paginate(50);
        $data['total'] = $data['tickets']->total();
        $data['exhb'] = Exhibition::query()->find($id);
        return view('tickets.exhibition', $data);
    }
    public function event( $id ) {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Events::where('template',0)->get();
        $data['tickets'] = Tickets::sortable()->where('event_id',$id)->orderBy('id','DESC')->paginate(50);
        $data['total'] = $data['tickets']->total();
        $data['evnt'] = Event::query()->find($id);
        return view('tickets.event', $data);
    }

    // JSON scanner request
    public function check( Request $request ) {
        if ( request()->json() ) {
            $ticket = Tickets::query()
                ->with('event')
                ->where('event_id',$request->input('event_id'))
                ->where('code',$request->input('code'))
                ->where('deactivated',0)
                ->first();
            if ( $ticket ) {
                $visitor = Visitor::with('card')->where('id',$ticket->visitor_id)->first();
                if ( $ticket->checked_at == null ) {
                    $ticket->checked_at = Date::now();
                    $ticket->save();

                    return response()->json([
                        'status' => 'ok',
                        'ticket' => $ticket,
                        'visitor' => $visitor,
                    ]);
                } else {
                    return response()->json([
                        'status' => 'checked',
                        'ticket' => $ticket,
                        'visitor' => $visitor,
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'notfound',
                ]);
            }
        }
    }
}
