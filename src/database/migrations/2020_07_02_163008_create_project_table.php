<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('partner_id');
            $table->foreign('partner_id')
                  ->references('id')->on('partners')
                  ->onDelete('cascade');

            $table->string('title');
            $table->text('content')->nullable();
            $table->text('video')->nullable();

            $table->string('uri')->unique()->nullable();
            $table->text('photo')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
