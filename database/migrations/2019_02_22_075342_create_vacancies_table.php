<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('club_id')->unsigned()->nullable();
            $table->text('definition')->nullable();
            $table->text('responsibility')->nullable();
            $table->text('demand')->nullable();
            $table->text('conditions')->nullable();
            $table->integer('salary');
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('metro_id')->unsigned()->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 10, 8)->nullable();
            $table->string('department')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('metro_id')->references('id')->on('metros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
