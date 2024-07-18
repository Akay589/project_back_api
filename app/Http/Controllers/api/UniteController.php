<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Unite;
use Illuminate\Http\Request;

class UniteController extends Controller
{
   //add a new unite

   public function store(Request $request)
   {
       $unite = new Unite();
       $unite->CodeUnit = $request->input('CodeUnit');
       $unite->unite = $request->input('unite');

       $unite->save();

       return response()->json([
           'status'=>200,
           'message' => 'unite created successfully',

       ]);
   }

   //show unite's list

   public function show()
   {
       $unite = unite::all();


       return response()->json([
           'status'=>200,
           'unite'=> $unite
       ]);
   }


   //view an unite

   public function index($CodeUnit)
   {
        $unite = unite::findOrFail($CodeUnit);

        if($unite)
        {
           return response()->json([
               'status'=>200,
               'unite'=> $unite
           ]);
        }
        else
        {
           return response()->json([
               'status'=>404,
               'message'=> 'unite not found'
           ]);
        }

   }

   //update an unite

   public function update(Request $request,$CodeUnit)
   {
       $unite = unite::findOrFail($CodeUnit);

       $unite->update([
         $unite->CodeUnit = $request->CodeUnit,
         $unite->unite = $request->unite,

       ]);

       $unite->save();

       return response()->json([
           'status'=>200,
           'message'=> 'unite updated'
       ]);

   }

   //delete an unite

   public function destroy($CodeUnit)
    {
       $unite = unite::findOrFail($CodeUnit);

       if($unite)
          {
                $unite->delete();
                return response()->json([
                   'status'=>200,
                   'message'=> 'unite deleted'
               ]);

          }
       else
       {
           return response()->json([
               'status'=>404,
               'message'=> 'unite not found'
           ]);
       }
    }
}
