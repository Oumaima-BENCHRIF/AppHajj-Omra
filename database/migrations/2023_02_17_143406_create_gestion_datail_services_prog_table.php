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
        Schema::connection('mysql_portal')->create('gestion_datail_services_prog', function (Blueprint $table) {
            $table->id();
            $table->longText('Service')->nullable();
            $table->longText('villes')->nullable();
            $table->longText('hotel_fournisseur')->nullable();
            
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
        Schema::connection('mysql_portal')->dropIfExists('gestion_datail_services_prog');
    }
};
