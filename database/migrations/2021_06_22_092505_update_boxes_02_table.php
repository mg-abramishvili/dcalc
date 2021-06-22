<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBoxes02Table extends Migration
{
    public function up()
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->longText('descriptionmanager')->nullable();
        });
    }

    public function down()
    {
        //
    }
}
