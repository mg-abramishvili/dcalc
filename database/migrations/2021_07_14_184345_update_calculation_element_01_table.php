<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCalculationElement01Table extends Migration
{
    public function up()
    {
        Schema::table('calculation_element', function (Blueprint $table) {
            $table->decimal('price')->nullable();
        });
    }

    public function down()
    {
        //
    }
}
