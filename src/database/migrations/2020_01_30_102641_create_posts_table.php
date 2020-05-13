<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->bigInteger('categories_id')->unsigned()->nullable();
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->text('photo')->nullable();
            $table->string('uri')->nullable();
            $table->enum('status',['publish','hold'])->default('hold');
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
        Schema::dropIfExists('posts');
    }
}
