<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Requests;

use App\Models\Phones;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PhonesFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'number' => ['required','numeric','min:7'],
        ];
    }

    public function authorize(): bool {
        return Auth::check();
    }

    public function store( $id )
    {
        $phone = Phones::create([
            'card_id' => $id,
            'number' => $this->input('number'),
        ]);
        //userLog( 'добавлен телефон: '.$this->input('number').' к Карточке ID: '.$id );
    }
}
