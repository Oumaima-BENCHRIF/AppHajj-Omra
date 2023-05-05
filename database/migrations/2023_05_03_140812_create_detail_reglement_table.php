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
        Schema::connection('mysql_portal')->create('detail_reglement', function (Blueprint $table) {
            $table->id();
           
            $table->unsignedBigInteger('FK_reglement');
            $table->foreign('FK_reglement')
                ->references('id')
                ->on('factures') 
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->unsignedBigInteger('FK_factures');
            $table->foreign('FK_factures')
                ->references('id')
                ->on('gestion_reglement')
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
        Schema::dropIfExists('detail_reglement');
    }
};
