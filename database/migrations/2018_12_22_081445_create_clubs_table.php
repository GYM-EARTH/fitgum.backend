<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('description');
            $table->text('content');
            $table->string('logo')->nullable();
            $table->bigInteger('phone')->unsigned()->nullable();
            $table->bigInteger('aphone')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->integer('house')->nullable();
            $table->string('housing')->nullable();
            $table->string('structure')->nullable();
            $table->string('proficiency')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 10, 8)->nullable();
            $table->string('site')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('status')->default(false);
            $table->integer('club_type_id')->unsigned();
            $table->timestamps();

            $table->foreign('club_type_id')->references('id')->on('club_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clubs');
    }
}
