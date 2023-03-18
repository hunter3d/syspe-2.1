<?php

namespace App\Http\Requests;

use App\Models\Events;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EventsFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'exhbition_id'      => ['required','numeric'],
            'name_uk'           => ['required','string'],
            'name_ru'           => ['required','string'],
            'name_en'           => ['required','string'],
            'description_uk'    => ['required','string'],
            'description_ru'    => ['required','string'],
            'description_en'    => ['required','string'],
            'location_uk'       => ['nullable','string'],
            'location_ru'       => ['nullable','string'],
            'location_en'       => ['nullable','string'],
            'logo'              => ['nullable','image','mimes:jpeg,png,jpg'],
            'ticket_temp'       => ['nullable','image','mimes:jpeg,png,jpg'],
            'start'             => ['required','date_format:"Y-m-d H:i"'],
            'stop'              => ['required','date_format:"Y-m-d H:i"'],
            'can_promo'         => ['required','numeric'],
            'can_card'          => ['required','numeric'],
            'can_invoice'       => ['required','numeric'],
            'pay_uah'           => ['required','numeric'],
            'pay_euro'          => ['required','numeric'],
            'pay_usd'           => ['required','numeric'],
            'price_uah'         => ['required','numeric'],
            'price_euro'        => ['required','numeric'],
            'price_usd'         => ['required','numeric'],
            'template'          => ['required','numeric'],
        ];
    }

    public function attributes(): array
    {
        return [
            'exhbition_id'      => 'Выставка',
            'name_uk'           => 'Название на украинском',
            'name_ru'           => 'Название на русском',
            'name_en'           => 'Название на английском',
            'description_uk'    => 'Описание на украинском',
            'description_ru'    => 'Описание на русском',
            'description_en'    => 'Описание на английском',
            'location_uk'       => 'Адрес проведения UA',
            'location_ru'       => 'Адрес проведения RU',
            'location_en'       => 'Адрес проведения EN',
            'logo'              => 'Логотип',
            'ticket_temp'       => 'Шаблон билета',
            'start'             => 'Начало',
            'stop'              => 'Конец',
            'can_promo'         => 'Оплата промокод',
            'can_card'          => 'Оплата банковской карточкой',
            'can_invoice'       => 'Оплата инвойс',
            'pay_uah'           => 'Валюта ГРН',
            'pay_euro'          => 'Валюта Euro',
            'pay_usd'           => 'Валюта USD',
            'price_uah'         => 'Цена ГРН',
            'price_euro'        => 'Цена Euro',
            'price_usd'         => 'Цена USD',
            'template'          => 'Черновик'
        ];
    }
    public function authorize(): bool {
        return Auth::check();
    }

    public function store()
    {
        // Check logo
        if ( $this->file('logo') ) {
            $image = $this->file('logo');
            $logo_name = Str::random(3).substr(time(),6,8).Str::random(3).'.'.$image->extension();
            $logo_path = 'storage/events';
            $image->move(public_path($logo_path), $logo_name);
            // crop image
            if ( $this->input('crop_x1') != '' ) {
                $scale = $this->input('crop_ow') / $this->input('crop_w');
                $w = round($this->input('crop_x2')*$scale) - round($this->input('crop_x1')*$scale);
                $h = round($this->input('crop_y2')*$scale) - round($this->input('crop_y1')*$scale);
                $x = round($this->input('crop_x1')*$scale);
                $y = round($this->input('crop_y1')*$scale);
                $img = Image::make(public_path($logo_path).'/'.$logo_name )
                    ->crop($w,$h,$x,$y)
                    ->resize(330,220)
                    ->save();
            } else {
                $img = Image::make(public_path($logo_path) .'/'.$logo_name)
                    ->resize(330, 220)
                    ->save();
            }
        } else {
            $logo_name = 'pe_event_template.svg';
            $logo_path = 'storage/templates';
        }

        // Check Ticket Template
        if ( $this->file('ticket_temp') ) {
            $image = $this->file('ticket_temp');
            $ticket_temp_name = Str::random(3).substr(time(),6,8).Str::random(3).'.'.$image->extension();
            $ticket_temp_path = 'storage/events';
            $image->move(public_path($ticket_temp_path), $ticket_temp_name);
            // crop image
            if ( $this->input('tt_crop_x1') != '' ) {
                $scale = $this->input('tt_crop_ow') / $this->input('tt_crop_w');
                $ttw = round($this->input('tt_crop_x2')*$scale) - round($this->input('tt_crop_x1')*$scale);
                $tth = round($this->input('tt_crop_y2')*$scale) - round($this->input('tt_crop_y1')*$scale);
                $ttx = round($this->input('tt_crop_x1')*$scale);
                $tty = round($this->input('tt_crop_y1')*$scale);
                $ttimg = Image::make(public_path($ticket_temp_path).'/'.$ticket_temp_name )
                    ->crop($ttw,$tth,$ttx,$tty)
                    ->resize(980,1387)
                    ->save();
            } else {
                $ttimg = Image::make(public_path($ticket_temp_path) .'/'.$ticket_temp_name)
                    ->resize(980, 1387)
                    ->save();
            }
        } else {
            $ticket_temp_name = 'ticket_template.png';
            $ticket_temp_path = 'storage/templates';
        }

        // add data to DB
        $ev = Events::create([
            'exhibition_id'     => $this->input('exhbition_id'),
            'name_uk'           => $this->input('name_uk'),
            'name_ru'           => $this->input('name_ru'),
            'name_en'           => $this->input('name_en'),
            'description_uk'    => $this->input('description_uk'),
            'description_ru'    => $this->input('description_ru'),
            'description_en'    => $this->input('description_en'),
            'location_uk'       => $this->input('location_uk'),
            'location_ru'       => $this->input('location_ru'),
            'location_en'       => $this->input('location_en'),
            'logo_path'         => $logo_path,
            'logo_name'         => $logo_name,
            'ticket_temp_path'  => $ticket_temp_path,
            'ticket_temp_name'  => $ticket_temp_name,
            'start'             => $this->input('start'),
            'stop'              => $this->input('stop'),
            'can_promo'         => $this->input('can_promo'),
            'can_card'          => $this->input('can_card'),
            'can_invoice'       => $this->input('can_invoice'),
            'pay_uah'           => $this->input('pay_uah'),
            'pay_euro'          => $this->input('pay_euro'),
            'pay_usd'           => $this->input('pay_usd'),
            'price_uah'         => $this->input('price_uah'),
            'price_euro'        => $this->input('price_euro'),
            'price_usd'         => $this->input('price_usd'),
            'template'          => $this->input('template'),
        ]);
    }

    public function update( $id )
    {
        $ev = Events::find( $id );
        // Check logo
        if ( $this->file('logo') ) {
            $image = $this->file('logo');
            $logo_name = Str::random(3).substr(time(),6,8).Str::random(3).'.'.$image->extension();
            $logo_path = 'storage/events';
            $image->move(public_path($logo_path), $logo_name);
            // crop image
            if ( $this->input('crop_x1') != '' ) {
                $scale = $this->input('crop_ow') / $this->input('crop_w');
                $w = round($this->input('crop_x2')*$scale) - round($this->input('crop_x1')*$scale);
                $h = round($this->input('crop_y2')*$scale) - round($this->input('crop_y1')*$scale);
                $x = round($this->input('crop_x1')*$scale);
                $y = round($this->input('crop_y1')*$scale);
                $img = Image::make(public_path($logo_path).'/'.$logo_name )
                    ->crop($w,$h,$x,$y)
                    ->resize(330,220)
                    ->save();
            } else {
                $img = Image::make(public_path($logo_path) .'/'.$logo_name)
                    ->resize(330, 220)
                    ->save();
            }
        } else {
            $logo_name = $ev->logo_name;
            $logo_path = $ev->logo_path;
        }

        // Check Ticket Template
        if ( $this->file('ticket_temp') ) {
            $image = $this->file('ticket_temp');
            $ticket_temp_name = Str::random(3).substr(time(),6,8).Str::random(3).'.'.$image->extension();
            $ticket_temp_path = 'storage/events';
            $image->move(public_path($ticket_temp_path), $ticket_temp_name);
            // crop image
            if ( $this->input('tt_crop_x1') != '' ) {
                $scale = $this->input('tt_crop_ow') / $this->input('tt_crop_w');
                $ttw = round($this->input('tt_crop_x2')*$scale) - round($this->input('tt_crop_x1')*$scale);
                $tth = round($this->input('tt_crop_y2')*$scale) - round($this->input('tt_crop_y1')*$scale);
                $ttx = round($this->input('tt_crop_x1')*$scale);
                $tty = round($this->input('tt_crop_y1')*$scale);
                $ttimg = Image::make(public_path($ticket_temp_path).'/'.$ticket_temp_name )
                    ->crop($ttw,$tth,$ttx,$tty)
                    ->resize(980,1387)
                    ->save();
            } else {
                $ttimg = Image::make(public_path($ticket_temp_path) .'/'.$ticket_temp_name)
                    ->resize(980, 1387)
                    ->save();
            }
        } else {
            $ticket_temp_name = $ev->ticket_temp_name;
            $ticket_temp_path = $ev->ticket_temp_path;
        }

        // Add to DB
        $ev->exhibition_id      = $this->input('exhbition_id');
        $ev->name_uk            = $this->input('name_uk');
        $ev->name_ru            = $this->input('name_ru');
        $ev->name_en            = $this->input('name_en');
        $ev->description_uk     = $this->input('description_uk');
        $ev->description_ru     = $this->input('description_ru');
        $ev->description_en     = $this->input('description_en');
        $ev->location_uk        = $this->input('location_uk');
        $ev->location_ru        = $this->input('location_ru');
        $ev->location_en        = $this->input('location_en');
        $ev->start              = $this->input('start');
        $ev->stop               = $this->input('stop');
        $ev->can_promo          = $this->input('can_promo');
        $ev->can_card           = $this->input('can_card');
        $ev->can_invoice        = $this->input('can_invoice');
        $ev->pay_uah            = $this->input('pay_uah');
        $ev->pay_euro           = $this->input('pay_euro');
        $ev->pay_usd            = $this->input('pay_usd');
        $ev->price_uah          = $this->input('price_uah');
        $ev->price_euro         = $this->input('price_euro');
        $ev->price_usd          = $this->input('price_usd');
        $ev->template           = $this->input('template');
        // Удаляем старый логотип
        if ( $ev->logo_name != $logo_name && $ev->logo_name != 'pe_event_template.svg')
        {
            if (\File::exists(public_path($ev->logo_path).'/'.$ev->logo_name))
                \File::delete(public_path($ev->logo_path).'/'.$ev->logo_name);

        }
        $ev->logo_name = $logo_name;
        $ev->logo_path = $logo_path;

        // Удаляем старый шаблон билета
        if ( $ev->ticket_temp_name != $ticket_temp_name && $ev->ticket_temp_name != 'ticket_template.png')
        {
            if (\File::exists(public_path($ev->ticket_temp_path).'/'.$ev->ticket_temp_name))
                \File::delete(public_path($ev->ticket_temp_path).'/'.$ev->ticket_temp_name);

        }
        $ev->ticket_temp_name = $ticket_temp_name;
        $ev->ticket_temp_path = $ticket_temp_path;
        $ev->save();

    }
}
