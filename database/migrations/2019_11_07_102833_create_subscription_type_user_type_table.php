<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTypeUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_type_user_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscription_type_id');
            $table->bigInteger('user_type_id');
            $table->integer('total_limit')->default('0');//in days like 30 days or how many times
            $table->boolean('is_limit_in_days')->default(false);
            $table->boolean('is_free')->default(false);
            $table->tinyInteger('status')->default('1');//common status
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
        Schema::dropIfExists('subscription_type_user_type');
    }
}
