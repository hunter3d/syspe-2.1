<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Requests;

use App\Models\Texts;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TextsFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['string','required'],
            'text_uk' => ['string','required'],
            'text_ru' => ['string','required'],
            'text_en' => ['string','required'],
        ];
    }

    public function authorize(): bool {
        return Auth::check();
    }

    public function store() {
        Texts::create([
            'name' => $this->input('name'),
            'text_uk' => htmlspecialchars($this->input('text_uk')),
            'text_ru' => htmlspecialchars($this->input('text_ru')),
            'text_en' => htmlspecialchars($this->input('text_en')),
        ]);
    }

    public function update( $id ) {
        $text = Texts::find( $id );
        $text->name = $this->input('name');
        $text->text_uk = htmlspecialchars( $this->input('text_uk') );
        $text->text_ru = htmlspecialchars( $this->input('text_ru') );
        $text->text_en = htmlspecialchars( $this->input('text_en') );
        $text->save();
    }

}
