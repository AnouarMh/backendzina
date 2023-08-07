<?php

namespace Database\Seeders;
use App\Models\Superadmin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Superadmin::create([
            'nom' => 'Votre Nom',
            'prenom' => 'Votre Prénom',
            'email' => 'votre@email.com',
            'password' => bcrypt('votre_mot_de_passe'),
            'numerotel' => 'Votre Numéro de Téléphone',
            'image' => 'chemin_vers_votre_image',
            'country' => 'Votre Pays',
            'verification_email' => true, // ou false selon le cas
            'verification_numerotel' => true, // ou false selon le cas
        ]);
    }
}
