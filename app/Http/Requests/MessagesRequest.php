<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Requests;

use App\Models\Messages;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MessagesRequest extends FormRequest {
    public function rules(): array {
        return [
            'name'          => ['required','string'],
            'description'   => ['required','string'],
        ];
    }
    public function attributes()
    {
        return [
            'name'          => 'Название сообщения',
            'description'   => 'Текст сообщения',
        ];
    }

    public function authorize(): bool {
        return Auth::check();
    }

    public function store() {
        Messages::create([
            'user_id'       => auth('web')->user()->id,
            'name'          => $this->input('name'),
            'description'   => $this->input('description'),
        ]);
    }

    public function update( $id ) {
        $message = Messages::find( $id );
        $message->name          = $this->input('name');
        $message->description   = $this->input('description');
        $message->save();
    }
}
