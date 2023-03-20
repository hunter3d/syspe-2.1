<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventAddRequest;
use App\Http\Requests\EventEditRequest;
use App\Models\Event;
use App\Models\Exhibition;

class EventsController extends Controller
{
    // TODO add list by Exhibition ID

    public function index()
    {
        $data['events'] = Event::sortable()->paginate(50);
        $data['total'] = $data['events']->total();
        return view('events.index',$data);
    }

    public function exhibition( $id )
    {
        $data['exhibition'] = Exhibition::find($id);
        $data['events'] = Event::sortable()->where('exhibition_id', $id)->paginate(50);
        $data['total'] = $data['events']->total();
        return view('events.exhibition',$data);
    }

    public function show( $id )
    {
        $data['event'] = Event::find( $id );
        return view('events.show', $data);
    }

//    public function exhibition( $id )
//    {
//
//        $data['events'] = Event::where('exhibition_id', $id)->sortable()->paginate(25);
//        return view('events.exhibition', $data);
//    }

    public function create()
    {
        $data['exhibitions'] = Exhibition::query()
            ->where('template',0)
            ->orderBy('name','asc')
            ->get();
        return view('events.add',$data);
    }

    public function store(EventAddRequest $request)
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
        $data['event'] = Event::find( $id );
        return view('events.edit',$data);
    }

    public function update( $id, EventEditRequest $request)
    {
        $request->update( $id );
        return redirect()->route('events');
    }
}
