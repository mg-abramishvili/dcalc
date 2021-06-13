<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalculationTypeTable extends Migration
{
    public function up()
    {
        Schema::create('calculation_type', function (Blueprint $table) {
            $table->id();
            $table->integer('calculation_id');
            $table->integer('type_id');
        });
    }

    public function down()
    {
        //
    }
}
