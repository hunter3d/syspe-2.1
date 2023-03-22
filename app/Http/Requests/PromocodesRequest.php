<?php

namespace App\Http\Requests;

use App\Models\Promocodes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PromocodesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id'      => ['required','numeric'],
            'code'          => ['required','string'],
            'description'   => [],
            'price'         => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function attributes()
    {
        return [
            'event_id'      => 'Мероприятие',
            'code'          => 'Промокод',
            'description'   => 'Описание',
            'price'         => 'Цена',
        ];
    }

    public function store()
    {
        $pc = Promocodes::create([
            'event_id'      => $this->input('event_id'),
            'code'          => strtoupper($this->input('code')),
            'description'   => $this->input('description'),
            'price'         => $this->input('price'),
        ]);
    }

    public function update( $id )
    {
        $ps = Promocodes::find($id);
        $ps->event_id    = $this->input('event_id');
        $ps->code        = strtoupper($this->input('code'));
        $ps->description = $this->input('description');
        $ps->price       = $this->input('price');
        $ps->save();
    }
}
