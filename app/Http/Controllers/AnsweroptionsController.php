<?php
namespace App\Http\Controllers;

use App\Http\Requests\AnsweroptionsRequest;
use App\Models\Answeroptions;
use App\Models\Questionnaires;

class AnsweroptionsController extends Controller
{
    public function create( $id )
    {
        $data['question'] = Questionnaires::find( $id );
        return view('answeroptions.add', $data);
    }

    public function store( AnsweroptionsRequest $request )
    {
        $request->store();
        return redirect('questionnaires/show/'.$request->input('questionnaire_id'));
    }

    public function edit( $id )
    {
        $data['answer'] = Answeroptions::find( $id );
        return view('answeroptions.edit', $data);
    }

    public function update( $id, AnsweroptionsRequest $request )
    {
        $request->update( $id );
        return redirect('/questionnaire/show/'.$request->input('questionnaire_id'));
    }

    public function destroy( $id )
    {
        $a = Answeroptions::find( $id );
        $a->delete();
        return redirect()->back();
    }
}
