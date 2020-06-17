<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    public function up()
    {
        //User or Organizations can be partner of TTN
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partnerable_type', 250);
            $table->bigInteger('partnerable_id');
            $table->tinyInteger('status')->default(10);
            $table->integer('sort_order')->default(100); //which partner should be kept first
            $table->bigInteger('page_id')->nullable();
            $table->string('partners_website', 250)->nullable();
            $table->date('partnership_started_at')->nullable();
            $table->date('partnership_ended_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
