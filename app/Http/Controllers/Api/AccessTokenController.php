<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokenController extends Controller
{

  
    public function store (Request $request)
    {



        $request->validate([
            'email'=>'required|email|max:255' ,
            'password'=>'required|string|min:6' ,
            'device_name'=>'string|max:255'

        ]) ;

        $user = User::where('email',$request->email)->first() ;

            if($user && Hash::check($request->password, $user->password))
            {
                $device_name =$request->post('device_name',$request->userAgent()) ;

                $token = $user->createToken($device_name) ;

                return FacadesResponse::json([
                    'token'=>$token->plainTextToken ,
                    'user'=>$user ,
                ],201) ;
     

            }



            $admin = Admin::where('email',$request->email)->first() ;

            if($admin && Hash::check($request->password, $admin->password))
            {
                $device_name =$request->post('device_name',$request->userAgent()) ;

                $token = $admin->createToken($device_name) ;

                return FacadesResponse::json([
                    'token'=>$token->plainTextToken ,
                    'user'=>$admin ,
                ],201) ;
     

            }


            return FacadesResponse::json([
                'message'=>'invalidCredentials' ,

            ],401) ;
    }


    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();


        // Revoke all tokens
        // $user->tokens()->delete();

        if (null === $token) {
            $user->currentAccessToken()->delete();
            return;
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);
        if (
            $user->id == $personalAccessToken->tokenable_id 
            && get_class($user) == $personalAccessToken->tokenable_type
        ) {
            $personalAccessToken->delete();
        }
    }


}
