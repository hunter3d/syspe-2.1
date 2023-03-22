<?php
namespace App\Http\Requests;

use App\Models\Answeroptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AnsweroptionsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'questionnaire_id' => ['required','numeric'],
            'answer_ua' => ['required','string'],
            'answer_ru' => ['required','string'],
            'answer_en' => ['required','string'],
            'order' => ['required','numeric'],
        ];
    }

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function store()
    {
        $a = Answeroptions::create([
            'questionnaire_id' => $this->input('questionnaire_id'),
            'answer_ua' => $this->input('answer_ua'),
            'answer_ru' => $this->input('answer_ru'),
            'answer_en' => $this->input('answer_en'),
            'order' => $this->input('order'),
        ]);
    }

    public function update( $id )
    {
        $q = Answeroptions::find( $id );
        $q->questionnaire_id = $this->input('questionnaire_id');
        $q->answer_ua = $this->input('answer_ua');
        $q->answer_ru = $this->input('answer_ru');
        $q->answer_en = $this->input('answer_en');
        $q->order = $this->input('order');
        $q->save();
    }
}
