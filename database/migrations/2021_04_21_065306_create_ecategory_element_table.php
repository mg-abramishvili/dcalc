<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcategoryElementTable extends Migration
{
    public function up()
    {
        Schema::create('ecategory_element', function (Blueprint $table) {
            $table->id();
            $table->integer('ecategory_id');
            $table->integer('element_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ecategory_element');
    }
}
