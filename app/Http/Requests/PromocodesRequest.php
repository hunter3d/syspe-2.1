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
            'description'   => ['string'],
            'price_uah'     => ['required', 'numeric'],
            'price_euro'    => ['required', 'numeric'],
            'price_usd'     => ['required', 'numeric'],
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
            'price_uah'     => 'Цена ГРН',
            'price_euro'    => 'Цена EURO',
            'price_usd'     => 'Цена USD',
        ];
    }

    public function store()
    {
        $pc = Promocodes::create([
            'event_id'      => $this->input('event_id'),
            'code'          => strtoupper($this->input('code')),
            'description'   => $this->input('description'),
            'price_uah'     => $this->input('price_uah'),
            'price_euro'    => $this->input('price_euro'),
            'price_usd'     => $this->input('price_usd'),
        ]);
    }

    public function update( $id )
    {
        $ps = Promocodes::find($id);
        $ps->event_id    = $this->input('event_id');
        $ps->code        = strtoupper($this->input('code'));
        $ps->description = $this->input('description');
        $ps->price_uah   = $this->input('price_uah');
        $ps->price_euro  = $this->input('price_euro');
        $ps->price_usd   = $this->input('price_usd');
        $ps->save();
    }
}
