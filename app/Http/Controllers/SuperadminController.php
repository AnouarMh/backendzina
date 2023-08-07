<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin;
use App\Models\Admin;
use App\Models\Fournisseur;
use App\Models\Client;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SuperadminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $superadmin = Superadmin::where('email', $credentials['email'])->first();
    
        if (!$superadmin || !Hash::check($credentials['password'], $superadmin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $token = $superadmin->createToken('superadmin-token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }
  


    public function logout()
    {
        Auth::guard('superadmin')->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function getAdmins()
    {
        $admins = Admin::all();
        return response()->json($admins, 200);
    }

    public function getFournisseurs()
    {
        $fournisseurs = Fournisseur::all();
        return response()->json($fournisseurs, 200);
    }

    public function getClientByAdmin($adminId)
    {
        $clients = Client::where('admin_id', $adminId)->get();
        return response()->json($clients, 200);
    }

}
