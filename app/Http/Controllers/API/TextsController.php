<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Texts;
use Illuminate\Support\Facades\App;

class TextsController extends Controller {
    public function show( $id ) {
        $lang = App::currentLocale();
        $text = Texts::select('id','name','text_'.$lang.' AS text')->where('id',$id)->first();
        return response()->json([
            'status' => true,
            'text' => htmlspecialchars_decode($text),
        ]);
    }
}
