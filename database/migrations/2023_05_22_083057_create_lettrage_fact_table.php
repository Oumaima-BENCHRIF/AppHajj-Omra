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
        
        Schema::connection('mysql_portal')->create('lettrage_fact', function (Blueprint $table) {
            $table->id();
           
            $table->string('num_reglement');
            $table->string('num_factures');
            $table->string('Acompte');
            $table->string('Nligne');
            $table->string('Date_Let');
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
        Schema::dropIfExists('lettrage_fact');
    }
};
