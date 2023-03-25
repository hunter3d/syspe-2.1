<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventsFormRequest;
use App\Models\Events;
use App\Models\Exhibition;

class EventsController extends Controller
{
    // TODO add list by Exhibition ID

    public function index()
    {
        $data['events'] = Events::sortable()->paginate(50);
        $data['total'] = $data['events']->total();
        return view('events.index',$data);
    }

    public function exhibition( $id )
    {
        $data['exhibition'] = Exhibition::find($id);
        $data['events'] = Events::sortable()->where('exhibition_id', $id)->paginate(50);
        $data['total'] = $data['events']->total();
        return view('events.exhibition',$data);
    }

    public function show( $id )
    {
        $data['event'] = Events::find( $id );
        return view('events.show', $data);
    }

    public function create()
    {
        $data['exhibitions'] = Exhibition::query()
            ->where('template',0)
            ->orderBy('name','asc')
            ->get();
        return view('events.add',$data);
    }

    public function store(EventsFormRequest $request)
    {
        $request->store();
        return redirect()->route('events');
    }

    public function edit( $id )
    {
        $data['exhibitions'] = Exhibition::query()
            ->where('template',0)
            ->orderBy('name','asc')
            ->get();
        $data['event'] = Events::find( $id );
        return view('events.edit',$data);
    }

    public function update( $id, EventsFormRequest $request)
    {
        $request->update( $id );
        return redirect()->route('events');
    }

    public function destroy( $id ) {
        $event = Events::find( $id );
        if ( count( $event->orders )>0 )
            return redirect()->route('events')->with('error','Вы не можете удалить мероприятие к нему привязаны заказы');
        if ( count( $event->promocodes )>0 )
            return redirect()->route('events')->with('error','Вы не можете удалить мероприятие к нему привязаны промокоды');
        if ( count( $event->tickets )>0 )
            return redirect()->route('events')->with('error','Вы не можете удалить мероприятие к нему привязаны билеты');

        $event->delete();
        return redirect()->route('events')->with('success','Мероприятие успешно удалено');
    }
}
