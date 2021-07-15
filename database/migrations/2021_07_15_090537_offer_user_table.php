<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OfferUserTable extends Migration
{
    public function up()
    {
        Schema::create('offer_user', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id');
            $table->integer('user_id');
        });
    }

    public function down()
    {
        //
    }
}
