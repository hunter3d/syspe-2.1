<?php
# (c) PremierExpo 2022
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Topics;
use Illuminate\Support\Facades\App;

class TopicsController extends Controller
{
    public function index( $id=NULL )
    {
        $lang = App::currentLocale();
        if ($id != NULL) {
            $topics = Topics::select('id','exhibition_id','name_'.$lang.' AS name','template','created_at','updated_at')->where('exhibition_id',$id)->where('template','0')->get();
        } else {
            $topics = Topics::select('id','exhibition_id','name_'.$lang.' AS name','template','created_at','updated_at')->where('template','0')->get();
        }

        return response()->json([
            'status' => true,
            'topics' => $topics
        ]);
    }
}
