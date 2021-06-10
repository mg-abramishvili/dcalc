<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryElementTable extends Migration
{
    public function up()
    {
        Schema::create('category_element', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('element_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_element');
    }
}
