<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('product_type_id');
            $table->bigInteger('user_id');
            $table->bigInteger('page_id')->nullable();//page may have products listing
            $table->string('title', 250);
            $table->text('descr');
            $table->bigInteger('promo_image_id');
            $table->string('video_link', 255)->nullable();
            $table->float('price', 8, 2);
            $table->float('discount_parcent', 3, 2)->default(0);
            $table->float('total_discount', 8, 2)->default(0);
            $table->integer('quantity')->nullable();
            $table->float('average_rating', 2, 2)->default(0);
            $table->integer('total_review')->default(0);
            $table->integer('total_sell_download')->default(0);
            $table->tinyInteger('is_free')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
