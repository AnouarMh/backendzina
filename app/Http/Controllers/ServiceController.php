<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
class ServiceController extends Controller
{
    //ajouter un service
    public function addService(Request $request)
    {
        $service = new Service();
        $service->nom = $request->nom;
        $service->description = $request->description;
        $service->prix = $request->prix;
        $service->image = $request->image;
        $service->categorie_id = $request->categorie_id;
        $service->fournisseur_id = $request->fournisseur_id;
        $service->save();
        return response()->json($service, 200);
    }

    //modifier un service
    public function updateService(Request $request, $id)
    {
        $service = Service::find($id);
        $service->nom = $request->nom;
        $service->description = $request->description;
        $service->prix = $request->prix;
        $service->image = $request->image;
        $service->categorie_id = $request->categorie_id;
        $service->fournisseur_id = $request->fournisseur_id;
        $service->save();
        return response()->json($service, 200);
    }

    //supprimer un service
    public function deleteService($id)
    {
        $service = Service::find($id);
        $service->delete();
        return response()->json($service, 200);
    }

    //afficher un service
    public function getService($id)
    {
        $service = Service::find($id);
        return response()->json($service, 200);
    }

    //afficher tous les services
    public function getAllServices()
    {
        $services = Service::all();
        return response()->json($services, 200);
    }

    //afficher les services d'un fournisseur
    public function getServicesByFournisseur($id)
    {
        $services = Service::where('fournisseur_id', $id)->get();
        return response()->json($services, 200);
    }

    //afficher les services d'une categorie
    public function getServicesByCategorie($id)
    {
        $services = Service::where('categorie_id', $id)->get();
        return response()->json($services, 200);
    }

    //afficher les services d'une categorie et d'un fournisseur

    public function getServicesByCategorieAndFournisseur($idCategorie, $idFournisseur)
    {
        $services = Service::where('categorie_id', $idCategorie)->where('fournisseur_id', $idFournisseur)->get();
        return response()->json($services, 200);
    }

 


}
