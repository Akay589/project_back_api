<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ouvrier;
use Illuminate\Http\Request;

class OuvrierController extends Controller
{
  //add a new ouvrier

  public function store(Request $request)
  {
      $ouvrier = new Ouvrier();
      $ouvrier->CodeO = $request->input('CodeO');
      $ouvrier->NomO = $request->input('NomO');
      $ouvrier->PrenO = $request->input('PrenO');
      $ouvrier->CodeF = $request->input('CodeF');
      $ouvrier->CIN = $request->input('CIN');
      $ouvrier->Contact = $request->input('Contact');

      $ouvrier->save();

      return response()->json([
          'status'=>200,
          'message' => 'ouvrier created successfully',

      ]);
  }

  //show ouvrier's list

  public function show()
  {
      $ouvrier = Ouvrier::all();


      return response()->json([
          'status'=>200,
          'ouvrier'=> $ouvrier
      ]);
  }


  //view an ouvrier

  public function index($CodeO)
  {
       $ouvrier = Ouvrier::findOrFail($CodeO);

       if($ouvrier)
       {
          return response()->json([
              'status'=>200,
              'ouvrier'=> $ouvrier
          ]);
       }
       else
       {
          return response()->json([
              'status'=>404,
              'message'=> 'ouvrier not found'
          ]);
       }

  }

  //update an ouvrier

  public function update(Request $request,$CodeO)
  {
      $ouvrier = Ouvrier::findOrFail($CodeO);

      $ouvrier->update([
        $ouvrier->CodeO = $request->CodeO,
        $ouvrier->NomO = $request->NomO,
        $ouvrier->PrenO = $request->PrenO,
        $ouvrier->CodeF = $request->CodeF,
        $ouvrier->CIN = $request->CIN,
        $ouvrier->Contact = $request->Contact,

      ]);

      $ouvrier->save();

      return response()->json([
          'status'=>200,
          'message'=> 'ouvrier updated'
      ]);

  }

  //delete an ouvrier

  public function destroy($CodeO)
   {
      $ouvrier = Ouvrier::findOrFail($CodeO);

      if($ouvrier)
         {
               $ouvrier->delete();
               return response()->json([
                  'status'=>200,
                  'message'=> 'ouvrier deleted'
              ]);

         }
      else
      {
          return response()->json([
              'status'=>404,
              'message'=> 'ouvrier not found'
          ]);
      }
   }
}
