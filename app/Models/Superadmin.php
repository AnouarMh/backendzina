<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Superadmin extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $guarded = [];

    // Les attributs pouvant être masqués lorsque le modèle est converti en tableau ou JSON
    protected $hidden = ['password', 'remember_token'];

    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'numerotel', 'image', 'country',
        'verification_email', 'verification_numerotel',
    ];

    // Relation avec les admins
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    // Relation avec les clients via les centres
    public function clients()
    {
        return $this->hasManyThrough(Client::class, Admin::class, 'superadmin_id', 'admin_id');
    }
}

