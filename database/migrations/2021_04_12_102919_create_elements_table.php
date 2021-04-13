<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('elements');
    }
}
