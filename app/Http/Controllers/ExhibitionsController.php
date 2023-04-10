<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionsFormRequest;
use App\Models\Exhibitions;
use Illuminate\Http\Request;

class ExhibitionsController extends Controller {
    public function index( Request $request ) {
        $exhibition = Exhibitions::query();
        if ( isset( $request->status ) ) {
            $data['filter_status'] = ( $request->status == 0 ? 'Активные' : 'Черновики' );
            $exhibition = $exhibition->where( 'template', $request->status );
        }
        $exhibition = $exhibition->sortable()->get();
        $data['exhibitions'] = $exhibition;
        $data['total'] = count( $data['exhibitions'] );
        return view( 'exhibitions.index', $data );
    }

    public function create() {
        return view( 'exhibitions.add' );
    }

    public function store( ExhibitionsFormRequest $request ) {
        $request->store();
        return redirect()->route( 'exhibitions' );
    }

    public function edit( $id ) {
        $data['exhibition'] = Exhibitions::find( $id );
        return view( 'exhibitions.edit', $data );
    }

    public function update( $id, ExhibitionsFormRequest $request ) {
        $request->update( $id );
        return redirect()->route( 'exhibitions' );
    }

    public function destroy( $id ) {
        $exhb = Exhibitions::find( $id );
        if ( count( $exhb->cards ) > 0 ) {
            return back()->with( 'error', 'Вы не можете удалить выставку. К данной выставке привязаны карточки посетителей. Для удаления отвяжите их от данной выставки.' );
        }

        if ( count( $exhb->events ) > 0 ) {
            return back()->with( 'error', 'Вы не можете удалить выставку. К данной выставке привязаны мероприятия. Для удаления вначале удалите их.' );
        }

        if ( count( $exhb->answers ) > 0 ) {
            return back()->with( 'error', 'Вы не можете удалить выставку. К данной выставке привязаны заполненные анкеты. Для удаления вначале удалите их.' );
        }

        if ( count( $exhb->cardtopic ) > 0 ) {
            return back()->with( 'error', 'Вы не можете удалить выставку. К данной выставке привязаны специализации. Для удаления вначале удалите их.' );
        }

        if ( count( $exhb->order ) > 0 ) {
            return back()->with( 'error', 'Вы не можете удалить выставку. К данной выставке привязаны заказы. Для удаления вначале удалите их.' );
        }

        if ( count( $exhb->questionnaires ) > 0 ) {
            return back()->with( 'error', 'Вы не можете удалить выставку. К данной выставке привязаны вопросы к анкетам. Для удаления вначале удалите их.' );
        }

        if ( count( $exhb->tickets ) > 0 ) {
            return back()->with( 'error', 'Вы не можете удалить выставку. К данной выставке привязаны купленные билеты. Для удаления вначале удалите их.' );
        }

        // Удаляем логотип
        if ( $exhb->logo_name != 'pe_exhibition_template.svg' ) {
            if ( \File::exists( public_path( $exhb->logo_path ) . '/' . $exhb->logo_name ) ) \File::delete( public_path( $exhb->logo_path ) . '/' . $exhb->logo_name );

        }
        // Удаляем выставку
        $exhb->delete();
        return redirect()->route( 'exhibitions' );
    }
}
