<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use App\Models\Comments;
use App\Models\Countries;
use App\Models\Emails;
use App\Models\Exhibition;
use App\Models\Orders;
use App\Models\Phones;
use App\Models\Tickets;
use App\Models\Topics;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $data['filter_exhb'] = null;
        $cards = Cards::query()->with(['exhibitions','country','emails','phones']);
        if ($request->exhb)
        {
            $data['filter_exhb'] = $request->exhb;
            $cards = $cards->whereRelation('exhibitions', 'name', $request->exhb);
        }
        $cards = $cards->sortable()->paginate(50);
        $data['cards'] = $cards;
        $data['total'] = $cards->total();
        $data['exhibitions'] = Exhibition::query()->where('template',0)->get();

        return view('cards.index',$data);
    }

    public function show($id)
    {
        $data['card'] = Cards::find($id);
        $data['orders'] = Orders::where('visitor_id', $data['card']->visitor_id)->get();
        $data['tickets'] = Tickets::where('visitor_id', $data['card']->visitor_id)->get();
        return view('cards.show',$data);
    }

    public function addcomment($id, CardCommentAddRequest $request)
    {
        $request->store( $id );
        return redirect('/cards/show/'.$id);
    }

    public function addphone( $id, CardPhoneAddRequest $request )
    {
        $request->store( $id );
        return back();
    }

    public function delphone( $id )
    {
        $phone = Phones::find( $id );
        $phone->delete();
        return back();
    }

    public function addemail( $id, CardEmailAddRequest $request )
    {
        $request->store( $id );
        return back();
    }

    public function delemail( $id, $visitor_id ) { // TODO проверка не совпадает ли email с login['email']
        $email = Emails::find( $id );
        $visitor = Visitor::find( $visitor_id );

        $count = Emails::where('email', $email->email)->where('card_id',$email->card_id)->count();

        if ( $email->email == $visitor->email && $count==1 ) {
            return back()->with('error','Вы не можете удалить email, который используется как логин!');
        } else {
            $email->delete();
            return back();
        }
    }

    public function delcomment( $id )
    {
        $comment = Comments::find( $id );
        if ( $comment )
        {
            //$id = $comment->user_id;
            if ( $comment->user_id == Auth::id() )
            {
                $comment->delete();
                return back();
            }
            else
            {
                return back()->with('error','У вас нет прав для удаления коментария');
            }
        }
        return back()->with('error','Коментарий для удаления не найден');
    }

    public function edit( $id )
    {
        $data['card'] = Cards::find( $id );
        $data['countries'] = Countries::query()->get();
        $data['cardtopics'] = Topics::query()->get();
        $data['exhibitions'] = '';
        foreach ( $data['card']->exhibitions as $exhibition )
        {
            $data['exhibitions'] .= $exhibition->name.',';
        }
        $all_exhibitions = Exhibition::orderBy('name','ASC')->get();
        $data['all_exhibitions'] = array();
        foreach ( $all_exhibitions as $all_exhibition)
        {
            array_push( $data['all_exhibitions'], $all_exhibition->name );
        }
        return view('cards.edit', $data);
    }

    public function update( $id, CardEditRequest $request ) {
        $request->update( $id );
        return redirect('/cards/index');
    }

    public function delete( $id )
    {
        return back();
    }
}
