<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = [
        'nomproduit', 'tarif', 'description', 'fournisseur_id',
    ];

    // Relation avec le fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    // Relation avec les commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
