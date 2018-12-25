<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->string('description');
            $table->string('surname');
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->bigInteger('phone')->unsigned()->nullable();
            $table->string('photo')->nullable();
            $table->integer('club_id')->unsigned();
            $table->integer('experience')->unsigned()->default(0);
            $table->string('education')->nullable();
            $table->text('content');
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
        Schema::dropIfExists('trainers');
    }
}
