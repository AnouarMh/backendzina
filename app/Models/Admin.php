<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];

    protected $fillable = [
        'nom', 'email', 'password', 'numerotel', 'image', 'country',
        'localisation', 'horaire', 'superadmin_id',
    ];
    public function superadmin()
    {
        return $this->belongsTo(Superadmin::class, 'superadmin_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function reservations()
    {
        return $this->hasManyThrough(Reservation::class, Service::class);
    }

    public function clients()
    {
        return $this->hasManyThrough(Client::class, Service::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
