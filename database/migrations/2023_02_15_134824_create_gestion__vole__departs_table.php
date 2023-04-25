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
        Schema::connection('mysql_portal')->create('gestion_Vole__departs', function (Blueprint $table) {
            $table->id();
            $table->longText('date_depart')->nullable();
            $table->longText('num_vol')->nullable();
            $table->longText('parcours')->nullable();
            $table->longText('total_accorde')->nullable();
            $table->longText('heure_depart')->nullable();
            $table->longText('heure_arrivee')->nullable();

            $table->unsignedBigInteger('FK_allotement');
            $table->foreign('FK_allotement')
                ->references('id')
                ->on('gestion_allotements')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->unsignedBigInteger('FK_parcours');
            $table->foreign('FK_parcours')
                ->references('id')
                ->on('gestion_parcours')
                ->onDelete('restrict')
                ->onUpdate('restrict');

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
        Schema::connection('mysql_portal')->dropIfExists('gestion_Vole__departs');
    }
};
