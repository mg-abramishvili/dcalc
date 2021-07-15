<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CendclientProjectTable extends Migration
{
    public function up()
    {
        Schema::create('cendclient_project', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('project_id');
        });
    }

    public function down()
    {
        //
    }
}
