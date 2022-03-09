<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->unique()->comment('Nombre del cliente o empresa');
            $table->string('address', 250)->nullable()->default('')->comment('Dirección fiscal del cliente');
            $table->string('city', 100)->nullable()->default('')->comment('Ciudad del cliente');
            $table->string('state', 100)->nullable()->default('')->comment('Estado del cliente');
            $table->string('phoneNumber', 50)->nullable()->default('')->comment('Teléfono del cliente');
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
        Schema::dropIfExists('customers');
    }
}
