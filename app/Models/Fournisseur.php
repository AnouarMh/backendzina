<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Fournisseur extends Authenticatable
{
    use HasApiTokens, Notifiable;


    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = [
        'nom', 'email', 'password', 'numerotel', 'image', 'country',
        'localisation', 'horaire', 'admin_id',
    ];

    // Relation avec l'admin du centre
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Relation avec les produits du fournisseur
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
