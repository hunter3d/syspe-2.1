<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicsFormRequest;
use App\Models\Cards;
use App\Models\Exhibition;
use App\Models\Topics;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function index(Request $request)
    {
        $topics = Topics::sortable();
        if ( isset($request->template) && ($request->template==0||$request->template==1)) {
            $data['filter_status'] = ($request->template==0?'Активные':'Черновики');
            $topics = $topics->where('template', $request->template);
        }
        $topics = $topics->paginate(50);
        $data['topics'] = $topics;
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        return view('topics.index',$data);
    }

    public function exhibition( $id, Request $request ) {
        $topics = Topics::sortable();
        if ( isset($request->template) && ($request->template==0||$request->template==1)) {
            $data['filter_status'] = ($request->template==0?'Активные':'Черновики');
            $topics = $topics->where('template', $request->template);
        }
        $topics = $topics->where('exhibition_id', $id)->paginate(50);
        $data['topics'] = $topics;
        $data['exhb'] = Exhibition::find($id);
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        return view('topics.exhibition',$data);
    }

    public function create()
    {
        $data['exhibitions'] = Exhibition::query()
            ->where('template',0)
            ->orderBy('name','asc')
            ->get();
        return view('topics.add',$data);
    }

    public function store( TopicsFormRequest $request )
    {
        $request->store();
        return redirect()->route('topics');
    }

    public function edit( $id )
    {
        $data['exhibitions'] = Exhibition::query()
            ->where('template',0)
            ->orderBy('name','asc')
            ->get();
        $data['topic'] = Topics::find($id);
        return view('topics.edit',$data);
    }

    public function update( $id, TopicsFormRequest $request )
    {
        $request->update( $id );
        return redirect()->route('topics');
    }

    public function destroy( $id )
    {
        if ( $id!=1 )
        {
            $cards = Cards::query()->where('topic_id', $id)->get();
            foreach ($cards as $card)
            {
                $card->topic_id = 1;
                $card->save();
            }
            $topic = Topics::find( $id );
            $topic->delete();
            return redirect()->route('topics');
        } else {
            return redirect()->route('topics')->with('error','Данную специализацию невозможно удалить!');
        }

    }
}
