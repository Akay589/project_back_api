<?php

namespace App\Http\Controllers\api;

use App\Models\Devis;
use App\Models\Depense;
use App\Models\Materiel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DeviController extends Controller
{
   //add a new devi

   public function store(Request $request)
   {
       $request->validate([
           'NumD' => 'required|integer|unique:devis,NumD',
           'DateDv' => 'required|date',
           'user_id' => 'required|exists:users,id',
           'CodeO' => 'required|exists:ouvriers,CodeO',
           'PrixU' => 'required|integer',
           'CodeUnit' => 'required|exists:unites,CodeUnit',
           'Quantité' => 'required|integer',
           'Montant' => 'required|integer',
           'CodeM' => 'required|string|exists:materiels,CodeM'
       ]);

       $devis = Devis::create($request->only(['NumD', 'DateDv', 'user_id', 'CodeO', 'PrixU', 'CodeUnit', 'Quantité', 'Montant']));

       $devis->materiels()->attach($request->CodeM, [
           'status' => 'impayé',
           'DateF' => now()
       ]);

       // Charger explicitement la relation 'materiels'
       return response()->json($devis->load('materiels'), 201);
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
         $devi->user_id = $request->user_id,
         $devi->CodeO = $request->CodeO,
         $devi->PrixU = $request->PrixU,
         $devi->CodeUnit = $request->CodeUnit,
         $devi->Quantité = $request->Quantité,
         $devi->Montant = $request->Montant,

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


      // Marquer le devis comme facturé et créer les dépenses correspondantes
      public function facturer($NumD)
      {
          // Trouver le devis par NumD
          $devis = Devis::findOrFail($NumD);

          // Vérifier si le devis a déjà été facturé
          foreach ($devis->materiels as $materiel) {
              $existingDepense = $devis->materiels()->wherePivot('CodeM', $materiel->pivot->CodeM)->first();
              if ($existingDepense && $existingDepense->pivot->status != 'impayé') {
                  return response()->json(['message' => 'Le devis a déjà été facturé.'], 400);
              }
          }

          // Mettre à jour ou créer les entrées dans la table pivot 'depense' avec le statut 'impayé'
          foreach ($devis->materiels as $materiel) {
              $devis->materiels()->updateExistingPivot($materiel->pivot->CodeM, [
                  'status' => 'impayé',
                  'DateF' => now()
              ]);
          }

          return response()->json(['message' => 'Devis facturé avec succès']);
      }


      // Marquer la dépense comme payée
      public function pay($NumD, $CodeM)
      {
            $depense = Depense::where('NumD', $NumD)->where('CodeM', $CodeM)->first();

            if (!$depense) {
                return response()->json(['message' => 'Dépense non trouvée'], 404);
            }

            $depense->status = 'payé';
            $depense->save();

            return response()->json(['message' => 'Dépense payée'], 200);
      }
}
