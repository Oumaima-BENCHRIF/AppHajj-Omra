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
         Schema::connection('mysql_portal')->create('gestion__categories', function (Blueprint $table) {
            $table->id();
            $table->longText('num_categorie')->nullable();
            $table->longText('nom_categorie')->nullable();
            $table->longText('Nbre_pax')->nullable();
            $table->longText('remis')->nullable();
            $table->longText('date')->nullable();
            
            $table->unsignedBigInteger('FK_type');
            $table->foreign('FK_type')
                ->references('id')
                ->on('gestion_type_programme')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::connection('mysql_portal')->dropIfExists('gestion__categories');
    }
};
