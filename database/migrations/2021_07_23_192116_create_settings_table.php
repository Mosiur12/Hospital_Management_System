<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('facebook_url');
            $table->string('youtube_url');
            $table->string('twitter_url');
            $table->string('google_plus_url');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('featured_image');
            $table->string('short_desc');
            $table->text('our_history');
            $table->text('our_mission');
            $table->text('our_vision');
            $table->text('about_us');
            $table->text('terms');
            $table->text('privacy');
            $table->text('google_map');
            $table->string('platform_name');
            $table->string('developer_name');
            $table->string('developer_link');
            $table->string('logo');
            $table->string('favicon');
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
        Schema::dropIfExists('settings');
    }
}
