<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 200);
            $table->text('descr');
            $table->tinyInteger('status');//common status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_categories');
    }
}
