<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

use App\ApiModel\v2\Position;

use Auth;

class LoginController extends Controller
{
    public function login($email, $password){

        if (Auth::attempt(['email' => $email, 'password' => $password])){

            $user = User::where('email', '=', $email)
                ->join('tblPosition', 'tblPosition.intPositionId', '=', 'users.intPositionIdFK')
                ->first();

            return response()
                ->json(
                    [
                        'message'   =>  'Login successful.'
                    ],
                    200
                );

        }//end if

        return response()
            ->json(
                [
                    'message'       =>  'Incorrect email or password.'
                ],
                500
            );

    }//end function

    public function logout(){

        Auth::logout();

        return response()
            ->json(
                [
                    'message'       =>  'Logout successful.'
                ],
                200
            );

    }//end function

    public function getUserLogin(){

        $user           =   Auth::user();
        $user->position     =   Position::find($user->intPositionIdFK);

        return response()
            ->json(
                [
                    'user'      =>  $user
                ],
                200
            );

    }//end function
}
