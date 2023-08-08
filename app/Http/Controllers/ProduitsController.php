<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produit;

class ProduitsController extends Controller
{
    //ajouter un produit
    public function addProduit(Request $request)
    {
        $produit = new Produit();
        $produit->nom = $request->nom;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->image = $request->image;
        $produit->categorie_id = $request->categorie_id;
        $produit->fournisseur_id = $request->fournisseur_id;
        $produit->save();
        return response()->json($produit, 200);
    }

    


}
