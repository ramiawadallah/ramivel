<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('uri')->unique();
            $table->string('name')->nullable();
            $table->longText('content')->nullable();
            $table->text('photo')->nullable();
            $table->text('video')->nullable();
            $table->text('type')->nullable();

            $table->string('template')->nullable();
            $table->enum('status',['active','not active'])->default('active');

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            
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
        Schema::drop('pages');
    }
}
