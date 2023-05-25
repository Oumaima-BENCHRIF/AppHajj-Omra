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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_Agence');
            $table->foreign('id_Agence')
                ->references('id')
                ->on('Agence')
                ->onDelete('restrict')
                ->onUpdate('restrict');
           $table->unsignedBigInteger('id_Succursales');
           $table->foreign('id_Succursales')
                    ->references('id')
                    ->on('succursales')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
          $table->string('ville'); 
          $table->string('baseName');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
