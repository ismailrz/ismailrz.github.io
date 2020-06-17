<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypesTable extends Migration
{
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 150);
            $table->string('icon', 150)->nullable(); //Icon to show various product types
            $table->text('descr')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_types');
    }
}
