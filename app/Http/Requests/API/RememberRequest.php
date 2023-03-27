<?php

namespace App\Http\Requests\API;

use App\Mail\RecoveryMail;
use App\Models\Visitor;
use App\Models\VisitorsReset;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RememberRequest extends FormRequest {
    public function rules(): array {
        return [ 'email' => [ 'required', 'email' ], ];
    }

    public function authorize(): bool {
        return true;
    }

    public function sendcode() {
        $visitor = Visitor::where( 'email', $this->input( 'email' ) )->whereNotNull( 'email_verified_at' )->first();
        if ( $visitor ) {
            // удаляем предыдущий запрос
            $link = VisitorsReset::where( 'email', $this->input( 'email' ) )->first();
            if ( $link ) $link->delete();
            // создаем новый запрос
            $data['token'] = Str::random( 60 );
            VisitorsReset::create( [ 'email' => $this->input( 'email' ), 'token' => $data['token'], ] );
            // отправляем ссылку восстановления пароля
            Mail::to( $this->input( 'email' ) )->send( new RecoveryMail( $data ) );
        }
        return true;
    }

}
