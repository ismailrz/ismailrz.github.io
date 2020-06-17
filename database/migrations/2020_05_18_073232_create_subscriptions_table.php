<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscription_type_user_type_id');
            $table->bigInteger('user_id');
            $table->integer('total_limit')->default('0');
            $table->integer('remaining_limit')->default('0');
            $table->date('subscription_starts_at')->nullable();
            $table->date('subscription_ends_at')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
