<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->text('contenu');
            $table->unsignedBigInteger('client_id')->nullable(); // Clé étrangère vers la table clients
            $table->unsignedBigInteger('fournisseur_id')->nullable(); // Clé étrangère vers la table fournisseurs
            $table->unsignedBigInteger('service_id')->nullable(); // Clé étrangère vers la table services
            $table->unsignedBigInteger('produit_id')->nullable(); // Clé étrangère vers la table produits
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
