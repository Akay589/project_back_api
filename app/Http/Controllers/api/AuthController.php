<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
     //register function
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'Login' => 'required|min:2|max:100',
             'mailU' => 'email|unique:users',
             'mdp' => 'required|min:8|max:100',
             'nomU' => 'required|min:2|max:100',
             'telU' => 'required|min:8|max:25',
             'role_id' => 'required',
             'AdresseConstruction' => 'required|min:6|max:100',
          ]);

        if($validator->fails())
          {
            return response()->json([
                 'status'=>400,
                 'message' => 'Validator failled'

             ]);
          }
        else
        {
            $user = User::create([
                'Login' => $request->Login,
                'mailU' => $request->mailU,
                'AdresseConstruction' => $request->AdresseConstruction,
                'telU' => $request->telU,
                'nomU' => $request->nomU,

                'role_id' => $request->role_id,
                'mdp' =>Hash::make($request->mdp)
             ]);
            $token = $user->createToken($user->Login.'_Token')->plainTextToken;

            return response()->json([
                'status'=>200,
                'message' => 'registration successfull',
                'data'=>$user->nomU,
                'token'=>$token,
            ]);
        }


    }


    //login function

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'Login' => 'required|min:2|max:100',
            'mdp' => 'required|min:8|max:100',
         ]);

        if($validator->fails())
         {
            return response()->json([

                'validation_errors' => $validator->messages(),

            ]);
         }
        else
         {
            $user = User::where('Login', $request->Login)->first();

              if(! $user || ! Hash::check($request->mdp, $user->mdp))
               {
                    return response()->json([
                        'status'=>401,
                        'message' => 'Invalid Credentials'

                    ]);
               }
              else
              {
                    $token = $user->createToken($user->Login.'_Token')->plainTextToken;

                    return response()->json([
                    'status'=>200,
                    'message' => 'Logged in successfully',
                    'data'=>$user->nomU,
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
