<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'numerotel', 'image', 'country', 'langue',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
