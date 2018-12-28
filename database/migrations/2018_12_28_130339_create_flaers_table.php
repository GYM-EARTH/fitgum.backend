<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlaersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flaers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('title');
            $table->string('description');
            $table->text('content');
            $table->string('price');
            $table->integer('discount')->unsigned()->nullable();
            $table->time('start');
            $table->time('finish');
            $table->integer('club_id')->unsigned();
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flaers');
    }
}
