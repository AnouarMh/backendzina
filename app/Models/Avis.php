<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'contenu', 'client_id', 'fournisseur_id', 'service_id', 'produit_id',
    ];

    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relation avec le fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    // Relation avec le service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relation avec le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
