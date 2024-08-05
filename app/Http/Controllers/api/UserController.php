<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //add a new user

    public function store(Request $request)
    {
        $user = new User();
        $user->Login = $request->input('Login');
        $user->mailU = $request->input('mailU');
        $user->mdp = Hash::make($request->input('mdp'));
        $user->nomU = $request->input('nomU');
        $user->telU = $request->input('telU');

        $user->AdresseConstruction = $request->input('AdresseConstruction');

        $user->save();

        return response()->json([
            'status'=>200,
            'message' => 'User created successfully',

        ]);
    }

    //show user's list

    public function show()
    {
        $user = User::all();


        return response()->json([
            'status'=>200,
            'user'=> $user
        ]);
    }


    //view an user

    public function index($Login)
    {
         $user = User::findOrFail($Login);

         if($user)
         {
            return response()->json([
                'status'=>200,
                'user'=> $user
            ]);
         }
         else
         {
            return response()->json([
                'status'=>404,
                'message'=> 'user not found'
            ]);
         }

    }

    //update an user

    public function update(Request $request,$Login)
    {
        $user = User::findOrFail($Login);

        $user->update([
          $user->Login = $request->Login,
          $user->mdp = $request->mdp,
          $user->nomU = $request->nomU,
          $user->telU = $request->telU,
          $user->mailU = $request->mailU,

          $user->AdresseConstruction = $request->AdresseConstruction,
        ]);

        $user->save();

        return response()->json([
            'status'=>200,
            'message'=> 'user updated'
        ]);

    }

    //delete an user

    public function destroy($Login)
     {
        $user = User::findOrFail($Login);

        if($user)
           {
                 $user->delete();
                 return response()->json([
                    'status'=>200,
                    'message'=> 'user deleted'
                ]);

           }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=> 'user not found'
            ]);
        }
     }



}
