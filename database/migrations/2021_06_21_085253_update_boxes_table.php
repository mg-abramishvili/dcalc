<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBoxesTable extends Migration
{
    public function up()
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->decimal('length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('sborka')->nullable();
            $table->decimal('marzha')->nullable();
        });
    }

    public function down()
    {
        //
    }
}
