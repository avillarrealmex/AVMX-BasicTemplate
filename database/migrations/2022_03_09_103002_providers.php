<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Providers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->unique()->comment('Nombre del proveedor o empresa');
            $table->string('address', 250)->comment('Dirección fiscal del proveedor');
            $table->string('city', 100)->comment('Ciudad del proveedor');
            $table->string('state', 100)->comment('Estado del proveedor');
            $table->string('phoneNumber', 50)->nullable()->comment('Teléfono del proveedor');
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
        Schema::dropIfExists('providers');
    }
}
