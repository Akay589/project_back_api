<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
     //add a new materiel

     public function store(Request $request)
     {
         $materiel = new Materiel();
         $materiel->CodeM = $request->input('CodeM');
         $materiel->desM = $request->input('desM');

         $materiel->save();

         return response()->json([
             'status'=>200,
             'message' => 'materiel created successfully',

         ]);
     }

     //show materiel's list

     public function show()
     {
         $materiel = Materiel::all();


         return response()->json([
             'status'=>200,
             'materiel'=> $materiel
         ]);
     }


     //view an materiel

     public function index($CodeM)
     {
          $materiel = materiel::findOrFail($CodeM);

          if($materiel)
          {
             return response()->json([
                 'status'=>200,
                 'materiel'=> $materiel
             ]);
          }
          else
          {
             return response()->json([
                 'status'=>404,
                 'message'=> 'materiel not found'
             ]);
          }

     }

     //update an materiel

     public function update(Request $request,$CodeM)
     {
         $materiel = Materiel::findOrFail($CodeM);

         $materiel->update([
           $materiel->CodeM = $request->CodeM,
           $materiel->desM = $request->desM,

         ]);

         $materiel->save();

         return response()->json([
             'status'=>200,
             'message'=> 'materiel updated'
         ]);

     }

     //delete an materiel

     public function destroy($CodeM)
      {
         $materiel = Materiel::findOrFail($CodeM);

         if($materiel)
            {
                  $materiel->delete();
                  return response()->json([
                     'status'=>200,
                     'message'=> 'materiel deleted'
                 ]);

            }
         else
         {
             return response()->json([
                 'status'=>404,
                 'message'=> 'materiel not found'
             ]);
         }
      }
}
