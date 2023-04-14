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
         Schema::connection('mysql_portal')->create('gestion_datail_hotel_programmes', function (Blueprint $table) {
            $table->id();
            $table->longText('ref_Hotels_prog')->nullable();
            $table->longText('ville_Hotel_prg')->nullable();
            $table->longText('duree_hotel_prg')->nullable();
            $table->longText('hotel_prg')->nullable();
            $table->longText('bnr_nuits_prg')->nullable();
            $table->longText('regime_prg')->nullable();
            $table->longText('type_chambre_prg')->nullable();
            $table->longText('chambre_prg')->nullable();
            $table->longText('prix_achat_prg')->nullable();
            $table->longText('prix_vente_prg')->nullable();
            $table->longText('prix_prg')->nullable();
            
            $table->unsignedBigInteger('FK_programme');
            $table->foreign('FK_programme')
                ->references('id')
                ->on('gestion_programme')
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
         Schema::connection('mysql_portal')->dropIfExists('gestion_datail_hotel_programmes');
    }
};
