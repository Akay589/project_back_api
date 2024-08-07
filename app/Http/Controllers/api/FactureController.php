<?php

namespace App\Http\Controllers\api;

use App\Models\Depense;

use Barryvdh\DomPDF\PDF;
use App\Http\Controllers\Controller;



class FactureController extends Controller
{
    public function show($numD)
    {
        // Récupérer les détails de la facture payée
        $facture = Depense::where('NumD', $numD)
            ->where('status', 'payé') // Assurez-vous que la facture est payée
            ->with(['devis', 'materiel'])
            ->firstOrFail();

        // Préparer les données pour l'affichage
        $data = [
            'numD' => $facture->NumD,
            'desM' => $facture->materiel->desM,
            'quantite' => $facture->devis->Quantité,
            'PrixU' => $facture->devis->PrixU,
            'date' => $facture->DateF,
        ];

        return response()->json([
            'status' =>200,
            'facture' => $data
        ]);
    }

    public function download($numD)
    {
        $facture = Depense::where('NumD', $numD)
            ->where('status', 'payé') // Assurez-vous que la facture est payée
            ->with(['devis', 'materiel'])
            ->firstOrFail();

        $data = [
            'numD' => $facture->NumD,
            'desM' => $facture->materiel->desM,
            'quantite' => $facture->devis->Quantité,
            'PrixU' => $facture->devis->PrixU,
            'date' => $facture->DateF,
            'status' => $facture->status // Ajouter le statut ici
        ];

        $pdf = PDF::loadView('facture.pdf',$data);

        return $pdf->download('facture-' . $numD . '.pdf');
    }
}
