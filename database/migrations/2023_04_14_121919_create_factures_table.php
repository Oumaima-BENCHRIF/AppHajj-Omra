<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_portal')->create('factures', function (Blueprint $table) {
            $table->id();
            $table->longText('Code_client')->nullable();
            $table->longText('numero_facture')->nullable();
            $table->longText('Numero_dossier')->nullable();
            $table->longText('bon_commande')->nullable();
            $table->date('date')->nullable();
            $table->longText('Vos_ref')->nullable(); 
            $table->longText('Nom_client')->nullable();
            $table->longText('adresse')->nullable();
            $table->longText('ville')->nullable();
            $table->longText('Total')->nullable();
            $table->longText('designation')->nullable();
            $table->longText('date_departs')->nullable();
            $table->longText('date_Arrives')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
};
