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
        Schema::connection('mysql_portal')->create('gestion_allotements', function (Blueprint $table) {
            $table->id();
            $table->longText('num_allotement')->nullable();
            $table->longText('nom_allotement')->nullable();
            $table->longText('totale_accorde')->nullable();
            $table->longText('totale_occupe')->nullable();
            $table->longText('totale_reliquat')->nullable();

            $table->unsignedBigInteger('FK_compagnie');
            $table->foreign('FK_compagnie')
                ->references('id')
                ->on('compagnies')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->dropForeign('FK_compagnie');
            $table->foreign('FK_compagnie')
                ->references('id')->on('compagnies')
                ->onDelete('cascade');

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
        Schema::connection('mysql_portal')->dropIfExists('gestion_allotements');
    }
};
