<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalculationUserTable extends Migration
{
    public function up()
    {
        Schema::create('calculation_user', function (Blueprint $table) {
            $table->id();
            $table->integer('calculation_id');
            $table->integer('user_id');
        });
    }

    public function down()
    {
        //
    }
}
