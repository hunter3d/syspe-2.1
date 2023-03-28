<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Controllers;

use App\Http\Requests\TextsFormRequest;
use App\Models\Texts;

class TextsController extends Controller {
    public function index() {
        $data['texts'] = Texts::query()->get();
        return view('texts.index', $data);
    }

    public function create() {
        return view('texts.add');
    }

    public function store( TextsFormRequest $request ) {
        $request->store();
        return redirect()->route('texts');
    }

    public function edit( $id ) {
        $data['text'] = Texts::find( $id );
        return view('texts.edit', $data );
    }

    public function update( $id, TextsFormRequest $request ) {
        $request->update( $id );
        return redirect()->route('texts');
    }

    public function destroy() {
        return redirect()->route('tickets');
    }
}
