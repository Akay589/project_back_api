<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{




    //email function

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email|users',
            'password' => 'required|min:8|max:100',
         ]);

        if($validator->fails())
         {
            return response()->json([

                'validation_errors' => $validator->messages(),

            ]);
         }
        else
         {
            $user = User::where('email', $request->email)->first();

              if(! $user || ! Hash::check($request->password, $user->password))
               {
                    return response()->json([
                        'status'=>401,
                        'message' => 'Invalid Credentials'

                    ]);
               }
              else
              {
                    $token = $user->createToken($user->email.'_Token')->plainTextToken;

                    return response()->json([
                    'status'=>200,
                    'message' => 'Logged in successfully',
                    'data'=>$user->name,
                    'token'=>$token,
                     ]);
              }
         }
    }


    //Logout function

    public function  logout()
    {
      /**
         * @var $user App\Models\User
         */
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->json([
            'status'=>200,
            'message' => 'Log out successfull',


        ]);
    }
}
