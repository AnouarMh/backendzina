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
        // Logique pour gérer la connexion d'un centre (admin)
    }

    public function manageClients()
    {
        // Logique pour gérer les clients du centre
    }

    public function manageReservations()
    {
        // Logique pour gérer les réservations du centre
    }

    public function manageServices()
    {
        // Logique pour gérer les services du centre
    }

    public function orderProductsFromFournisseur(Request $request)
    {
        // Logique pour commander des produits auprès des fournisseurs
    }
}
