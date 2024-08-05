<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
      $request->validate([
         'mailU' => 'required|email',
         'mdp' => 'required',

      ]);

      $user = User::where('mailU', $request->mailU)->first();

      if (!$user || !Hash::check($request->mdp, $user->mdp)) {
            return response()->json([
                'status'=>503,
                'message' => 'Login Invalid'

            ]);
      }
      $token = $user->createToken($user->Login.'_Token')->plainTextToken;
      return response()->json([
        'status'=>200,
        'message' => 'Logged in successfully',
        'data'=>$user->name,
        'token'=>$token,
         ]);
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

    //Forgot Password Function
    public function forgetPasssword(Request $request)
    {
        try
        {
            $user = User::where('mailU',$request->mailU)->get();// Retrieve the users matching the email

            if(count($user) > 0)
            {
                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token='.$token;

                $data['url'] = $url;
                $data['mailU']  = $request->mailU;
                $data['title'] = "Password Reset";

                $data['body1'] = "Vous avez demandé de reinitialiser votre mot de passe.  " ;
                $data['body2'] = "S'il vous plait, cliquez sur le lien ci dessous :" ;

                Mail::send('forgetPasswordMail',['data'=>$data],function($message) use($data){
                        $message->to($data['mailU'])->subject($data['title']);
                });

                $datetime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['mailU' =>$request->mailU],
                    [
                        'mailU' => $request->mailU,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );
                return response()->json([
                    'status'=>200,
                    'message' => "Un lien a été envoyé sur votre adresse mail",


                ]);

            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message' => "user not found",


                ]);
            }
        } catch (\Exception $e)
            {
                return response()->json([
                    'status'=>404,
                    'message' => $e->getMessage(),


                ]);
            }

    }

    //Reset password Function
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'mdp' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' =>422,
                'error' => $validator->errors()->first()
            ]);
        }

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$passwordReset) {

            return response()->json([
                'status' =>404,
                'error' => 'Token invalide.'
            ]);
        }

        $user = User::where('mailU', $passwordReset->mailU)->first();

        if (!$user) {

            return response()->json([
                'status' =>404,
                'error' => 'Utilisateur non trouvé.'
            ]);
        }

        $user->mdp = Hash::make($request->mdp);
        $user->save();

        DB::table('password_resets')->where('mailU', $passwordReset->mailU)->delete();


        return response()->json([
            'status' =>200,
            'message' => 'Votre mot de passe a été réinitialisé avec succès.'
        ]);
    }
}
