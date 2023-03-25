<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionnairesRequest;
use App\Models\Answeroptions;
use App\Models\Exhibition;
use App\Models\Questionnaires;
use Illuminate\Http\Request;

class QuestionnairesController extends Controller
{
    public function index(Request $request) // все вопросы и их типы
    {
        $quests = Questionnaires::query();
        if ( isset($request->template) ) {
            $data['filter_status'] = ($request->template==0?'Активные':'Черновики');
            $quests = $quests->where('template',$request->template);
        }
        $quests = $quests->sortable()->paginate(50);
        $data['quests'] = $quests;
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        return view('questionnaires.index', $data);
    }

    public function exhibition( $id, Request $request ) {
        $quests = Questionnaires::query();
        if ( isset($request->template) && ($request->template==0||$request->template==1)) {
            $data['filter_status'] = ($request->template==0?'Активные':'Черновики');
            $quests = $quests->where('template', $request->template);
        }
        $quests = $quests->where('exhibition_id', $id)->paginate(50);
        $data['quests'] = $quests;
        $data['exhb'] = Exhibition::find($id);
        $data['exhibitions'] = Exhibition::where('template',0)->get();
        return view('questionnaires.exhibition',$data);
    }

    public function show( $id ) // карточка вопроса
    {
        $data['quest'] = Questionnaires::find($id);
        $data['answers'] = Answeroptions::query()->where('questionnaire_id',$id)->get();
        return view('questionnaires.show', $data);
    }

    public function create()
    {
        $data['exhibitions'] = Exhibition::query()->where('template',0)->orderBy('name','ASC')->get();
        return view('questionnaires.add',$data);
    }

    public function store( QuestionnairesRequest $request )
    {
        $request->store();
        return redirect()->route('questionnaires');
    }

    public function edit($id)
    {
        $data['exhibitions'] = Exhibition::query()->orderBy('name','ASC')->get();
        $data['question'] = Questionnaires::find( $id );
        return view('questionnaires.edit', $data);
    }

    public function update( $id, QuestionnairesRequest $request )
    {
        $request->update( $id );
        return redirect('questionnaires/index');
    }

    public function destroy( $id )
    {
        $question = Questionnaires::find($id);
        if( $question) {
            Answeroptions::query()->where('questionnaire_id', $id )->delete();

            $question->delete();
        }

//        $answers = Answeroptions::where('questionnaire_id', $id)->get();
//        if ( $answers )
//            $answers->delete();
        return redirect('questionnaires/index');
    }
}
