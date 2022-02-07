<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id')
                  ->references('id')->on('pages')
                  ->onDelete('cascade');

            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->text('photo')->nullable();
            $table->string('type')->nullable();
            $table->string('order')->nullable();
            $table->enum('status',['active','not active'])->default('not active');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

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
        Schema::dropIfExists('sections');
    }
}
