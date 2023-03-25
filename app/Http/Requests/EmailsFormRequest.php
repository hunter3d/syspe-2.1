<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Requests;

use App\Models\Emails;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmailsFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'email' => ['required','email:rfc,dns'],
        ];
    }

    public function authorize(): bool {
        return Auth::check();
    }

    public function store( $id )
    {
        $email = Emails::create([
            'card_id' => $id,
            'email' => $this->input('email')
        ]);
    }
}
