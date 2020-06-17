<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('resource_type_id');
            $table->bigInteger('user_id');
            $table->bigInteger('page_id');
            $table->string('file_name', 200);
            $table->string('title', 250);
            $table->text('descr')->nullable();
            $table->tinyInteger('status')->default(0); //'common' type status i.e. active/inactive
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
