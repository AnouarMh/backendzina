<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'admin_id', 'fournisseur_id', 'produit_id', 'quantite',
    ];

    // Relation avec l'admin du centre
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Relation avec le fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    // Relation avec le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
