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
        Schema::connection('mysql_portal')->create('gestion_inclus', function (Blueprint $table) {
            $table->id();
            $table->longText('exclu_Billet')->nullable();
            $table->longText('Reduction_Billet')->nullable();
            $table->longText('Raison_Billet')->nullable();

            $table->longText('exclu_Transport')->nullable();
            $table->longText('Reduction_Transport')->nullable();
            $table->longText('Raison_Transport')->nullable();

            $table->longText('exclu_Hotel_Meedina')->nullable();
            $table->longText('Reduction_Hotel_Meedina')->nullable();
            $table->longText('Raison_Hotel_Meedina')->nullable();

            $table->longText('exclu_Hotel_Makka')->nullable();
            $table->longText('Reduction_Hotel_Makka')->nullable();
            $table->longText('Raison_Hotel_Makka')->nullable();

            $table->longText('exclu_Visa')->nullable();
            $table->longText('Reduction_Visa')->nullable();
            $table->longText('Raison_Visa')->nullable();

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
        Schema::connection('mysql_portal')->dropIfExists('gestion_inclus');
    }
};
