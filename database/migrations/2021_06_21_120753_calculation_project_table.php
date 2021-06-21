<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalculationProjectTable extends Migration
{
    public function up()
    {
        Schema::create('calculation_project', function (Blueprint $table) {
            $table->id();
            $table->integer('calculation_id');
            $table->integer('project_id');
        });
    }

    public function down()
    {
        //
    }
}
