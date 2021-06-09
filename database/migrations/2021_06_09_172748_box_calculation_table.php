<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BoxCalculationTable extends Migration
{
    public function up()
    {
        Schema::create('box_calculation', function (Blueprint $table) {
            $table->id();
            $table->integer('box_id');
            $table->integer('calculation_id');
        });
    }

    public function down()
    {
        //
    }
}
