<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegistrationRequest;
use App\Mail\VerifyEmailMail;
use App\Models\Cards;
use App\Models\Emails;
use App\Models\Phones;
use App\Models\Emailcodes;
use App\Models\Visitor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function store(RegistrationRequest $request)
    {
        // create new user with generated password
        $password = Str::random(12);
        $user = Visitor::create([
            'email'     => $request->input('email'),
            'password'  => Hash::make($password)
        ]);

        // create email validation data
        $key = Str::random(64);
        $emailcode = Emailcodes::create([
            'visitor_id'        => $user->id,
            'validation_code'   => $key,
            'password'          => $password,
        ]);

        // send Email to visitor
        $data['id'] = $user->id;
        $data['code'] = $key;
        \Mail::to( $user->email )->send( new VerifyEmailMail( $data ));

        // add DATA to Card and relations
        $card = Cards::create([
            'visitor_id'        => $user->id,
            'country_id'        => $request->input('country_id'),
            'first_name'        => $request->input('first_name'),
            'second_name'       => $request->input('second_name'),
            'last_name'         => $request->input('last_name'),
            'company'           => $request->input('company'),
            'topic_id'          => $request->input('topic_id'),
            'position'          => $request->input('position'),
            'post_code'         => $request->input('post_code'),
            'region'            => $request->input('region'),
            'district'          => $request->input('district'),
            'city'              => $request->input('city'),
            'street'            => $request->input('street'),
            'house'             => $request->input('house'),
            'office'            => $request->input('office'),
            'status'            => 'Новая',
        ]);
        // add all emails
        Emails::create([
            'card_id'   => $card->id,
            'email'     => $request->input('email')
        ]);
        if ( $request->input('email2') &&
             $request->input('email2')!='' )
            Emails::create([
                'card_id'   => $card->id,
                'email'     => $request->input('email2')
            ]);

        // add all phones
        Phones::create([
            'card_id'   => $card->id,
            'number'    => $request->input('phone1')
        ]);
        if ( $request->input('phone2') &&
             $request->input('phone2')!='')
            Phones::create([
                'card_id'   => $card->id,
                'number'    => $request->input('phone2')
            ]);

        // add all exhibition
        $card->exhibitions()->attach( $request->input('exhibition_id') );

        return response()->json([
            'status'    => true,
            'message'   => 'User created',
        ], 200);
    }
}
