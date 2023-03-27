<?php

namespace App\Http\Requests\API;

use App\Mail\RecoveredMail;
use App\Models\PasswordResets;
use App\Models\Visitor;
use App\Models\VisitorsReset;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RecoveryRequest extends FormRequest {
    public function rules(): array {
        return [ 'token' => [ 'required', 'string' ] ];
    }

    public function authorize(): bool {
        return true;
    }

    public function check() {
        $out = VisitorsReset::where( 'token', $this->input( 'token' ) )->first();
        if ( $out ) { //request exist
            $visitor = Visitor::where( 'email', $out->email )->first();
            if ( $visitor ) {
                $password = Str::random( 12 );
                $visitor->password = Hash::make( $password );
                $visitor->save();
                $data['email'] = $visitor->email;
                $data['password'] = $password;
                // mail
                Mail::to( $visitor->email )->send( new RecoveredMail( $data ) );
                $out->delete();
                return true;
            }
        }
        return false;
    }
}
