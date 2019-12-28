<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:06
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->increments('id')
                ->comment('table to store airports data');
            $table->string('name')
                ->nullable(false)
                ->comment('Full name of the aircraft');
            $table->string('iata_code')
                ->nullable(true)
                ->index()
                ->comment('Unique three-letter IATA identifier for the aircraft');
            $table->string('icao_code')
                ->nullable(true)
                ->index()
                ->comment('Unique four-letter ICAO identifier for the aircraft');
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
        Schema::dropIfExists('airports');
    }
}