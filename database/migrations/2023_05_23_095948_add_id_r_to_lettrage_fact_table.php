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
        Schema::table('lettrage_fact', function (Blueprint $table) {
            $table->unsignedBigInteger('id_regle');
            $table->foreign('id_regle')
                ->references('id')
                ->on('gestion_reglement')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lettrage_fact', function (Blueprint $table) {
            //
        });
    }
};
