<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OfferProjectTable extends Migration
{
    public function up()
    {
        Schema::create('offer_project', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id');
            $table->integer('project_id');
        });
    }

    public function down()
    {
        //
    }
}
