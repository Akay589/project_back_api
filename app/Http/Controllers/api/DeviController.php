<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Devis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeviController extends Controller
{
   //add a new devi

   public function store(Request $request)
   {
       $devi = new Devis();
       $devi->NumD = $request->input('NumD');
       $devi->DateDv = $request->input('DateDv');
       $devi->Login = $request->input('Login');
       $devi->CodeO = $request->input('CodeO');
       $devi->PrixU = $request->input('PrixU');
       $devi->CodeUnit = $request->input('CodeUnit');
       $devi->Montant = $request->input('Montant');
       $devi->type = $request->input('type');
       $devi->save();

       return response()->json([
           'status'=>200,
           'message' => 'devi created successfully',

       ]);
   }

   //show devi's list

   public function show()
   {
       $devi = Devis::all();


       return response()->json([
           'status'=>200,
           'devi'=> $devi
       ]);
   }


   //view an devi

   public function index($NumD)
   {
        $devi = Devis::findOrFail($NumD);

        if($devi)
        {
           return response()->json([
               'status'=>200,
               'devi'=> $devi
           ]);
        }
        else
        {
           return response()->json([
               'status'=>404,
               'message'=> 'devi not found'
           ]);
        }

   }

   //update an devi

   public function update(Request $request,$NumD)
   {
       $devi = Devis::findOrFail($NumD);

       $devi->update([
         $devi->NumD = $request->NumD,
         $devi->DateDv = $request->DateDv,
         $devi->Login = $request->Login,
         $devi->CodeO = $request->CodeO,
         $devi->PrixU = $request->PrixU,
         $devi->CodeUnit = $request->CodeUnit,
         $devi->Montant = $request->Montant,
         $devi->type = $request->type,
       ]);

       $devi->save();

       return response()->json([
           'status'=>200,
           'message'=> 'devi updated'
       ]);

   }

   //delete an devi

   public function destroy($NumD)
    {
       $devi = Devis::findOrFail($NumD);

       if($devi)
          {
                $devi->delete();
                return response()->json([
                   'status'=>200,
                   'message'=> 'devi deleted'
               ]);

          }
       else
       {
           return response()->json([
               'status'=>404,
               'message'=> 'devi not found'
           ]);
       }
    }
}
