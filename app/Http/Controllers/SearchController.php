<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Card;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function get( Request $request ) {
        if ( $request->input( 'model' ) == 'cards' ) {
            $data['cards'] = Card::search( $request->input( 'query' ) )->paginate( 25 );
            return view( 'search.cards', $data );
        }
        if ( $request->input( 'model' ) == 'logs' ) {
            $data['logs'] = Activity::search( $request->input( 'query' ) )->paginate( 25 );
            return view( 'search.logs', $data );
        }
        back();
    }
}
