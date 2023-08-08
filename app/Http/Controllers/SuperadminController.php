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
use Illuminate\Support\Str;

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

    //filtrer les clients par centre
    public function getClientByCenter($centerId)
    {
        $clients = Client::where('admin_id', $centerId)->get();
        return response()->json($clients, 200);
    }
    public function getAllClients()
    {
        $clients = Client::all();
        return response()->json($clients, 200);
    }

    //update superadmin
    public function updateSuperadmin(Request $request)
    {
        $request->validate([
            'image' => 'sometimes|image|nullable',
        ]);
        $data = $request->only([
            'nom', 'prenom', 'email', 'numerotel', 'image', 'country',
        ]);
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $request->image->storeAs('uploads', $filename, 'public');
            $path = 'http://localhost:8000/storage/uploads/' . $filename;
            $data['image'] = $path;
        }
     

        $superadmin = Auth::guard('superadmin')->user();
        $superadmin->update($data);

        return response()->json(['message' => 'Superadmin updated successfully', 'superadmin' => $superadmin], 200);
    }

    //reset email with confirmation password 
    public function resetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:superadmins',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $superadmin = Auth::guard('superadmin')->user();

        if (!$superadmin || !Hash::check($credentials['password'], $superadmin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $superadmin->update(['email' => $credentials['email']]);

        return response()->json(['message' => 'Email updated successfully', 'superadmin' => $superadmin], 200);
    }

    //reset password with confirmation password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
            'new_password' => 'required|min:6',
        ]);

        $credentials = $request->only('password', 'new_password');
        $superadmin = Auth::guard('superadmin')->user();

        if (!$superadmin || !Hash::check($credentials['password'], $superadmin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $superadmin->update(['password' => Hash::make($credentials['new_password'])]);

        return response()->json(['message' => 'Password updated successfully', 'superadmin' => $superadmin], 200);
    }
}
