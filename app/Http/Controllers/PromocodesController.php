<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromocodesRequest;
use App\Models\Events;
use App\Models\Promocodes;

class PromocodesController extends Controller
{
    public function index()
    {
        $data['promocodes'] = Promocodes::sortable()->orderBy('id','DESC')->paginate(50);
        $data['events'] = Events::where('template',0)->get();
        return view('promocodes.index',$data);
    }

    public function event( $id ) {

        $data['promocodes'] = Promocodes::sortable()->where('event_id',$id)->orderBy('id','DESC')->paginate(50);
        $data['events'] = Events::where('template',0)->get();
        $data['evnt'] = Events::query()->find($id);
        return view('promocodes.event',$data);
    }

    public function create()
    {
        $data['events'] = Events::where('template',0)->get();
        return view('promocodes.add',$data);
    }

    public function store( PromocodesRequest $request )
    {
        $request->store();
        return redirect()->route('promocodes');
    }
    public function edit( $id )
    {
        $data['events'] = Events::where('template',0)->get();
        $data['promocode'] = Promocodes::find($id);
        return view('promocodes.edit',$data);
    }

    public function update( $id, PromocodesRequest $request )
    {
        $request->update( $id );
        return redirect()->route('promocodes');
    }

    public function destroy( $id )
    {
        $pcode = Promocodes::find($id);
        if (count($pcode->order) > 0) {
            return redirect()->route('promocodes')->with('error','Промокод уже нельзя удалить, по нему существует заказ');
        } else {
            $pcode->delete();
            return redirect()->route('promocodes');
        }
    }
}
