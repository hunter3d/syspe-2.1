<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Exhibition;
use App\Models\Tickets;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class TicketsController extends Controller
{
    public function index() {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Event::where('template',0)->get();
        $data['tickets'] = Tickets::sortable()->paginate(50);
        $data['total'] = $data['tickets']->total();
        return view('tickets.index', $data);
    }

    public function exhibition( $id ) {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Event::where('template',0)->get();
        $data['tickets'] = Tickets::sortable()->where('exhibition_id',$id)->paginate(50);
        $data['total'] = $data['tickets']->total();
        $data['exhb'] = Exhibition::query()->find($id);
        return view('tickets.exhibition', $data);
    }
    public function event( $id ) {
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        $data['events'] = Event::where('template',0)->get();
        $data['tickets'] = Tickets::sortable()->where('event_id',$id)->paginate(50);
        $data['total'] = $data['tickets']->total();
        $data['evnt'] = Event::query()->find($id);
        return view('tickets.event', $data);
    }

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
                    activity('TicketScanNew')->withProperties(['ip' => request()->ip()])->log('Билет '.$request->input('code').' успешно зарегистрирован');
                    return response()->json([
                        'status' => 'ok',
                        'ticket' => $ticket,
                        'visitor' => $visitor,
                    ]);
                } else {
                    activity('TicketScanExist')->withProperties(['ip' => request()->ip()])->log('Билет '.$request->input('code').' ранее зарегистрирован '.$ticket->checked_at);
                    return response()->json([
                        'status' => 'checked',
                        'ticket' => $ticket,
                        'visitor' => $visitor,
                    ]);
                }
            } else {
                activity('TicketScanFalse')->withProperties(['ip' => request()->ip()])->log('Билет '.$request->input('code').' не найден');
                return response()->json([
                    'status' => 'notfound',
                ]);
            }
        }
    }
}
