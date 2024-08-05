<?php

namespace App\Http\Controllers\api;

use App\Models\Devis;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DepenseController extends Controller
{
       //to change depense'statut to payé
    public function payer($NumD, $CodeM)
    {
        DB::table('depense')
            ->where('NumD', $NumD)
            ->where('CodeM', $CodeM)
            ->update([
                'status' => 'payé',
                'updated_at' => now()
            ]);

        return response()->json(['message' => 'Facture payée avec succès']);
    }

    public function annuler($NumD, $CodeM)
    {
        DB::table('depense')
            ->where('NumD', $NumD)
            ->where('CodeM', $CodeM)
            ->update([
                'status' => 'annulé',
                'updated_at' => now()
            ]);

        return response()->json(['message' => 'Facture annulée avec succès']);
    }


    //show list of unpaid_facture
    public function facture_impayé()
    {

        $unpaidFactures = DB::table('depense')
            ->join('devis', 'depense.NumD', '=', 'devis.NumD')
            ->join('materiels', 'depense.CodeM', '=', 'materiels.CodeM')
            ->select(
                'depense.NumD',
                'materiels.desM',
                'devis.Quantité',
                'devis.PrixU',
                'depense.DateF'
            )
            ->where('depense.status', 'impayé')
            ->get();

        return response()->json([
            'status' =>200,
            'facture_impayé' => $unpaidFactures
        ]);
    }

    //show list of paid_facture
    public function facture_payé() {
        $paidFactures = DB::table('depense')
        ->join('devis', 'depense.NumD', '=', 'devis.NumD')
        ->join('materiels', 'depense.CodeM', '=', 'materiels.CodeM')
        ->select(
            'depense.NumD',
            'materiels.desM',
            'devis.Quantité',
            'devis.PrixU',
            'depense.DateF'
        )
        ->where('depense.status', 'payé')
        ->get();

    return response()->json([
        'status' =>200,
        'facture_payé' => $paidFactures
    ]);
    }

        //show list of canceled_facture
    public function facture_annule() {
        $canceledpaidFactures = DB::table('depense')
        ->join('devis', 'depense.NumD', '=', 'devis.NumD')
        ->join('materiels', 'depense.CodeM', '=', 'materiels.CodeM')
        ->select(
            'depense.NumD',
            'materiels.desM',
            'devis.Quantité',
            'devis.PrixU',
            'depense.DateF'
        )
        ->where('depense.status', 'annulé')
        ->get();

    return response()->json([
        'status' =>200,
        'facture_annulé' => $canceledpaidFactures
    ]);
    }
}
