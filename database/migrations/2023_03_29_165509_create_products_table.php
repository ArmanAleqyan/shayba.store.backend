<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id') ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('taste_id')->nullable();
            $table->foreign('taste_id')->references('id') ->on('tastes')->onDelete('cascade');
            $table->unsignedBigInteger('made_in_id')->nullable();
            $table->foreign('made_in_id')->references('id') ->on('sub_categories')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id') ->on('categories')->onDelete('cascade');
            $table->longtext('name')->nullable();
            $table->longtext('art')->nullable();
            $table->integer('strength')->nullable();
            $table->integer('puffs_count')->nullable();
            $table->integer('count')->nullable();
            $table->string('status')->nullable();
            $table->string('shop_id')->nullable();

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
        Schema::dropIfExists('products');
    }
}
