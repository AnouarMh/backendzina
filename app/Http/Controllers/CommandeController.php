<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Commande;

class CommandeController extends Controller
{
    //ajouter une commande
    public function addCommande(Request $request)
    {
        $commande = new Commande();
        $commande->date = $request->date;
        $commande->heure = $request->heure;
        $commande->client_id = $request->client_id;
        $commande->save();
        return response()->json($commande, 200);
    }

    //modifier une commande
    public function updateCommande(Request $request, $id)
    {
        $commande = Commande::find($id);
        $commande->date = $request->date;
        $commande->heure = $request->heure;
        $commande->client_id = $request->client_id;
        $commande->save();
        return response()->json($commande, 200);
    }

    //supprimer une commande

    public function deleteCommande($id)
    {
        $commande = Commande::find($id);
        $commande->delete();
        return response()->json($commande, 200);
    }

    //afficher une commande
    public function getCommande($id)
    {
        $commande = Commande::find($id);
        return response()->json($commande, 200);
    }

    //afficher toutes les commandes
    public function getCommandes()
    {
        $commandes = Commande::all();
        return response()->json($commandes, 200);
    }

    //afficher les commandes d'un client
    public function getCommandesClient($id)
    {
        $commandes = Commande::where('client_id', $id)->get();
        return response()->json($commandes, 200);
    }

    //afficher les commandes d'un service
    public function getCommandesService($id)
    {
        $commandes = Commande::where('service_id', $id)->get();
        return response()->json($commandes, 200);
    }

    //afficher les commandes d'un admin
    public function getCommandesAdmin($id)
    {
        $commandes = Commande::where('admin_id', $id)->get();
        return response()->json($commandes, 200);
    }


}
