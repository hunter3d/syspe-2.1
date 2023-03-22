<?php

namespace App\Http\Requests;

use App\Models\Questionnaires;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuestionnairesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'exhibition_id' => ['required','numeric'],
            'type' => ['required','in:textfield,select,checkbox,radio'],
            'question_ua' => ['required', 'string'],
            'question_ru' => ['required', 'string'],
            'question_en' => ['required', 'string'],
            'template' => ['required','boolean']
        ];
    }

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function store()
    {
        $q = Questionnaires::create([
            'exhibition_id'     => $this->input('exhibition_id'),
            'type'              => $this->input('type'),
            'question_ua'       => $this->input('question_ua'),
            'question_ru'       => $this->input('question_ru'),
            'question_en'       => $this->input('question_en'),
            'template'          => $this->input('template'),
        ]);
    }

    public function update( $id )
    {
        $q = Questionnaires::find($id);
        $q->exhibition_id = $this->input('exhibition_id');
        $q->question_ua = $this->input('question_ua');
        $q->question_ru = $this->input('question_ru');
        $q->question_en = $this->input('question_en');
        $q->type = $this->input('type');
        $q->template = $this->input('template');
        $q->save();
    }
}
