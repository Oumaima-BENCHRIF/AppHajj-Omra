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
        Schema::connection('mysql_portal')->create('detail_factures', function (Blueprint $table) {
           
            $table->id();
            $table->string('nom_complet');
            ;
            $table->double('prix');
            $table->string('FK_Facture');
            $table->foreign('FK_Facture')
                ->references('id')
                ->on('factures')
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
        Schema::dropIfExists('detail_facture');
    }
};
