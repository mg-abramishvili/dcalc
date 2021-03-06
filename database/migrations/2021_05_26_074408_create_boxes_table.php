<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('pre_rub')->default(0);
            $table->decimal('pre_usd')->default(0);
            $table->decimal('price')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boxes');
    }
}
