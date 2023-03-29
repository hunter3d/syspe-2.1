<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'exhibition_id' => ['required','numeric'],
            'email'         => ['required','string','email','unique:visitors'],
            'email2'        => ['sometimes','string','email'],
            'last_name'     => ['required','string'],
            'first_name'    => ['required','string'],
            'second_name'   => ['sometimes','string'],
            'phone1'        => ['required','string'],
            'phone2'        => ['sometimes','string'],
            'company'       => ['required','string'],
            'position'      => ['required','string'],
            'topic_id'      => ['required','numeric'],
            'country_id'    => ['required','numeric'],
            'city'          => ['required','string'],
            'region'        => ['sometimes','string'],
            'district'      => ['sometimes','string'],
            'street'        => ['required','string'],
            'house'         => ['required','string'],
            'office'        => ['sometimes','string'],
            'post_code'     => ['sometimes','string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

}
