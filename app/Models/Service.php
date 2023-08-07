<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'nom', 'description', 'tarif', 'duree', 'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
