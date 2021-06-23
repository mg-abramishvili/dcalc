<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBoxes03Table extends Migration
{
    public function up()
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->longtext('box_images')->nullable();
        });
    }

    public function down()
    {
        //
    }
}
