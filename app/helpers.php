<?php
# (c) PremierExpo 2022
use App\Models\User;

//if (!function_exists('formatPhone'))
//{
//    function formatPhone( $number )
//    {
//        preg_replace("/[^0-9]+/","",$number); // clear not integer char
//        if ( $number && strlen($number) > 0 )
//        {
//            if ( strlen($number) == 12 ) // +## (###) ###-##-##
//            {
//                $number = '+'.substr($number,0,2).' ('.substr($number,2,3).') '.substr($number,5,3).'-'.substr($number,8,2).'-'.substr($number,10,2);
//            }
//            else if ( strlen($number) == 11 ) // +# (###) ###-##-##
//            {
//                $number = '+'.substr($number,0,1).' ('.substr($number,1,3).') '.substr($number,4,3).'-'.substr($number,7,2).'-'.substr($number,9,2);
//            }
//            else if ( strlen($number) == 10 ) // +38 (###) ###-##-##
//            {
//                $number = '+38 ('.substr($number,0,3).') '.substr($number,3,3).'-'.substr($number,6,2).'-'.substr($number,8,2);
//            }
//            else if ( strlen($number) == 9 ) // +38 (0##) ###-##-##
//            {
//                $number = '+38 (0'.substr($number,0,2).') '.substr($number,2,3).'-'.substr($number,5,2).'-'.substr($number,7,2);
//            }
//            else if ( strlen($number) == 7 ) // ###-##-##
//            {
//                $number = substr($number,0,3).'-'.substr($number,3,2).'-'.substr($number,5,2);
//            }
//            else if ( strlen($number) == 6 ) // ##-##-##
//            {
//                $number = substr($number,0,2).'-'.substr($number,2,2).'-'.substr($number,4,2);
//            }
//            else if ( strlen($number) == 5 ) // #-##-##
//            {
//                $number = substr($number,0,1).'-'.substr($number,1,2).'-'.substr($number,3,2);
//            }
//            else if ( strlen($number) == 4 ) // ##-##
//            {
//                $number = substr($number,0,2).'-'.substr($number,2,2);
//            }
//        }
//        return $number;
//    }
//}
//
//if (!function_exists('getEmailById'))
//{
//    function getEmailById( $id ) {
//        if ( $id && $id > 0 )
//        {
//            $user = User::find( $id );
//            if ($user)
//                return $user->email;
//            else
//                return '--- not defined ---';
//        } else {
//            return '';
//        }
//    }
//}
//
//if (!function_exists('getFioById'))
//{
//    function getFioById( $id )
//    {
//        if ( $id && $id>0 )
//        {
//            $user = User::find($id);
//            if ($user)
//                return $user->last_name.' '.Str::substr($user->first_name,0,1).'.';
//            else
//                return '--- card not found ---';
//        } else {
//            return 'не указан(а)';
//        }
//    }
//}

//if (!function_exists('userLog'))
//{
//    function userLog( $message )
//    {
//        activity('user')->withProperties(['ip'=>request()->ip()])->log( $message );
//    }
//}
