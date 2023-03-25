<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Requests;

use App\Models\Cards;
use App\Models\Exhibition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CardsFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'exhibitions'   => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'first_name'    => ['required', 'string'],
            'second_name'   => ['nullable', 'string'],
            'company'       => ['required', 'string'],
            'position'      => ['required', 'string'],
            'topic_id'      => ['required', 'numeric'],
            'country_id'    => ['required', 'numeric'],
            'city'          => ['required', 'string'],
            'region'        => ['nullable', 'string'],
            'district'      => ['nullable', 'string'],
            'street'        => ['required', 'string'],
            'house'         => ['required', 'string'],
            'office'        => ['nullable', 'string'],
            'post_code'     => ['nullable', 'string'],
            'status'        => ['required', 'string']
        ];
    }

    public function authorize(): bool {
        return Auth::check();
    }

    public function update( $id ) {
        $card = Cards::find( $id );
        // change exhibitions
        $old_exhbs = $card->exhibitions->pluck('name');
        foreach ( $old_exhbs as $old ) {
            $ee = Exhibition::where('name', $old)->first();
            $card->exhibitions()->detach($ee->id);
        }
        if ( $this->input('exhibitions') && $this->input('exhibitions') != '') {
            $exhb = $this->input('exhibitions');
            $exhibitions = explode(',',$exhb);
            // add list of roles for user
            foreach ( $exhibitions as $exhibition ) {
                $e = Exhibition::where('name', $exhibition)->first();
                $card->exhibitions()->attach($e->id);
            }
        }

        // add form to DB
        $card->last_name      = $this->input('last_name');
        $card->first_name     = $this->input('first_name');
        $card->second_name    = $this->input('second_name');
        $card->company        = $this->input('company');
        $card->position       = $this->input('position');
        $card->topic_id       = $this->input('topic_id');
        $card->country_id     = $this->input('country_id');
        $card->city           = $this->input('city');
        $card->region         = $this->input('region');
        $card->district       = $this->input('district');
        $card->street         = $this->input('street');
        $card->house          = $this->input('house');
        $card->office         = $this->input('office');
        $card->post_code      = $this->input('post_code');
        $card->status         = $this->input('status');
        $card->save();
    }
}
