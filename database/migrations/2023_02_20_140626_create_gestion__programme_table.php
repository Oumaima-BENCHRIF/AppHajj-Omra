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
        Schema::connection('mysql_portal')->create('gestion__programme', function (Blueprint $table) {
            $table->id();
            $table->longText('ref_programme')->nullable();
            $table->longText('nom_programme')->nullable();
            $table->longText('type_programme')->nullable();
            $table->longText('nbr_nuitee_prog_mdina')->nullable();
            $table->longText('nbr_nuitee_prog_maka')->nullable();

            $table->unsignedBigInteger('FK_Num_vole_depart');
            $table->foreign('FK_Num_vole_depart')
                ->references('id')
                ->on('gestion_vole__departs')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->longText('Nbr_place_aller')->nullable();
            $table->longText('Nbr_reserver_depart')->nullable();

            $table->unsignedBigInteger('FK_Num_vole_retour');
            $table->foreign('FK_Num_vole_retour')
                ->references('id')
                ->on('gestion_vole__retours')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->longText('Nbr_place_retour')->nullable();
            $table->longText('Nbr_reserver_retour')->nullable();

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
        Schema::connection('mysql_portal')->dropIfExists('gestion__programme');
    }
};
