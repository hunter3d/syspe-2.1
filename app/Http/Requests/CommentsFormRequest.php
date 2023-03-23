<?php
# (c) PremierExpo 2022-2023
namespace App\Http\Requests;

use App\Models\Comments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentsFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'message' => ['required'],
        ];
    }

    public function authorize(): bool {
        return Auth::check();
    }

    public function attributes()
    {
        return [
            'message' => 'Текст комментария',
        ];
    }

    public function store( $id )
    {
        $comment = Comments::create([
            'user_id' => Auth::id(),
            'card_id' => $id,
            'message' => $this->input('message'),
        ]);

    }
}
