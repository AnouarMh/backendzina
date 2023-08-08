<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function createCenter(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'country' => 'required',
        ]);
    
        // Remplacez ce code par la logique pour récupérer l'ID du superadmin
    
        $data = $request->only([
            'nom', 'email', 'password', 'numerotel', 'image', 'country', 'localisation', 'horaire'
        ]);
    
        // ... Autres étapes de validation et de traitement
        //donne la valeur  de superadmin_id si la superadmin ajouter le centre si nn donne 0
        $data['superadmin_id'] = Auth::guard('superadmin')->user()->id;

    
        $data['password'] = Hash::make($data['password']);
        $admin = Admin::create($data);
    
        return response()->json(['message' => 'Admin de centre créé avec succès', 'admin' => $admin], 201);
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $admin = Admin::where('email', $credentials['email'])->first();
    
        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $token = $admin->createToken('admin-token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

   //get les clients par centre
    public function getClients()
    {
        $id=Auth::guard('admin')->user()->id;
        $clients = Client::where('admin_id',$id) ->get();
        return response()->json(['clients' => $clients], 200);
    }
   

    public function manageReservations()
    {
        // Logique pour gérer les réservations du centre
        $reservations = Reservation::all();
        return view('admin.manageReservations', compact('reservations'));
    }

    public function manageServices()
    {

        // Logique pour gérer les services du centre
        $services = Service::all();
        return view('admin.manageServices', compact('services'));

    }

    public function orderProductsFromFournisseur(Request $request)
    {
        // Logique pour commander des produits auprès des fournisseurs
        $request->validate([
            'produit_id' => 'required',
            'quantite' => 'required',
            'fournisseur_id' => 'required',
        ]);

        $data = $request->only([
            'produit_id', 'quantite', 'fournisseur_id'
        ]);

        $data['admin_id'] = Auth::guard('admin')->user()->id;

        $commande = Commande::create($data);

        return response()->json(['message' => 'Commande créée avec succès', 'commande' => $commande], 201);
    }

    //cree un client par un admin
    public function createClient(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|unique:clients',
            'password' => 'required|min:6',
            'country' => 'required',
        ]);
    
        // Remplacez ce code par la logique pour récupérer l'ID du superadmin
    
        $data = $request->only([
            'nom', 'prenom', 'email', 'password', 'numerotel', 'image', 'country', 'langue',
        ]);
    
        // ... Autres étapes de validation et de traitement
        //donne la valeur  de superadmin_id si la superadmin ajouter le centre si nn donne 0
        $data['admin_id'] = Auth::guard('admin')->user()->id;

    
        $data['password'] = Hash::make($data['password']);
        $client = Client::create($data);
    
        return response()->json(['message' => 'Client créé avec succès', 'client' => $client], 201);

    
        }

    
}
