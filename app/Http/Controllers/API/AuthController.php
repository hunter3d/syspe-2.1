<?php
# (c) PremierExpo 2022

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RecoveryRequest;
use App\Http\Requests\API\RememberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
    public function login( LoginRequest $request ) {
        if ( !$request->authenticate() ) {
            return response()->json( [ 'status' => false, 'message' => __( 'API/login.failed' ), ], 401 );
        } else {
            $request->session()->regenerate();
            $user = Auth::guard( 'api' )->user();
            if ( $user && $user->email_verified_at === NULL ) {
                return response()->json( [ 'status' => false, 'message' => __( 'API/login.email' ), ], 401 );
            }
            activity( 'VisitorAuth' )->withProperties( [ 'ip' => request()->ip() ] )->log( $user->email . ' Вошел в систему' );
            return response()->json( [ 'status' => true, 'message' => 'User Logged In Successfully', 'user' => $user, ], 200 );
        }
    }

    public function destroy( Request $request ) {
        if ( Auth::guard( 'api' )->check() ) { //user loggedIN
            $user = Auth::guard( 'api' )->user();
            activity( 'VisitorAuth' )->withProperties( [ 'ip' => request()->ip() ] )->log( $user->email . '-Вышел из системы' );
            Auth::guard( 'api' )->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json( [ 'status' => true, 'message' => 'User Logged Out Successfully', ], 200 );
        } else { // user is not loggedIN
            return response()->json( [ 'status' => false, 'message' => 'LOGOUT: false. User not Logged in', ], 422 );
        }
    }

    public function ifNotExist( Request $request ) {
        $input['email'] = $request->input( 'email' );
        $rules = array( 'email' => 'unique:visitors,email' );
        $validator = Validator::make( $input, $rules );
        if ( $validator->fails() ) {
            return response()->json( [ 'status' => false, ], 200 );
        } else {
            return response()->json( [ 'status' => true, ], 200 );
        }
    }

    public function emailNotExist( Request $request ) {
        $input['email'] = $request->input( 'email' );
        $rules = array( 'email' => 'unique:visitors,email' );
        $validator = Validator::make( $input, $rules );
        if ( $validator->fails() ) {
            return response()->json( [ 'status' => false, ], 200 );
        } else {
            return response()->json( [ 'status' => true, ], 200 );
        }
    }

    public function remember( RememberRequest $request ) {
        $request->sendcode();
        return response()->json( [ 'status' => true, ], 200 );
    }

    public function recovery( RecoveryRequest $request ) {
        $request = $request->check();

        if ( !$request ) {
            return response()->json( [ 'status' => false, ], 200 );
        } else {
            return response()->json( [ 'status' => $request->email, ], 200 );
        }

    }
}
