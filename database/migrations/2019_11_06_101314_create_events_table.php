<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('event_type_id');
            $table->string('title', 250);
            $table->text('details');
            $table->string('venue',250)->nullable();
            $table->string('webinar_url', 255)->nullable(); //maybe mobile-app or web-app link
            $table->string('room_id', 100)->nullable();//for webinar
            $table->string('password', 100)->nullable();//webinar room password(optional for public webinar)
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('contact_phone_no',20);
            $table->string('contact_email',150)->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->Integer('total_flag');
            $table->tinyInteger('is_featured');
            $table->tinyInteger('is_public')->default(0);//events(webinar or physical) can be public
            $table->tinyInteger('status');
            $table->bigInteger('total_views')->default(0);
            $table->bigInteger('total_likes')->default(0);
            $table->bigInteger('total_comments')->default(0);
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('events');
    }
}
