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
         Schema::connection('mysql_portal')->create('gestion_type_visas', function (Blueprint $table) {
            $table->id();
            $table->longText('type')->nullable();

            
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
         Schema::connection('mysql_portal')->dropIfExists('gestion_type_visas');
    }
};
