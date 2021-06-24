<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectUser extends Migration
{
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('user_id');
        });
    }

    public function down()
    {
        //
    }
}
