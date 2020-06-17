<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('title',250);
            $table->text('descr');
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('is_faq')->default('0');
            $table->integer('total_questions')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_categories');
    }
}
