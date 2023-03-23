<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Event;
use App\Models\Questionnaires;

class AnswersController extends Controller {
    public function index() {
        $data['events'] = Event::query()->orderBy('start','ASC')->get();

        return view('answers.index',$data);
    }

    public function show( $event_id ) {
        $data['event'] = Event::find($event_id);
        $data['questions'] = Questionnaires::where('exhibition_id',$data['event']->exhibition_id)->get();
        $data['answers'] = Answers::query()->where('event_id',$event_id)->get();

        return view('answers.show',$data);
    }

    public function showcard( $event_id ) {
        $data['event'] = Event::find($event_id);
        $data['questions'] = Questionnaires::where('exhibition_id',$data['event']->exhibition_id)->get();
        $data['answers'] = Answers::query()->where('event_id',$event_id)->get();

        return view('answers.showcard',$data);
    }
}
