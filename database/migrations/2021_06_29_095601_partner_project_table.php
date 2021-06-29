<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PartnerProjectTable extends Migration
{
    public function up()
    {
        Schema::create('partner_project', function (Blueprint $table) {
            $table->id();
            $table->integer('partner_id');
            $table->integer('project_id');
        });
    }

    public function down()
    {
        //
    }
}
