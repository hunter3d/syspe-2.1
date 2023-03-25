<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Requests;

use App\Models\Topics;
use Illuminate\Foundation\Http\FormRequest;

class TopicsFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'exhibition_id' => ['required','numeric'],
            'name_uk' => ['required','string'],
            'name_ru' => ['required','string'],
            'name_en' => ['required','string'],
            'template' => ['required','numeric']
        ];
    }

    public function attributes()
    {
        return [
            'exhibition_id' => 'Выставка',
            'name_uk' => 'Название на украинском',
            'name_ru' => 'Название на русском',
            'name_en' => 'Название на английском',
            'template' => 'Статус',
        ];
    }
    public function authorize(): bool {
        return Auth::check();
    }

    public function store()
    {
        $topic = Topics::create([
            'exhibition_id' => $this->input('exhibition_id'),
            'name_uk' => $this->input('name_uk'),
            'name_ru' => $this->input('name_ru'),
            'name_en' => $this->input('name_en'),
            'template' => $this->input('template'),
        ]);
    }

    public function update($id)
    {
        $topic = Topics::find($id);
        $topic->exhibition_id = $this->input('exhibition_id');
        $topic->name_uk = $this->input('name_uk');
        $topic->name_ru = $this->input('name_ru');
        $topic->name_en = $this->input('name_en');
        $topic->template = $this->input('template');
        $topic->save();
    }
}
