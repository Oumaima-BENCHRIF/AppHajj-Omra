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
        Schema::connection('mysql_portal')->create('gestion_Reglement', function (Blueprint $table) {
            $table->id();
            $table->string('N_reglement');
            $table->string('date_r');
            $table->string('jornal');
            $table->string('utilisateur');
            $table->string('client');
            $table->string('n_piece');
            $table->string('sens');
            $table->string('mode');
            $table->string('societe');
            $table->string('montant');
            $table->string('libelle');
            $table->string('m_reglement');
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
        Schema::dropIfExists('gestion_Reglement');
    }
};
