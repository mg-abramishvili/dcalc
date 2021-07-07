<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsers01Table extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('elements_prices')->nullable();
            $table->boolean('elements_edit')->nullable();
        });
    }

    public function down()
    {
        //
    }
}
