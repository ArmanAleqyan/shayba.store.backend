<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('header_phone')->nullable();
            $table->string('vk_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('watsap_url')->nullable();
            $table->string('telegram_url')->nullable();
            $table->string('footer_email')->nullable();
            $table->string('footer_phone')->nullable();
            $table->string('footer_address')->nullable();
            $table->string('info_o_nas')->nullable();
            $table->string('policy_file_url')->nullable();
            $table->string('footer_first_text')->nullable();
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
        Schema::dropIfExists('shop_descriptions');
    }
}
