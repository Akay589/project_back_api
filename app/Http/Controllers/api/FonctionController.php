<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Fonction;
use Illuminate\Http\Request;


class FonctionController extends Controller
{
    //add a new fonction

   public function store(Request $request)
   {
       $fonction = new Fonction();
       $fonction->CodeF = $request->input('CodeF');
       $fonction->fonction = $request->input('fonction');

       $fonction->save();

       return response()->json([
           'status'=>200,
           'message' => 'fonction created successfully',

       ]);
   }

   //show fonction's list

   public function show()
   {
       $fonction = Fonction::all();


       return response()->json([
           'status'=>200,
           'fonction'=> $fonction
       ]);
   }


   //view an fonction

   public function index($CodeF)
   {
        $fonction = Fonction::findOrFail($CodeF);

        if($fonction)
        {
           return response()->json([
               'status'=>200,
               'fonction'=> $fonction
           ]);
        }
        else
        {
           return response()->json([
               'status'=>404,
               'message'=> 'fonction not found'
           ]);
        }

   }

   //update an fonction

   public function update(Request $request,$CodeF)
   {
       $fonction = Fonction::findOrFail($CodeF);

       $fonction->update([
         $fonction->CodeF = $request->CodeF,
         $fonction->fonction = $request->fonction,

       ]);

       $fonction->save();

       return response()->json([
           'status'=>200,
           'message'=> 'fonction updated'
       ]);

   }

   //delete an fonction

   public function destroy($CodeF)
    {
       $fonction = Fonction::findOrFail($CodeF);

       if($fonction)
          {
                $fonction->delete();
                return response()->json([
                   'status'=>200,
                   'message'=> 'fonction deleted'
               ]);

          }
       else
       {
           return response()->json([
               'status'=>404,
               'message'=> 'fonction not found'
           ]);
       }
    }
}
