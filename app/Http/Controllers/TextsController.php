<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Controllers;

use App\Models\Texts;

class TextsController extends Controller {
    public function index() {
        $data['texts'] = Texts::query()->get();
        return view('texts.index', $data);
    }

    public function create() {
        return view('texts.add');
    }

    public function store() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
