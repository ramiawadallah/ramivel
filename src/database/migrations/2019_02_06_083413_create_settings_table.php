<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            
            // website contact information
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('fax')->nullable();
            $table->string('pobox')->nullable();
            $table->string('map')->nullable();
            $table->string('mainvideo')->nullable();

            // About your website
            $table->text('content')->nullable();
            $table->string('logo')->nullable();
            $table->enum('maintenance',['open','close']);
            $table->longtext('keywords')->nullable();
            $table->string('copyright')->nullable();

            // Social media
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();

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
