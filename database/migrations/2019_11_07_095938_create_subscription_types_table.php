<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTypesTable extends Migration
{
    public function up()
    {
        Schema::create('subscription_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',250);
            $table->string('subscription_type_code',200)->unique();
            $table->text('descr');
            $table->tinyInteger('status'); //common status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_types');
    }
}
